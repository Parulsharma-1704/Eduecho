<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Tutors') }}
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
                    <h3 class="text-lg font-bold mb-4">Available Tutors</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        These educators specialize in <strong>{{ ucfirst(str_replace('_', ' ', $student->disabilityProfile->disability_type)) }}</strong> and can provide personalized support for your learning needs.
                    </p>

                    @if($educators->isEmpty())
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No matching tutors</h3>
                            <p class="mt-1 text-sm text-gray-500">There are currently no educators available who specialize in your disability type.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($educators as $educator)
                                <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="h-12 w-12 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-xl">
                                            {{ substr($educator->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-900">{{ $educator->name }}</h4>
                                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-700/10">
                                                Special Educator
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Specializes in: {{ $educator->specialEducator->disabilitySpecializations->pluck('disability_type')->map(function($type) { return ucfirst(str_replace('_', ' ', $type)); })->join(', ') }}
                                    </p>
                                    <p class="text-sm text-gray-500 mb-6">
                                        Available to provide personalized tutoring and support.
                                    </p>
                                    <form method="POST" action="{{ route('tutoring.request-connect', $educator) }}">
                                        @csrf
                                        <button type="submit" class="w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                            Request Connection
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