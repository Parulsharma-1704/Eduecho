<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::with('user', 'disabilityProfile', 'accessibilityProfile')
            ->paginate(15);

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created student.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json(
            new StudentResource($student->load('user')),
            201
        );
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student): StudentResource
    {
        $this->authorize('view', $student);

        return new StudentResource($student->load('user', 'disabilityProfile', 'accessibilityProfile'));
    }

    /**
     * Update the specified student.
     */
    public function update(UpdateStudentRequest $request, Student $student): StudentResource
    {
        $this->authorize('update', $student);

        $student->update($request->validated());

        return new StudentResource($student);
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student): JsonResponse
    {
        $this->authorize('delete', $student);

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
