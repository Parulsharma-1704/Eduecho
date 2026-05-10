<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - EduEcho</title>
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
                    <span class="text-xl">👨‍👩‍👧</span> Family Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📊</span> Progress Reports
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📅</span> Appointments
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">💬</span> Messages
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">⚙️</span> Settings
                </a>
            </nav>

            <div class="mt-12 pt-8 border-t border-lavender-100">
                <div class="p-4 rounded-2xl bg-lavender-50">
                    <h4 class="font-black text-indigo-700 mb-2">Support</h4>
                    <p class="text-sm text-slate-600">Contact therapists or educators anytime.</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto gradient-lavender p-12">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-5xl font-black text-indigo-700 mb-3">Welcome, Parents! 👋</h1>
                    <p class="text-lg text-indigo-600">Monitoring your child's growth and development</p>
                </div>

                <!-- Child Selector -->
                <div class="mb-8 flex gap-4">
                    <button class="px-6 py-3 rounded-2xl bg-indigo-700 text-white font-bold hover:bg-indigo-800 shadow-md transition">Alex (Age 10)</button>
                    <button class="px-6 py-3 rounded-2xl bg-white border-2 border-lavender-200 text-slate-700 font-bold hover:bg-lavender-50 transition">Jordan (Age 8)</button>
                </div>

                <!-- Stats -->
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📚</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Academic Progress</div>
                        <div class="text-4xl font-black text-indigo-700">85%</div>
                        <div class="text-xs text-teal-500 font-bold mt-2">↑ Great improvement</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📈</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Monthly Growth</div>
                        <div class="text-4xl font-black text-teal-500">+12%</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">vs last month</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">👥</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Attendance</div>
                        <div class="text-4xl font-black text-teal-500">94%</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">Consistent attendance</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">💬</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">New Messages</div>
                        <div class="text-4xl font-black text-orange-500">2</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">From teachers</div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <!-- Growth Chart -->
                        <div class="p-8 rounded-3xl bg-white border-2 border-lavender-100 mb-8">
                            <h2 class="text-2xl font-black text-indigo-700 mb-6">Growth Chart</h2>
                            <div class="h-64 bg-gradient-lavender rounded-2xl flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-5xl mb-4">📈</div>
                                    <p class="text-slate-600 font-semibold">Visual growth tracking coming soon</p>
                                </div>
                            </div>
                        </div>

                        <!-- Reports -->
                        <div>
                            <h2 class="text-2xl font-black text-indigo-700 mb-6">Recent Reports</h2>
                            <div class="space-y-4">
                                <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-slate-900">Monthly Progress Report</h3>
                                            <p class="text-slate-600 text-sm">April 2026 Summary</p>
                                        </div>
                                        <button class="px-4 py-2 rounded-2xl bg-teal-500 text-white font-bold text-sm hover:bg-teal-600 shadow transition">Download</button>
                                    </div>
                                    <div class="text-sm text-slate-600">Highlights: Strong improvement in math, developing social skills, therapy sessions on track.</div>
                                </div>

                                <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-slate-900">Quarterly Assessment</h3>
                                            <p class="text-slate-600 text-sm">Q1 2026 Review</p>
                                        </div>
                                        <button class="px-4 py-2 rounded-2xl bg-indigo-700 text-white font-bold text-sm hover:bg-indigo-800 shadow transition">Download</button>
                                    </div>
                                    <div class="text-sm text-slate-600">Overall progress is above average. Recommend continued support in speech therapy.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Therapists -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Therapists</h3>
                            <div class="space-y-3">
                                <div class="p-4 rounded-2xl bg-white border-2 border-coral-200">
                                    <div class="font-bold text-slate-900">Ms. Johnson</div>
                                    <div class="text-sm text-slate-600">Speech Therapist</div>
                                    <button class="w-full mt-3 px-3 py-2 rounded-2xl bg-teal-500 text-white font-bold text-sm hover:bg-teal-600 shadow transition">Message</button>
                                </div>
                                <div class="p-4 rounded-2xl bg-white border-2 border-teal-200">
                                    <div class="font-bold text-slate-900">Mr. Smith</div>
                                    <div class="text-sm text-slate-600">Occupational Therapist</div>
                                    <button class="w-full mt-3 px-3 py-2 rounded-lg bg-teal-500 text-white font-bold text-sm hover:bg-teal-600">Message</button>
                                </div>
                            </div>
                        </div>

                        <!-- Appointments -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Upcoming</h3>
                            <div class="space-y-3">
                                <div class="p-4 rounded-2xl bg-white border-2 border-lavender-100">
                                    <div class="text-sm font-bold text-slate-900">Speech Session</div>
                                    <div class="text-xs text-slate-600">Today, 2:00 PM</div>
                                    <span class="inline-block mt-2 px-2 py-1 bg-teal-100 text-teal-700 font-bold text-xs rounded-lg">Scheduled</span>
                                </div>
                                <div class="p-4 rounded-2xl bg-white border-2 border-lavender-100">
                                    <div class="text-sm font-bold text-slate-900">Occupational Therapy</div>
                                    <div class="text-xs text-slate-600">Thu, 10:30 AM</div>
                                    <span class="inline-block mt-2 px-2 py-1 bg-mint-100 text-mint-600 font-bold text-xs rounded-lg">Confirmed</span>
                                </div>
                            </div>
                        </div>

                        <!-- Book Appointment -->
                        <button class="w-full px-6 py-4 rounded-3xl bg-indigo-700 text-white font-black hover:shadow-lg transition">
                            📅 Book Appointment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
