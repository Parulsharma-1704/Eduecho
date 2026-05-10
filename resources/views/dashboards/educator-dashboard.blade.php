<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educator Dashboard - EduEcho</title>
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
                    <span class="text-xl">👨‍🏫</span> Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">👥</span> My Students
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📋</span> IEP Goals
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📊</span> Analytics
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📚</span> Resources
                </a>
            </nav>

            <div class="mt-12 pt-8 border-t border-lavender-100">
                <div class="p-4 rounded-2xl bg-lavender-50">
                    <h4 class="font-black text-indigo-700 mb-2">Teaching Tips</h4>
                    <p class="text-sm text-slate-600">Use adaptive content to engage all learners today.</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto gradient-lavender p-12">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-5xl font-black text-indigo-700 mb-3">Educator Dashboard 👨‍🏫</h1>
                    <p class="text-lg text-indigo-600">Manage your students and track their progress</p>
                </div>

                <!-- Stats -->
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">👥</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">My Students</div>
                        <div class="text-4xl font-black text-indigo-700">24</div>
                        <div class="text-xs text-teal-500 font-bold mt-2">✓ All active</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📋</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">IEP Goals</div>
                        <div class="text-4xl font-black text-teal-500">34</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">This month</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">✅</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Tasks Today</div>
                        <div class="text-4xl font-black text-indigo-700">7</div>
                        <div class="text-xs text-orange-500 font-bold mt-2">5 pending</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📄</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Reports</div>
                        <div class="text-4xl font-black text-teal-500">12</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">Completed</div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <!-- Students List -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-3xl font-black text-indigo-700">My Students</h2>
                                <button class="px-6 py-3 rounded-2xl bg-teal-500 text-white font-black hover:bg-teal-600 shadow-md hover:shadow-lg transition-all">+ Add Student</button>
                            </div>
                            <div class="bg-white rounded-3xl border-2 border-lavender-100 overflow-hidden">
                                <div class="overflow-y-auto max-h-80">
                                    <table class="w-full">
                                        <thead class="bg-lavender-50 border-b border-lavender-100">
                                            <tr>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">Name</th>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">Progress</th>
                                                <th class="px-6 py-3 text-left font-black text-slate-900">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-lavender-100">
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Alex M.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-teal-500 h-2 rounded-full" style="width: 72%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">On Track</span></td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Jordan K.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">Good Progress</span></td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Sam P.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-teal-500 h-2 rounded-full" style="width: 58%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-coral-100 text-coral-700 font-bold text-xs rounded-lg">Needs Support</span></td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Casey L.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-mint-500 h-2 rounded-full" style="width: 85%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">Excellent</span></td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Morgan D.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-indigo-600 h-2 rounded-full" style="width: 72%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">On Track</span></td>
                                            </tr>
                                            <tr class="hover:bg-lavender-50 transition">
                                                <td class="px-6 py-4 text-slate-900 font-semibold">Riley S.</td>
                                                <td class="px-6 py-4"><div class="w-24 bg-lavender-100 rounded-full h-2"><div class="bg-teal-500 h-2 rounded-full" style="width: 68%"></div></div></td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">On Track</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- IEP Goals -->
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-3xl font-black text-indigo-700">IEP Goals This Month</h2>
                                <button class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-bold hover:bg-indigo-800">+ New Goal</button>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="p-6 rounded-3xl bg-white border-2 border-mint-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-black text-slate-900">Reading Level 3</h3>
                                        <span class="px-3 py-1 rounded-full bg-mint-100 text-mint-600 font-bold text-xs">Achieved</span>
                                    </div>
                                    <div class="text-sm text-slate-600 mb-3">8/8 students</div>
                                    <div class="w-full bg-lavender-100 rounded-full h-2"><div class="bg-mint-500 h-2 rounded-full" style="width: 100%"></div></div>
                                </div>
                                <div class="p-6 rounded-3xl bg-white border-2 border-teal-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-black text-slate-900">Social Skills</h3>
                                        <span class="px-3 py-1 rounded-full bg-teal-100 text-teal-700 font-bold text-xs">In Progress</span>
                                    </div>
                                    <div class="text-sm text-slate-600 mb-3">6/8 students</div>
                                    <div class="w-full bg-lavender-100 rounded-full h-2"><div class="bg-teal-500 h-2 rounded-full" style="width: 75%"></div></div>
                                </div>
                                <div class="p-6 rounded-3xl bg-white border-2 border-indigo-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-black text-slate-900">Math Basics</h3>
                                        <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 font-bold text-xs">In Progress</span>
                                    </div>
                                    <div class="text-sm text-slate-600 mb-3">7/8 students</div>
                                    <div class="w-full bg-lavender-100 rounded-full h-2"><div class="bg-indigo-600 h-2 rounded-full" style="width: 88%"></div></div>
                                </div>
                                <div class="p-6 rounded-3xl bg-white border-2 border-coral-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-black text-slate-900">Communication</h3>
                                        <span class="px-3 py-1 rounded-full bg-coral-100 text-coral-700 font-bold text-xs">Starting</span>
                                    </div>
                                    <div class="text-sm text-slate-600 mb-3">3/8 students</div>
                                    <div class="w-full bg-lavender-100 rounded-full h-2"><div class="bg-coral-500 h-2 rounded-full" style="width: 38%"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Class Analytics -->
                        <div class="mb-8 p-8 rounded-3xl bg-white border-2 border-lavender-100">
                            <h3 class="text-2xl font-black text-indigo-700 mb-6">Class Analytics</h3>
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm font-bold text-slate-700">Average Progress</span>
                                        <span class="font-black text-indigo-700">78%</span>
                                    </div>
                                    <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-teal-500 h-3 rounded-full" style="width: 78%"></div></div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm font-bold text-slate-700">Attendance Rate</span>
                                        <span class="font-black text-teal-500">91%</span>
                                    </div>
                                    <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-teal-500 h-3 rounded-full" style="width: 91%"></div></div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm font-bold text-slate-700">Goals Achieved</span>
                                        <span class="font-black text-mint-500">34/45</span>
                                    </div>
                                    <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-mint-500 h-3 rounded-full" style="width: 76%"></div></div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <button class="w-full px-4 py-3 rounded-2xl bg-indigo-700 text-white font-bold hover:shadow-lg transition text-left">
                                    📋 Create IEP
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-teal-500 text-white font-bold hover:shadow-lg transition text-left">
                                    ✏️ Grade Assignment
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-mint-500 text-white font-bold hover:shadow-lg transition text-left">
                                    📊 Send Report
                                </button>
                                <button class="w-full px-4 py-3 rounded-2xl bg-coral-500 text-white font-bold hover:shadow-lg transition text-left">
                                    ✓ Mark Attendance
                                </button>
                            </div>
                        </div>

                        <!-- Reminders -->
                        <div>
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Reminders</h3>
                            <div class="space-y-3">
                                <div class="p-4 rounded-2xl bg-coral-100 border-2 border-coral-300">
                                    <div class="font-bold text-coral-900">📋 Report Due Today</div>
                                    <div class="text-xs text-coral-800">Alex's quarterly assessment</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-mint-100 border-2 border-mint-300">
                                    <div class="font-bold text-mint-900">📅 Meeting Scheduled</div>
                                    <div class="text-xs text-mint-800">Parent conference in 2 hours</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
