<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('students.update', $student) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Student Name (Read-only) -->
                        <div>
                            <label class="block font-medium text-gray-700">Student Name</label>
                            <input type="text" value="{{ $student->user->name }}" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" disabled>
                        </div>

                        <!-- Enrollment Date -->
                        <div>
                            <label for="enrollment_date" class="block font-medium text-gray-700">Enrollment Date</label>
                            <input type="date" id="enrollment_date" name="enrollment_date" value="{{ $student->enrollment_date->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            @error('enrollment_date')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Grade Level -->
                        <div>
                            <label for="grade_level" class="block font-medium text-gray-700">Grade Level</label>
                            <input type="text" id="grade_level" name="grade_level" value="{{ $student->grade_level }}" class="mt-1 block w-full border-gray-300 rounded-md">
                            @error('grade_level')
                                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Student</button>
                            <a href="{{ route('students.show', $student) }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
