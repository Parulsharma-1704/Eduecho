<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseResourceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'resource_type' => 'required|string|in:video,audio,pdf,reading',
            'file' => 'required|file|max:20480', // 20MB max
            'has_captions' => 'boolean',
            'has_transcript' => 'boolean',
            'has_audio_description' => 'boolean',
        ]);

        $course = Course::findOrFail($validated['course_id']);
        
        // Ensure user is authorized
        if (auth()->id() !== $course->created_by_id && !auth()->user()->hasRole('admin')) {
            return back()->with('error', 'You are not authorized to add resources to this course.');
        }

        // Handle file upload
        $path = $request->file('file')->store('course-resources/' . $course->id, 'public');

        CourseResource::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'resource_type' => $validated['resource_type'],
            'file_path' => $path,
            'has_captions' => $request->has('has_captions'),
            'has_transcript' => $request->has('has_transcript'),
            'has_audio_description' => $request->has('has_audio_description'),
            'description' => $request->description ?? '',
        ]);

        return back()->with('success', 'Learning material uploaded successfully.');
    }
}
