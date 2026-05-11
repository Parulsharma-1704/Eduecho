<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request to Become an Educator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-2">Join Our Team of Special Educators</h3>
                        <p class="text-sm text-gray-600">
                            Help students with disabilities reach their full potential. Your application will be reviewed by our administration team.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('educator-request.store') }}">
                        @csrf

                        <!-- Qualification -->
                        <div class="mb-4">
                            <label for="qualification" class="block text-sm font-semibold text-gray-700 mb-2">
                                Educational Qualification *
                            </label>
                            <input 
                                type="text" 
                                id="qualification" 
                                name="qualification" 
                                value="{{ old('qualification') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="e.g., Master's in Special Education"
                                required
                            >
                            @error('qualification')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div class="mb-4">
                            <label for="experience" class="block text-sm font-semibold text-gray-700 mb-2">
                                Teaching Experience
                            </label>
                            <textarea 
                                id="experience" 
                                name="experience" 
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Describe your experience working with students who have disabilities..."
                            >{{ old('experience') }}</textarea>
                            @error('experience')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Specializations -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Areas of Specialization *
                            </label>
                            <p class="text-xs text-gray-500 mb-3">Select the disability types you are qualified to support:</p>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['autism' => 'Autism Spectrum Disorder', 'adhd' => 'ADHD', 'dyslexia' => 'Dyslexia', 'hearing' => 'Hearing Impairment', 'visual' => 'Visual Impairment', 'mobility' => 'Mobility Impairment'] as $value => $label)
                                    <label class="flex items-center">
                                        <input 
                                            type="checkbox" 
                                            name="specializations[]" 
                                            value="{{ $value }}"
                                            @if(in_array($value, old('specializations', []))) checked @endif
                                            class="mr-2"
                                        >
                                        <span class="text-sm">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('specializations')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Motivation -->
                        <div class="mb-6">
                            <label for="motivation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Why do you want to become an educator on EduEcho?
                            </label>
                            <textarea 
                                id="motivation" 
                                name="motivation" 
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Share your motivation and what you hope to achieve..."
                            >{{ old('motivation') }}</textarea>
                            @error('motivation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                            <button 
                                type="submit" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>