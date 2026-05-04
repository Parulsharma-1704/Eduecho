<x-app-layout>
    <x-slot name="header">
        Create Adaptive Content
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <form action="{{ route('adaptive-content.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Course Resource Selection -->
                <div>
                    <label for="course_resource_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Course Resource *
                    </label>
                    <select name="course_resource_id" id="course_resource_id" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('course_resource_id') border-red-500 @enderror" required>
                        <option value="">Select a course resource</option>
                        @foreach($courseResources as $resource)
                            <option value="{{ $resource->id }}" {{ old('course_resource_id') == $resource->id ? 'selected' : '' }}>
                                {{ $resource->title }} ({{ $resource->course->title ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                    @error('course_resource_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Original Content -->
                <div>
                    <label for="original_content" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Original Content *
                    </label>
                    <textarea name="original_content" id="original_content" rows="6" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('original_content') border-red-500 @enderror" placeholder="Enter the original content..." required>{{ old('original_content') }}</textarea>
                    @error('original_content')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Type -->
                <div>
                    <label for="content_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Content Type *
                    </label>
                    <select name="content_type" id="content_type" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('content_type') border-red-500 @enderror" required>
                        <option value="">Select content type</option>
                        <option value="text" {{ old('content_type') == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="audio" {{ old('content_type') == 'audio' ? 'selected' : '' }}>Audio</option>
                        <option value="interactive" {{ old('content_type') == 'interactive' ? 'selected' : '' }}>Interactive</option>
                        <option value="image" {{ old('content_type') == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="document" {{ old('content_type') == 'document' ? 'selected' : '' }}>Document</option>
                    </select>
                    @error('content_type')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Difficulty Level -->
                <div>
                    <label for="difficulty_level" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Difficulty Level *
                    </label>
                    <select name="difficulty_level" id="difficulty_level" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('difficulty_level') border-red-500 @enderror" required>
                        <option value="">Select difficulty level</option>
                        <option value="beginner" {{ old('difficulty_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('difficulty_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('difficulty_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('difficulty_level')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Optional description...">{{ old('description') }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
                        Create Content
                    </button>
                    <a href="{{ route('adaptive-content.index') }}" class="flex-1 px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition text-center font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
