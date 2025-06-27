<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }} '{{ $task->title }}'
        </h2>
    </x-slot>

    <div class="py-4 ">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg justify-center">
                <div class="">
                    @include('TaskPage.partials.update-task-form', [
                        'task' => $task,
                        'categories' => $categories,
                    ])

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
