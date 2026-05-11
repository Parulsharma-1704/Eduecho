<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Students (Tutor Matching)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Available Students</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        These students currently need an educator and have disability profiles that match your specializations: 
                        @if(!empty($specializations))
                            <strong>{{ implode(', ', $specializations) }}</strong>
                        @else
                            <em>None recorded</em>
                        @endif
                    </p>

                    @if($students->isEmpty())
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No matching students</h3>
                            <p class="mt-1 text-sm text-gray-500">There are currently no unmatched students matching your expertise.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($students as $student)
                                <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="h-12 w-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xl">
                                            {{ substr($student->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-900">{{ $student->user->name }}</h4>
                                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                                {{ $student->disabilityProfile->disability_type ?? 'Unspecified Needs' }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-6 h-12 overflow-hidden">
                                        {{ Str::limit($student->disabilityProfile->description ?? 'No description provided.', 80) }}
                                    </p>
                                    <form method="POST" action="{{ route('tutoring.connect', $student) }}">
                                        @csrf
                                        <button type="submit" class="w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Connect & Tutor
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
