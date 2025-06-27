<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task') }} '{{ $task->title }}'
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <div class="card bg-base-100 shadow-md">
                    <div class="card-body">
                        <h3 class="card-title text-lg font-bold mb-4">Task Details</h3>

                        <div class="space-y-2">
                            <p><span class="font-semibold">Name:</span> {{ $task->title}}</p>
                            <p><span class="font-semibold">Description:</span> {{ $task->description }}</p>
                            <p><span class="font-semibold">Due Date:</span> {{ $task->due_date }}</p>
                            <p><span class="font-semibold">Status:</span> {{ $task->status }}</p>
                            <p><span class="font-semibold">Created At:</span> {{ $task->created_at->format('d M Y, H:i') }}</p>
                            <p><span class="font-semibold">Updated At:</span> {{ $task->updated_at->format('d M Y, H:i') }}</p>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('task.index') }}" class="btn btn-secondary">← Back to Task List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
