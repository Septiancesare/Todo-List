<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
            {{ __('Todo List Application') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <!-- Header and Add Task Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">My Tasks</h1>
                    @role('user')
                    <a href="{{ route('task.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Task
                    </a>
                    @endrole
                </div>

               <!-- Filter and Search Section -->
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <!-- Category Dropdown Filter -->
                    @role('user')
                    <div class="w-full sm:w-64">
                        <label class="label">
                            <span class="label-text">Filter by Category</span>
                        </label>
                        <form method="GET" action="{{ route('task.index') }}" class="join w-full">
                            <select 
                                name="category"
                                class="select select-bordered join-item w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option 
                                        value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    @endrole
                    <div class="w-full sm:w-64">
                        <label class="label">
                            <span class="label-text">Filter by Due Date</span>
                        </label>
                        <form method="GET" action="{{ route('task.index') }}" class="join w-full">
                            <select 
                                name="due_date"
                                class="select select-bordered join-item w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">All Dates</option>
                                <option value="today" {{ request('due_date') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="this_week" {{ request('due_date') == 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="next_week" {{ request('due_date') == 'next_week' ? 'selected' : '' }}>Next Week</option>
                                <option value="overdue" {{ request('due_date') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                        </form>
                    </div>

                    <!-- Search Form -->
                    <div class="flex-1">
                        <label class="label">
                            <span class="label-text">Search Tasks</span>
                        </label>
                        <form method="GET" action="{{ route('task.index') }}" class="flex gap-2">
                            <div class="flex-1 join w-full">
                                <input 
                                    id="search" 
                                    name="search" 
                                    type="text" 
                                    class="input input-bordered join-item w-full" 
                                    placeholder="Search tasks..." 
                                    value="{{ request('search') }}" 
                                />
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <button type="submit" class="btn btn-primary join-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                            @if (request('search') || request('category'))
                                <a href="{{ route('task.index') }}" class="btn btn-ghost">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Task Table -->
                <div class="overflow-x-auto rounded-lg border border-base-200">
                    <table class="table w-full">
                        <thead class="bg-base-200">
                            <tr>
                                <th>Task</th>
                                <th>category</th>
                                @role('admin')
                                    <th>User</th>
                                @endrole
                                <th>Status</th>
                                <th>Due Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr class="hover:bg-base-200">
                                    <td>
                                        <div class="font-semibold">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">{{ $task->description }}</div>
                                    </td>
                                    <td>
                                        <div class="font-semibold">{{ $task->category->category_name }}</div>
                                    </td>
                                    @role('admin')
                                        <td>
                                            <div class="font-semibold">{{ $task->user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $task->user->email }}</div>
                                        </td>
                                    @endrole
                                    <td class="whitespace-nowrap">
                                        @if($task->status == 'completed')
                                            <span class="badge badge-success gap-2 w-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="badge badge-warning gap-2 w-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                In Progress
                                            </span>
                                        @else
                                            <span class="badge badge-error gap-2 w-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('task.show', $task->task_id) }}" class="btn btn-sm">
                                                View
                                            </a>
                                            @role('user')
                                            <a href="{{ route('task.edit', $task->task_id) }}" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                                Edit
                                            </a>
                                            @endrole
                                            <button 
                                                type="button" 
                                                onclick="confirmDelete('{{ $task->task_id }}', '{{ $task->title }}')" 
                                                class="btn btn-sm text-error"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Delete
                                            </button>

                                            <form id="delete-form-{{ $task->task_id }}" method="POST" action="{{ route('task.destroy', $task->task_id) }}" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->hasRole('admin') ? 6 : 5 }}" class="text-center py-4">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <p class="mt-2 text-gray-500">No tasks available.</p>
                                            @role('user')
                                            <a href="{{ route('task.create') }}" class="btn btn-primary btn-sm mt-4">
                                                Create your first task
                                            </a>
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                {{-- @if ($tasks->hasPages())
                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</x-app-layout>

 <script>
    function confirmDelete(taskId, taskName) {
        if (confirm(`Are you sure you want to delete "${taskName}"?`)) {
            document.getElementById(`delete-form-${taskId}`).submit();
         }
    }

    function clearFilters() {
        window.location.href = "{{ route('task.index') }}";
    }
</script>