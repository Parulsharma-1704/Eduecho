<?php

namespace App\Http\Controllers;

use App\Models\EducatorRequest;
use App\Models\SpecialEducator;
use App\Models\EducatorDisabilitySpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $educatorRequest->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // Assign educator role to the user
        $user = $educatorRequest->user;
        $user->assignRole('special_educator');

        // Create SpecialEducator record
        $specialEducator = SpecialEducator::create([
            'user_id' => $user->id,
            'qualification' => $educatorRequest->qualification,
            'experience_years' => 0, // Could be calculated from experience text
        ]);

        // Create disability specializations
        foreach ($educatorRequest->specializations as $disabilityType) {
            EducatorDisabilitySpecialization::create([
                'educator_id' => $specialEducator->id,
                'disability_type' => $disabilityType,
            ]);
        }

        return redirect()->back()->with('success', 'Educator request approved successfully.');
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
