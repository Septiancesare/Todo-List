<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Details') }}, "{{ $task->title }}"
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <!-- Task Header -->
                <div class="bg-gray-800 p-6 text-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-bold">{{ $task->title }}</h1>
                            <p class="text-primary-content opacity-90 mt-1">
                                Created: {{ $task->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="badge badge-lg {{ $task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-warning' : 'badge-error') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </div>
                    </div>
                </div>

                <!-- Task Content -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Description Card -->
                        <div class="card bg-base-100 dark:bg-gray-700 shadow-sm border border-gray-200 dark:border-gray-600">
                            <div class="card-body">
                                <h3 class="card-title text-lg font-semibold flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Description
                                </h3>
                                <div class="prose dark:prose-invert max-w-none">
                                    {!! nl2br(e($task->description)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Meta Information Card -->
                        <div class="card bg-base-100 dark:bg-gray-700 shadow-sm border border-gray-200 dark:border-gray-600">
                            <div class="card-body space-y-4">
                                <div>
                                    <h3 class="card-title text-lg font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Details
                                    </h3>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Due Date</p>
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($task->due_date);
                                                $isOverdue = $dueDate->isPast() && $task->status !== 'completed';
                                            @endphp
                                            <p class="font-medium">{{ $dueDate->format('l, F j, Y') }}</p>
                                            <p class="text-sm {{ $isOverdue ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
                                                {{ $isOverdue ? 'Overdue' : $dueDate->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Last Updated</p>
                                            <p class="font-medium">{{ $task->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                        </div>
                                    </div>

                                    @if($task->category)
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Category</p>
                                            <span class="badge badge-outline">{{ $task->category->category_name }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('task.index') }}" class="btn btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Tasks
                        </a>
                        @role('user')
                        <a href="{{ route('task.edit', $task) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Task
                        </a>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>