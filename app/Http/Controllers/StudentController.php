<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::with('user', 'disabilityProfile')
            ->when($request->search, fn($q) => $q->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->search}%")))
            ->paginate(15);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Student::class);
        return view('students.create');
    }

    /**
     * Store a newly created student.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route('students.show', $student)->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);
        $student->load('user', 'disabilityProfile', 'accessibilityProfile', 'ieps', 'courses', 'therapySessions');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $this->authorize('update', $student);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
