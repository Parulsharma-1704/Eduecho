<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Educator Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-2">Pending Educator Applications</h3>
                        <p class="text-sm text-gray-600">
                            Review and approve applications from individuals who want to become special educators.
                        </p>
                    </div>

                    @if($requests->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No pending requests</h3>
                            <p class="mt-1 text-sm text-gray-500">All educator requests have been processed.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($requests as $request)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                                {{ substr($request->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $request->user->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $request->user->email }}</p>
                                                <p class="text-xs text-gray-500">Applied {{ $request->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('educator-request.show', $request) }}" 
                                               class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                                View Details
                                            </a>
                                            <form method="POST" action="{{ route('educator-request.approve', $request) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded hover:bg-green-200"
                                                        onclick="return confirm('Are you sure you want to approve this educator request?')">
                                                    Approve
                                                </button>
                                            </form>
                                            <button type="button" 
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200"
                                                    onclick="openRejectModal({{ $request->id }})">
                                                Reject
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-700"><strong>Qualification:</strong> {{ $request->qualification }}</p>
                                        <p class="text-sm text-gray-700"><strong>Specializations:</strong> {{ collect($request->specializations)->map(function($spec) { return ucfirst(str_replace('_', ' ', $spec)); })->join(', ') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $requests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Educator Request</h3>
                <form id="rejectForm" method="POST">
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
        function openRejectModal(requestId) {
            document.getElementById('rejectForm').action = `/educator-requests/${requestId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('review_notes').value = '';
        }
    </script>
</x-app-layout>