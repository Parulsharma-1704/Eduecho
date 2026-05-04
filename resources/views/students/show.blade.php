<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $student->user->name }}
            </h2>
            @can('update', $student)
                <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Edit</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-600 text-sm">Name</label>
                            <p class="font-semibold">{{ $student->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600 text-sm">Email</label>
                            <p class="font-semibold">{{ $student->user->email }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600 text-sm">Enrollment Date</label>
                            <p class="font-semibold">{{ $student->enrollment_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600 text-sm">Grade Level</label>
                            <p class="font-semibold">{{ $student->grade_level ?? 'Not specified' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disability Profile -->
            @if($student->disabilityProfile)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Disability Profile</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-600 text-sm">Disability Type</label>
                                <p class="font-semibold">{{ $student->disabilityProfile->disability_type }}</p>
                            </div>
                            <div>
                                <label class="text-gray-600 text-sm">Description</label>
                                <p class="font-semibold">{{ $student->disabilityProfile->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Accessibility Profile -->
            @if($student->accessibilityProfile)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Accessibility Profile</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-600 text-sm">Accessibility Level</label>
                                <p class="font-semibold">{{ $student->accessibilityProfile->accessibility_level }}</p>
                            </div>
                            <div>
                                <label class="text-gray-600 text-sm">Accommodations</label>
                                <p class="font-semibold">{{ $student->accessibilityProfile->accommodations }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- IEPs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">IEPs ({{ count($student->ieps) }})</h3>
                    @if(count($student->ieps) > 0)
                        <ul class="space-y-2">
                            @foreach($student->ieps as $iep)
                                <li><a href="{{ route('ieps.show', $iep) }}" class="text-indigo-600 hover:text-indigo-900">{{ $iep->title }} - {{ $iep->status }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">No IEPs found.</p>
                    @endif
                </div>
            </div>

            <!-- Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Enrolled Courses ({{ count($student->courses) }})</h3>
                    @if(count($student->courses) > 0)
                        <ul class="space-y-2">
                            @foreach($student->courses as $course)
                                <li><a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:text-indigo-900">{{ $course->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">No courses enrolled.</p>
                    @endif
                </div>
            </div>

            <!-- Therapy Sessions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Therapy Sessions ({{ count($student->therapySessions) }})</h3>
                    @if(count($student->therapySessions) > 0)
                        <ul class="space-y-2">
                            @foreach($student->therapySessions as $session)
                                <li><a href="{{ route('therapy-sessions.show', $session) }}" class="text-indigo-600 hover:text-indigo-900">{{ $session->session_type }} - {{ $session->session_date->format('M d, Y') }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">No therapy sessions found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
