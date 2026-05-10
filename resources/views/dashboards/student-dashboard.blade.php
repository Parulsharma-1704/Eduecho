<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduEcho</title>
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
                    <span class="text-xl">📚</span> Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📖</span> My Courses
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">📈</span> Progress
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">🧠</span> AI Assistant
                </a>
                <a href="#" class="flex items-center gap-4 p-4 rounded-2xl text-slate-700 font-bold hover:bg-lavender-50 transition">
                    <span class="text-xl">♿</span> Accessibility
                </a>
            </nav>

            <div class="mt-12 pt-8 border-t border-lavender-100">
                <div class="p-4 rounded-2xl bg-lavender-50">
                    <h4 class="font-black text-indigo-700 mb-2">Quick Tips</h4>
                    <p class="text-sm text-slate-600">Complete your courses this week to earn rewards!</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto gradient-lavender p-12">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-5xl font-black text-indigo-700 mb-3">Welcome Back, Alex! 👋</h1>
                    <p class="text-lg text-indigo-600">Great progress this week. Keep it up!</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📚</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Active Courses</div>
                        <div class="text-4xl font-black text-indigo-700">5</div>
                        <div class="text-xs text-teal-500 font-bold mt-2">↑ 2 this month</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">📈</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Overall Progress</div>
                        <div class="text-4xl font-black text-teal-500">72%</div>
                        <div class="w-full bg-lavender-100 rounded-full h-2 mt-3"><div class="bg-gradient-to-r from-teal-400 to-teal-500 h-2 rounded-full" style="width: 72%"></div></div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">✏️</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Assignments</div>
                        <div class="text-4xl font-black text-indigo-700">3</div>
                        <div class="text-xs text-orange-500 font-bold mt-2">Due this week</div>
                    </div>

                    <div class="p-8 rounded-3xl bg-white shadow-md border-2 border-lavender-100 hover:shadow-lg transition-all">
                        <div class="text-3xl mb-3">🔥</div>
                        <div class="text-sm text-slate-600 font-semibold mb-2">Learning Streak</div>
                        <div class="text-4xl font-black text-teal-500">12</div>
                        <div class="text-xs text-slate-500 font-bold mt-2">Days in a row</div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Courses -->
                    <div class="lg:col-span-2">
                        <h2 class="text-3xl font-black text-indigo-700 mb-6">Active Courses</h2>
                        <div class="space-y-4">
                            <!-- Course 1 -->
                            <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900">Mathematics Fundamentals</h3>
                                        <p class="text-slate-600">Numbers & Operations</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-teal-100 text-teal-700 font-bold text-sm">In Progress</span>
                                </div>
                                <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-gradient-to-r from-teal-400 to-teal-500 h-3 rounded-full" style="width: 65%"></div></div>
                                <div class="flex justify-between mt-2 text-sm text-slate-600">
                                    <span>65% Complete</span>
                                    <span>8/12 Lessons</span>
                                </div>
                            </div>

                            <!-- Course 2 -->
                            <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900">Reading Comprehension</h3>
                                        <p class="text-slate-600">Literature & Stories</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm">In Progress</span>
                                </div>
                                <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-gradient-to-r from-indigo-400 to-indigo-600 h-3 rounded-full" style="width: 48%"></div></div>
                                <div class="flex justify-between mt-2 text-sm text-slate-600">
                                    <span>48% Complete</span>
                                    <span>5/10 Lessons</span>
                                </div>
                            </div>

                            <!-- Course 3 -->
                            <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900">Science Exploration</h3>
                                        <p class="text-slate-600">Nature & Discovery</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full bg-mint-100 text-mint-600 font-bold text-sm">Completed</span>
                                </div>
                                <div class="w-full bg-lavender-100 rounded-full h-3"><div class="bg-gradient-to-r from-mint-400 to-mint-500 h-3 rounded-full" style="width: 100%"></div></div>
                                <div class="flex justify-between mt-2 text-sm text-slate-600">
                                    <span>100% Complete</span>
                                    <span>12/12 Lessons</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Upcoming Sessions -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-black text-indigo-700 mb-4">Upcoming Sessions</h3>
                            <div class="space-y-3">
                                <div class="p-4 rounded-2xl bg-white border-2 border-teal-200">
                                    <div class="font-bold text-slate-900">Speech Therapy</div>
                                    <div class="text-sm text-slate-600">Today, 2:00 PM</div>
                                    <div class="flex gap-2 mt-3">
                                        <button class="flex-1 px-3 py-2 rounded-lg bg-teal-500 text-white font-bold text-sm hover:bg-teal-600">Join</button>
                                    </div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white border-2 border-coral-200">
                                    <div class="font-bold text-slate-900">Occupational Therapy</div>
                                    <div class="text-sm text-slate-600">Tomorrow, 10:30 AM</div>
                                    <div class="text-xs text-slate-500 mt-3">Not started</div>
                                </div>
                            </div>
                        </div>

                        <!-- Accessibility Settings -->
                        <div class="p-6 rounded-3xl bg-white border-2 border-lavender-100">
                            <h3 class="font-black text-slate-900 mb-4">Accessibility</h3>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-5 h-5 rounded text-teal-500">
                                    <span class="text-sm font-semibold text-slate-700">Large Font</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-5 h-5 rounded text-teal-500">
                                    <span class="text-sm font-semibold text-slate-700">Dark Mode</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" class="w-5 h-5 rounded text-teal-500">
                                    <span class="text-sm font-semibold text-slate-700">Text-to-Speech</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
