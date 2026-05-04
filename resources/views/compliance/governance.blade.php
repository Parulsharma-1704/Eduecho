<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Data Governance</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Total Roles</p>
                <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $roleCount }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Permissions</p>
                <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $permissionCount }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Active Users</p>
                <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $userCount }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Data Classes</p>
                <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ count($dataClassifications) }}</p>
            </div>
        </div>

        <!-- Data Retention Policies -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Data Retention Policies</h3>
            </div>
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Data Type</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Retention Period</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Compliance</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($retentionPolicies as $key => $policy)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4 text-slate-900 dark:text-white font-medium">{{ $policy['label'] }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                {{ $policy['retention_days'] }} days
                                <span class="text-xs text-slate-500 block">{{ round($policy['retention_days'] / 365, 1) }} years</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg font-semibold text-sm">
                                    ✓ Compliant
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Data Classification -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Data Classification Levels</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                @foreach($dataClassifications as $classification => $details)
                    <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-3 h-3 rounded-full mt-1.5" style="background-color: {{ ['public' => '#10b981', 'internal' => '#3b82f6', 'confidential' => '#f59e0b', 'restricted' => '#ef4444'][$classification] ?? '#6b7280' }}"></div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white mb-1">
                                    {{ ucfirst($classification) }}
                                </h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $details['description'] }}</p>
                                <div class="mt-2 text-xs">
                                    <p class="text-slate-500">Level: {{ $details['level'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Access Control Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Access Control</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold text-slate-900 dark:text-white">Role-Based Access</p>
                            <p class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $roleCount }} roles</p>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">Granular role assignments for users</p>
                    </div>
                    <div class="border-t border-slate-200 dark:border-slate-700 pt-3">
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold text-slate-900 dark:text-white">Permission-Based</p>
                            <p class="text-blue-600 dark:text-blue-400 font-bold">{{ $permissionCount }} permissions</p>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">Detailed permission control system</p>
                    </div>
                    <div class="border-t border-slate-200 dark:border-slate-700 pt-3">
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold text-slate-900 dark:text-white">Active Sessions</p>
                            <p class="text-purple-600 dark:text-purple-400 font-bold">{{ $userCount }} users</p>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">Currently registered in system</p>
                    </div>
                </div>
            </div>

            <!-- Compliance Standards -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Compliance Standards</h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                        <p class="text-xl">📋</p>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">FERPA</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Family Educational Rights & Privacy Act</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                        <p class="text-xl">♿</p>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">WCAG 2.1 AA</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Web Content Accessibility Guidelines</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                        <p class="text-xl">🔐</p>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">HIPAA</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Health Insurance Portability & Accountability</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                        <p class="text-xl">🛡️</p>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">ADA</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Americans with Disabilities Act</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Handling Guidelines -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 p-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Data Handling Guidelines</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-lg">🔒</span> Data Protection
                    </h4>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                        <li>• All sensitive data encrypted at rest (AES-256)</li>
                        <li>• Data encrypted in transit (TLS 1.3)</li>
                        <li>• Regular security audits conducted</li>
                        <li>• Access logs maintained for 1 year</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-lg">📤</span> Data Export
                    </h4>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                        <li>• All exports require authorization</li>
                        <li>• Export requests logged automatically</li>
                        <li>• Audit trail maintained for 2 years</li>
                        <li>• Exports encrypted during transfer</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
