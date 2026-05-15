<?php

namespace App\Http\Controllers;

use App\Models\EducatorRequest;
use App\Models\SpecialEducator;
use App\Models\EducatorDisabilitySpecialization;
use App\Mail\EducatorApplicationApproved;
use App\Mail\TherapistApplicationApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EducatorRequestController extends Controller
{
    /**
     * Show the form for creating an educator request.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Check if user already has a pending or approved request
        $existingRequest = EducatorRequest::where('user_id', $user->id)->first();
        
        if ($existingRequest) {
            if ($existingRequest->status === 'pending') {
                return redirect()->back()->with('info', 'You already have a pending educator request.');
            } elseif ($existingRequest->status === 'approved') {
                return redirect()->back()->with('info', 'You are already approved as an educator.');
            }
        }

        return view('educator-request.create');
    }

    /**
     * Store a newly created educator request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'qualification' => 'required|string|max:255',
            'experience' => 'nullable|string|max:1000',
            'specializations' => 'required|array|min:1',
            'specializations.*' => 'in:autism,adhd,dyslexia,hearing,visual,mobility',
            'motivation' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Check if user already has a request
        if (EducatorRequest::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You already have an educator request.');
        }

        EducatorRequest::create([
            'user_id' => $user->id,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'specializations' => $request->specializations,
            'motivation' => $request->motivation,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your educator request has been submitted and is pending approval.');
    }

    /**
     * Display pending educator requests for admin.
     */
    public function index()
    {
        $this->authorize('viewAny', EducatorRequest::class);

        $requests = EducatorRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('educator-request.index', compact('requests'));
    }

    /**
     * Show the details of a specific request.
     */
    public function show(EducatorRequest $educatorRequest)
    {
        $this->authorize('view', $educatorRequest);

        return view('educator-request.show', compact('educatorRequest'));
    }

    /**
     * Approve an educator request.
     */
    public function approve(EducatorRequest $educatorRequest)
    {
        $this->authorize('update', $educatorRequest);

        if ($educatorRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Request has already been processed.');
        }

        // Determine the role from review_notes (which contains registration data)
        $registrationData = json_decode($educatorRequest->review_notes, true);
        $isTherapist = isset($registrationData['role']) && $registrationData['role'] === 'therapist';
        $roleName = $isTherapist ? 'therapist' : 'special_educator';

        $educatorRequest->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // Assign correct role to the user
        $user = $educatorRequest->user;
        if (!\Spatie\Permission\Models\Role::where('name', $roleName)->exists()) {
            \Spatie\Permission\Models\Role::create(['name' => $roleName]);
        }
        $user->assignRole($roleName);

        if ($isTherapist) {
            // Create Therapist record
            \App\Models\Therapist::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'specialization' => is_array($educatorRequest->specializations) ? implode(', ', $educatorRequest->specializations) : $educatorRequest->specializations,
                    'certification' => $registrationData['license_number'] ?? null,
                    'experience_years' => $registrationData['experience_years'] ?? 0,
                ]
            );
        } else {
            // Create SpecialEducator record
            $specialEducator = SpecialEducator::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'qualification' => $educatorRequest->qualification,
                    'experience_years' => $registrationData['experience_years'] ?? 0,
                ]
            );

            // Create disability specializations
            if (is_array($educatorRequest->specializations)) {
                foreach ($educatorRequest->specializations as $disabilityType) {
                    EducatorDisabilitySpecialization::firstOrCreate([
                        'educator_id' => $specialEducator->id,
                        'disability_type' => $disabilityType,
                    ]);
                }
            }
        }

        // Send appropriate approval email
        if ($isTherapist) {
            Mail::to($user->email)->send(new TherapistApplicationApproved($user));
        } else {
            Mail::to($user->email)->send(new EducatorApplicationApproved($user));
        }

        return redirect()->route('educator-request.index')->with('success', 'Request approved successfully. The user has been notified.');
    }

    /**
     * Reject an educator request.
     */
    public function reject(Request $request, EducatorRequest $educatorRequest)
    {
        $this->authorize('update', $educatorRequest);

        $request->validate([
            'review_notes' => 'nullable|string|max:1000',
        ]);

        if ($educatorRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Request has already been processed.');
        }

        $educatorRequest->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'review_notes' => $request->review_notes,
        ]);

        return redirect()->back()->with('success', 'Educator request rejected.');
    }
}
