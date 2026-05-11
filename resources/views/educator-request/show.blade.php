<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Educator Request Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xl">
                                {{ substr($educatorRequest->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $educatorRequest->user->name }}</h3>
                                <p class="text-gray-600">{{ $educatorRequest->user->email }}</p>
                                <p class="text-sm text-gray-500">Applied {{ $educatorRequest->created_at->format('M j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            @if($educatorRequest->status === 'pending')
                                <form method="POST" action="{{ route('educator-request.approve', $educatorRequest) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                            onclick="return confirm('Are you sure you want to approve this educator request?')">
                                        Approve
                                    </button>
                                </form>
                                <button type="button" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                        onclick="openRejectModal()">
                                    Reject
                                </button>
                            @else
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @if($educatorRequest->status === 'approved') bg-green-100 text-green-800 
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($educatorRequest->status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Application Details -->
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Educational Qualification</h4>
                                <p class="text-gray-700">{{ $educatorRequest->qualification }}</p>
                            </div>

                            @if($educatorRequest->experience)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Teaching Experience</h4>
                                <p class="text-gray-700">{{ $educatorRequest->experience }}</p>
                            </div>
                            @endif

                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Areas of Specialization</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($educatorRequest->specializations as $specialization)
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-sm rounded">
                                            {{ ucfirst(str_replace('_', ' ', $specialization)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            @if($educatorRequest->motivation)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Motivation</h4>
                                <p class="text-gray-700">{{ $educatorRequest->motivation }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Status & Review -->
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Application Status</h4>
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @if($educatorRequest->status === 'approved') bg-green-100 text-green-800
                                    @elseif($educatorRequest->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($educatorRequest->status) }}
                                </span>
                            </div>

                            @if($educatorRequest->reviewed_at)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Reviewed By</h4>
                                <p class="text-gray-700">{{ $educatorRequest->reviewer->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500">{{ $educatorRequest->reviewed_at->format('M j, Y \a\t g:i A') }}</p>
                            </div>

                            @if($educatorRequest->review_notes)
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Review Notes</h4>
                                <p class="text-gray-700">{{ $educatorRequest->review_notes }}</p>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('educator-request.index') }}" class="text-indigo-600 hover:text-indigo-800">← Back to Requests</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    @if($educatorRequest->status === 'pending')
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Educator Request</h3>
                <form method="POST" action="{{ route('educator-request.reject', $educatorRequest) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="review_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for rejection (optional)
                        </label>
                        <textarea 
                            id="review_notes" 
                            name="review_notes" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Provide feedback to the applicant..."
                        ></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">Reject Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('review_notes').value = '';
        }
    </script>
    @endif
</x-app-layout>