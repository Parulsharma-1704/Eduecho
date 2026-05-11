<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl text-indigo-700 leading-tight">
                    {{ __('Educator Requests') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">Manage and review educator applications</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-teal-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-indigo-700">Pending Educator Applications</h3>
                        <p class="text-sm text-slate-600">Review and approve applications from individuals who want to become special educators.</p>
                    </div>
                </div>
            </div>

            @if($requests->isEmpty())
                <div class="bg-gradient-to-br from-slate-50 to-lavender-50 rounded-3xl border-2 border-lavender-200 p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-lavender-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-bold text-indigo-700 mb-2">No pending requests</h3>
                    <p class="text-slate-600">All educator requests have been processed.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($requests as $request)
                        <div class="bg-white rounded-2xl border-2 border-lavender-200 p-6 hover:shadow-lg hover:border-teal-300 transition-all duration-300">
                            <!-- Top Row: Avatar, Name, Actions -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4 flex-1">
                                    <!-- Avatar -->
                                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-teal-500 text-white flex items-center justify-center font-black text-lg flex-shrink-0">
                                        {{ substr($request->user->name, 0, 1) }}
                                    </div>
                                    
                                    <!-- Info -->
                                    <div class="flex-1">
                                        <h4 class="font-black text-indigo-700 text-lg">{{ $request->user->name }}</h4>
                                        <p class="text-sm text-slate-600">{{ $request->user->email }}</p>
                                        <p class="text-xs text-teal-600 font-semibold mt-1">{{ $request->created_at->format('M d, Y') }} at {{ $request->created_at->format('g:i A') }}</p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2 ml-4 flex-shrink-0">
                                    <a href="{{ route('educator-request.show', $request) }}" 
                                       class="px-4 py-2 text-sm font-semibold bg-blue-100 text-blue-700 rounded-xl hover:bg-blue-200 transition-colors whitespace-nowrap">
                                        View Details
                                    </a>
                                    <form method="POST" action="{{ route('educator-request.approve', $request) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="px-4 py-2 text-sm font-semibold bg-green-100 text-green-700 rounded-xl hover:bg-green-200 transition-colors whitespace-nowrap"
                                                onclick="return confirm('Are you sure you want to approve this educator?')">
                                            Approve
                                        </button>
                                    </form>
                                    <button type="button" 
                                            class="px-4 py-2 text-sm font-semibold bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition-colors whitespace-nowrap"
                                            onclick="openRejectModal({{ $request->id }})">
                                        Reject
                                    </button>
                                </div>
                            </div>

                            <!-- Details Row -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-lavender-200">
                                <div>
                                    <p class="text-xs font-bold text-indigo-700 uppercase tracking-wide mb-1">Qualification</p>
                                    <p class="text-sm text-slate-700">{{ $request->qualification }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs font-bold text-indigo-700 uppercase tracking-wide mb-1">Specializations</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($request->specializations as $spec)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                                {{ ucfirst(str_replace('_', ' ', $spec)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="relative mx-auto w-full max-w-md bg-white rounded-3xl shadow-2xl border-2 border-lavender-200 p-8">
            <div>
                <h3 class="text-xl font-black text-indigo-700 mb-2">Reject Educator Request</h3>
                <p class="text-sm text-slate-600 mb-6">Provide feedback for the applicant (optional)</p>
                
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="review_notes" class="block text-sm font-bold text-indigo-700 mb-2">
                            Reason for Rejection
                        </label>
                        <textarea 
                            id="review_notes" 
                            name="review_notes" 
                            rows="4"
                            class="w-full px-4 py-3 border-2 border-lavender-200 rounded-2xl focus:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-200 resize-none text-slate-700 placeholder-slate-400"
                            placeholder="Provide constructive feedback..."
                        ></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                onclick="closeRejectModal()" 
                                class="px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-xl hover:bg-red-700 transition-colors">
                            Reject Request
                        </button>
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

        // Close modal on outside click
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</x-app-layout>