<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List Application') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                                <tr
                                    class="text-left font-medium text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 px-4">Task</th>
                                    <th class="pb-3 px-4">Status</th>
                                    <th class="pb-3 px-4">Due Date</th>
                                    <th class="pb-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Showing Task using looping -->
                                @foreach ($tasks as $task)
                                    <tr
                                        class="hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                        <td class="py-3 px-4">
                                            <div class="font-medium">{{ $task->title }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $task->description }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($task->status == 'completed')
                                                <div class="badge badge-soft badge-success">{{ $task->status }}</div>
                                            @elseif($task->status == 'in_progress')
                                                <div class="badge badge-soft badge-warning">{{ $task->status }}</div>
                                            @else
                                                <div class="badge badge-soft badge-error">{{ $task->status }}</div>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $task->due_date }}
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <div class="flex justify-end space-x-2">
                                                <button
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </button>
                                                <button
                                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>

                    <!-- Add New Task Button route to taskpage -->

                    <div class="mt-6">
                        <a href="{{ route('task.create') }}">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add New Task
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>