<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduEcho</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 800; }
        .gradient-lavender { background: linear-gradient(135deg, #F3EEFF 0%, #E5D9FF 100%); }
    </style>
</head>
<body class="bg-slate-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-72 bg-white border-r border-lavender-100 p-8 overflow-y-auto">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-700 to-teal-600 flex items-center justify-center text-white font-black text-xl">E</div>
                <span class="text-2xl font-black text-indigo-700">EduEcho</span>
            </div>

            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl bg-lavender-50 text-indigo-700 font-bold">
                    <span class="text-xl">⚙️</span> Admin Panel
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">👥</span> Users
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📋</span> Compliance
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">🔒</span> Security
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📊</span> Reports
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">⚡</span> System Config
                </a>
            </nav>

            <div class="mt-12 pt-8 border-t border-lavender-100">
                <div class="p-4 rounded-2xl bg-indigo-50 border border-indigo-200">
                    <h4 class="font-black text-indigo-700 mb-2">System Health</h4>
                    <div class="flex items-center gap-2 text-xs text-indigo-600">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        All systems operational
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto gradient-lavender p-12">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-5xl font-black text-indigo-700 mb-3">System Administration 🔐</h1>
                    <p class="text-lg text-indigo-600">Platform governance and compliance management</p>
                </div>

                <!-- Metrics -->
                <div class="grid md:grid-cols-5 gap-4 mb-12">
                    <div class="p-6 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-2xl mb-2">👥</div>
                        <div class="text-xs text-slate-600 font-semibold mb-1">Total Users</div>
                        <div class="text-3xl font-black text-indigo-700">1,240</div>
                        <div class="text-xs text-teal-500 font-bold mt-1">↑ 12% YoY</div>
                    </div>

                    <div class="p-6 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-2xl mb-2">👨‍🎓</div>
                        <div class="text-xs text-slate-600 font-semibold mb-1">Students</div>
                        <div class="text-3xl font-black text-teal-500">450</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">Active learners</div>
                    </div>

                    <div class="p-6 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-2xl mb-2">✅</div>
                        <div class="text-xs text-slate-600 font-semibold mb-1">Compliance</div>
                        <div class="text-3xl font-black text-teal-500">100%</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">FERPA compliant</div>
                    </div>

                    <div class="p-6 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-2xl mb-2">🔒</div>
                        <div class="text-xs text-slate-600 font-semibold mb-1">Security</div>
                        <div class="text-3xl font-black text-indigo-700">A+</div>
                        <div class="text-xs text-slate-500 font-bold mt-1">Grade</div>
                    </div>

                    <div class="p-6 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-2xl mb-2">🚨</div>
                        <div class="text-xs text-slate-600 font-semibold mb-1">Alerts</div>
                        <div class="text-3xl font-black text-orange-500">2</div>
                        <div class="text-xs text-orange-600 font-bold mt-1">Attention needed</div>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <!-- System Health -->
                        <div class="mb-8 p-8 rounded-3xl bg-white border-2 border-lavender-100">
                            <h2 class="text-2xl font-black text-indigo-700 mb-6">System Health</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-4 rounded-2xl bg-mint-50">
                                    <div>
                                        <div class="font-bold text-slate-900">API Uptime</div>
                                        <div class="text-sm text-slate-600">Last 30 days</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-black text-mint-500">99.98%</div>
                                        <div class="flex gap-1 justify-end mt-2">
                                            <div class="w-1 h-1 rounded-full bg-mint-500"></div>
                                            <div class="w-1 h-1 rounded-full bg-mint-500"></div>
                                            <div class="w-1 h-1 rounded-full bg-mint-500"></div>
                                            <div class="w-1 h-1 rounded-full bg-mint-500"></div>
                                            <div class="w-1 h-1 rounded-full bg-mint-500"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center p-4 rounded-2xl bg-teal-50">
                                    <div>
                                        <div class="font-bold text-slate-900">Database Health</div>
                                        <div class="text-sm text-slate-600">Query performance</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-black text-teal-500">Optimal</div>
                                        <div class="text-xs text-teal-600 font-bold mt-1">Response < 50ms</div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center p-4 rounded-2xl bg-indigo-50">
                                    <div>
                                        <div class="font-bold text-slate-900">Storage</div>
                                        <div class="text-sm text-slate-600">Capacity used</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-black text-indigo-700">45 GB</div>
                                        <div class="text-xs text-indigo-600 font-bold mt-1">of 100 GB total</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Audit Logs -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-indigo-700 mb-6">Recent Audit Logs</h2>
                            <div class="bg-white rounded-3xl border-2 border-lavender-100 overflow-hidden">
                                <div class="overflow-y-auto max-h-64">
                                    <table class="w-full text-sm">
                                        <thead class="bg-lavender-50 border-b border-lavender-100 sticky top-0">
                                            <tr>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">Action</th>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">User</th>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-lavender-100">
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">User login</td>
                                                <td class="px-6 py-4 text-slate-600">admin@eduecho.com</td>
                                                <td class="px-6 py-4 text-slate-600">2 hours ago</td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">IEP created</td>
                                                <td class="px-6 py-4 text-slate-600">teacher@eduecho.com</td>
                                                <td class="px-6 py-4 text-slate-600">4 hours ago</td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Report generated</td>
                                                <td class="px-6 py-4 text-slate-600">admin@eduecho.com</td>
                                                <td class="px-6 py-4 text-slate-600">1 day ago</td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Permission change</td>
                                                <td class="px-6 py-4 text-slate-600">admin@eduecho.com</td>
                                                <td class="px-6 py-4 text-slate-600">2 days ago</td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Backup completed</td>
                                                <td class="px-6 py-4 text-slate-600">System</td>
                                                <td class="px-6 py-4 text-slate-600">3 days ago</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Reports -->
                        <div>
                            <h2 class="text-2xl font-black text-indigo-700 mb-6">Generate Reports</h2>
                            <div class="grid md:grid-cols-2 gap-4">
                                <button class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition text-left group">
                                    <div class="text-3xl mb-3 group-hover:scale-110 transition">📋</div>
                                    <div class="font-black text-slate-900">Compliance Report</div>
                                    <div class="text-sm text-slate-600">FERPA & WCAG audit</div>
                                </button>
                                <button class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition text-left group">
                                    <div class="text-3xl mb-3 group-hover:scale-110 transition">📊</div>
                                    <div class="font-black text-slate-900">User Analytics</div>
                                    <div class="text-sm text-slate-600">Platform usage metrics</div>
                                </button>
                                <button class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition text-left group">
                                    <div class="text-3xl mb-3 group-hover:scale-110 transition">🔒</div>
                                    <div class="font-black text-slate-900">Security Report</div>
                                    <div class="text-sm text-slate-600">Access & encryption audit</div>
                                </button>
                                <button class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition text-left group">
                                    <div class="text-3xl mb-3 group-hover:scale-110 transition">⚠️</div>
                                    <div class="font-black text-slate-900">Error Logs</div>
                                    <div class="text-sm text-slate-600">System issues & debugging</div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Governance -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Governance</h3>
                            <div class="space-y-3">
                                <button class="w-full px-4 py-3 rounded-2xl bg-indigo-700 text-white font-bold hover:shadow-lg transition text-left text-sm">
                                    ⚖️ Policy Tracking
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-white border-2 border-lavender-100 text-slate-900 font-bold hover:bg-lavender-50 transition text-left text-sm">
                                    📋 Conduct Records
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-white border-2 border-lavender-100 text-slate-900 font-bold hover:bg-lavender-50 transition text-left text-sm">
                                    ✓ Compliance Log
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-white border-2 border-lavender-100 text-slate-900 font-bold hover:bg-lavender-50 transition text-left text-sm">
                                    🚨 Incident Reports
                                </button>
                            </div>
                        </div>

                        <!-- Staff Management -->
                        <div class="mb-8 p-6 rounded-3xl bg-white border-2 border-lavender-100">
                            <h3 class="text-2xl font-black text-indigo-700 mb-6">Staff</h3>
                            <div class="space-y-4">
                                <div class="p-3 rounded-2xl bg-indigo-50">
                                    <div class="text-2xl font-black text-indigo-700">5</div>
                                    <div class="text-xs text-slate-600 font-semibold">Administrators</div>
                                </div>
                                <div class="p-3 rounded-2xl bg-teal-50">
                                    <div class="text-2xl font-black text-teal-600">34</div>
                                    <div class="text-xs text-slate-600 font-semibold">Educators</div>
                                </div>
                                <div class="p-3 rounded-2xl bg-mint-50">
                                    <div class="text-2xl font-black text-mint-600">12</div>
                                    <div class="text-xs text-slate-600 font-semibold">Therapists</div>
                                </div>
                            </div>
                        </div>

                        <!-- Settings -->
                        <div>
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Settings</h3>
                            <div class="space-y-3">
                                <button class="w-full px-4 py-3 rounded-2xl bg-indigo-700 text-white font-bold hover:shadow-lg transition text-left text-sm">
                                    ⚙️ System Config
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-white border-2 border-lavender-100 text-slate-900 font-bold hover:bg-lavender-50 transition text-left text-sm">
                                    💾 Backup & Recovery
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-white border-2 border-lavender-100 text-slate-900 font-bold hover:bg-lavender-50 transition text-left text-sm">
                                    📧 Email Templates
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
