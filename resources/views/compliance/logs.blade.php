<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Compliance Logs</h2>
            <a href="{{ route('compliance.export', ['type' => 'logs']) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold transition">
                📥 Export
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Action Type</label>
                    <select name="action_type" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Types</option>
                        @foreach($actionTypes as $key => $label)
                            <option value="{{ $key }}" {{ request('action_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">User</label>
                    <select name="user_id" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Logs Timeline -->
        <div class="space-y-3">
            @forelse($logs as $log)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 border border-slate-100 dark:border-slate-700 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div class="flex gap-4 flex-1">
                            <div class="text-2xl">
                                {{ $log->getActionTypeInfo()['icon'] }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $log->action }}</h3>
                                    <span class="px-2 py-1 text-xs font-semibold bg-{{ $log->getActionTypeInfo()['color'] }}-100 dark:bg-{{ $log->getActionTypeInfo()['color'] }}-900/30 text-{{ $log->getActionTypeInfo()['color'] }}-700 dark:text-{{ $log->getActionTypeInfo()['color'] }}-300 rounded">
                                        {{ $log->getActionTypeInfo()['label'] }}
                                    </span>
                                    @if($log->isSensitiveAction())
                                        <span class="px-2 py-1 text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded">🔴 Sensitive</span>
                                    @endif
                                </div>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">
                                    <span class="font-semibold">{{ $log->user?->name ?? 'System' }}</span>
                                    <span class="text-slate-500">{{ $log->timestamp->diffForHumans() }}</span>
                                </p>
                                @if($log->details)
                                    <div class="mt-2 p-2 bg-slate-100 dark:bg-slate-900 rounded text-xs text-slate-700 dark:text-slate-300 font-mono">
                                        @foreach($log->details as $key => $value)
                                            <p><strong>{{ $key }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-right text-xs text-slate-500 dark:text-slate-400">
                            {{ $log->timestamp->format('M d, Y H:i:s') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-12 text-center border border-slate-100 dark:border-slate-700">
                    <p class="text-slate-500 dark:text-slate-400">No compliance logs found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
