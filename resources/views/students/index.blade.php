<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students') }}
            </h2>
            @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Add New Student
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-6">
                <form method="GET" action="{{ route('students.index') }}" class="flex gap-4">
                    <input type="text" name="search" placeholder="Search by student name..." value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Search</button>
                </form>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Students Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Enrollment Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $student->user->name }}</td>
                                <td class="px-6 py-4">{{ $student->user->email }}</td>
                                <td class="px-6 py-4">{{ $student->enrollment_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    @can('view', $student)
                                        <a href="{{ route('students.show', $student) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    @endcan
                                    @can('update', $student)
                                        <a href="{{ route('students.edit', $student) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    @endcan
                                    @can('delete', $student)
                                        <form method="POST" action="{{ route('students.destroy', $student) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-600">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
