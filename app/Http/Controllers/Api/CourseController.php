<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', Course::class);

        $courses = Course::with('creator', 'resources')
            ->where('is_active', true)
            ->paginate(15);

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created course.
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->id();

        $course = Course::create($data);

        return response()->json(
            new CourseResource($course->load('creator')),
            201
        );
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): CourseResource
    {
        $this->authorize('view', $course);

        return new CourseResource($course->load('creator', 'resources', 'enrollments'));
    }

    /**
     * Update the specified course.
     */
    public function update(UpdateCourseRequest $request, Course $course): CourseResource
    {
        $this->authorize('update', $course);

        $course->update($request->validated());

        return new CourseResource($course);
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course): JsonResponse
    {
        $this->authorize('delete', $course);

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully'], 200);
    }
}
