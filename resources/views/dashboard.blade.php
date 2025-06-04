<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
            {{ __('Todo List Application') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-2xl font-bold mb-6">Category</h1>
            <div class="flex overflow-x-auto pb-4 space-x-4">
                @foreach ($categories as $index => $category)
                    @php
                        $colors = ['bg-error', 'bg-warning', 'bg-success'];
                        $textColors = ['text-error-content', 'text-warning-content', 'text-success-content'];
                        $colorIndex = $index % count($colors);
                    @endphp
                    
                    <div class="card {{ $colors[$colorIndex] }} {{ $textColors[$colorIndex] }} w-80 flex-shrink-0">
                        <div class="card-body">
                            <h2 class="card-title">{{ $category->category_name }}</h2>
                            <div class="card-actions justify-end">
                                <button class="btn">Filter Tugas</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-base-100 shadow rounded-lg p-6">
                {{-- Add Task Button --}}
                <div class="mb-4 flex justify-center items-center">
                    <div></div>
                    <h1 class="text-3xl font-bold mb-8 mt-10 text-center">My Tasks</h1>
                    @role('user')
                    <a href="{{ route('task.create') }}" class="btn btn-primary gap-2 absolute right-32">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Task
                    </a>
                    @endrole
                </div>
 <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('task.index') }}" class="flex items-center gap-4">
                            <div class="flex-1">
                                <x-text-input id="search" name="search" type="text" class="w-full"
                                    placeholder="Search tasks..." value="{{ request('search') }}" />
                            </div>
                            <x-primary-button type="submit">
                                Search
                            </x-primary-button>
                            @if (request('search'))
                                <a href="{{ route('task.index') }}"
                                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>
                {{-- Task Table --}}
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Task</th>
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
                                <tr>
                                    <td>
                                        <div class="font-semibold">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $task->description }}</div>
                                    </td>
                                    @role('admin')
                                        <td>
                                            <div class="font-semibold">{{ $task->user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $task->user->email }}</div>
                                        </td>
                                    @endrole
                                    <td>
                                        @if($task->status == 'completed')
                                            <div class="badge badge-success">{{ $task->status }}</div>
                                        @elseif($task->status == 'in_progress')
                                            <div class="badge badge-warning">{{ $task->status }}</div>
                                        @else
                                            <div class="badge badge-error">{{ $task->status }}</div>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                                    <td class="text-right">
                                                @role('user')
                                                <a href="{{ route('task.edit', $task->task_id) }}">
                                                    <button
                                                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                    </button>
                                                </a>
                                                @endrole
                                                <a href="#"
                                                    onclick="confirmDelete('{{ route('task.destroy', $task->task_id) }}', '{{ $task->title }}')">
                                                    <form id="delete-form-{{ $task->task_id }}" method="POST"
                                                        action="{{ route('task.destroy', $task->task_id) }}"
                                                        class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button
                                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No tasks available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
