<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutoringController extends Controller
{
    /**
     * Show the matching interface for Educators.
     */
    public function matching()
    {
        $user = Auth::user();
        
        if (!$user->hasRole('special_educator')) {
            abort(403, 'Unauthorized action.');
        }

        // Get the educator's specializations
        $educator = $user->specialEducator;
        $specializations = [];
        if ($educator) {
            $specializations = $educator->disabilitySpecializations->pluck('disability_type')->toArray();
        }

        // Find students without an assigned educator who match the specializations
        $students = Student::whereNull('assigned_educator_id')
            ->whereHas('disabilityProfile', function($query) use ($specializations) {
                if (!empty($specializations)) {
                    $query->whereIn('disability_type', $specializations);
                }
            })
            ->with(['user', 'disabilityProfile'])
            ->get();

        return view('tutoring.matching', compact('students', 'specializations'));
    }

    /**
     * Show available tutors for students.
     */
    public function findTutors()
    {
        $user = Auth::user();
        
        if (!$user->hasRole('student')) {
            abort(403, 'Unauthorized action.');
        }

        $student = $user->student;
        if (!$student || !$student->disabilityProfile) {
            return redirect()->back()->with('error', 'Please complete your disability profile first.');
        }

        $disabilityType = $student->disabilityProfile->disability_type;

        // Find educators who specialize in this disability type
        $educators = User::whereHas('roles', function($q) {
            $q->where('name', 'special_educator');
        })->whereHas('specialEducator.disabilitySpecializations', function($q) use ($disabilityType) {
            $q->where('disability_type', $disabilityType);
        })->with(['specialEducator.disabilitySpecializations'])
          ->get();

        return view('tutoring.find-tutors', compact('educators', 'student'));
    }

    /**
     * Student requests connection with an educator.
     */
    public function requestConnection(Request $request, User $educator)
    {
        $user = Auth::user();
        
        if (!$user->hasRole('student')) {
            abort(403, 'Unauthorized action.');
        }

        $student = $user->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Student profile not found.');
        }

        if ($student->assigned_educator_id) {
            return redirect()->back()->with('error', 'You are already connected to an educator.');
        }

        // For now, directly assign. In a real app, this might create a request that educator approves.
        $student->update([
            'assigned_educator_id' => $educator->id
        ]);

        return redirect()->route('tutoring.hub')->with('success', 'Successfully connected with ' . $educator->name . '.');
    }

    /**
     * Educator connects with a student.
     */
    public function connectStudent(Request $request, Student $student)
    {
        $user = Auth::user();
        
        if (!$user->hasRole('special_educator')) {
            abort(403, 'Unauthorized action.');
        }

        if ($student->assigned_educator_id) {
            return redirect()->back()->with('error', 'This student is already connected to an educator.');
        }

        $student->update([
            'assigned_educator_id' => $user->id
        ]);

        return redirect()->route('tutoring.hub')->with('success', 'Successfully connected with ' . $student->user->name . '.');
    }

    /**
     * Show the Tutoring Hub / Chat Interface.
     */
    public function hub(Request $request)
    {
        $user = Auth::user();
        $contacts = collect();
        $activeContact = null;

        if ($user->hasRole('special_educator')) {
            // For educators, list all assigned students
            $students = Student::where('assigned_educator_id', $user->id)
                ->with('user')
                ->get();
            $contacts = $students->pluck('user');
        } elseif ($user->hasRole('student')) {
            // For students, list their assigned educator (and maybe therapists)
            $student = $user->student;
            if ($student && $student->assigned_educator_id) {
                $educatorUser = User::find($student->assigned_educator_id);
                if ($educatorUser) {
                    $contacts->push($educatorUser);
                }
            }
        } else {
            abort(403, 'Unauthorized access to Tutoring Hub.');
        }

        if ($request->has('contact')) {
            $activeContact = User::find($request->contact);
        } else if ($contacts->isNotEmpty()) {
            $activeContact = $contacts->first();
        }

        return view('tutoring.hub', compact('contacts', 'activeContact', 'user'));
    }

    /**
     * Get messages for chat.
     */
    public function getMessages(User $contact)
    {
        $userId = Auth::id();

        $messages = Message::where(function($q) use ($userId, $contact) {
            $q->where('sender_id', $userId)
              ->where('recipient_id', $contact->id);
        })->orWhere(function($q) use ($userId, $contact) {
            $q->where('sender_id', $contact->id)
              ->where('recipient_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        // Mark as read
        Message::where('sender_id', $contact->id)
            ->where('recipient_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json($messages);
    }

    /**
     * Send a new message.
     */
    public function sendMessage(Request $request, User $contact)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $contact->id,
            'content' => $request->content,
            'message_type' => 'text',
            'is_read' => false,
        ]);

        // Eager load sender for the response
        $message->load('sender');

        return response()->json($message);
    }
}
