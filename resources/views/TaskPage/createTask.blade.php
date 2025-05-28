<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    @include('TaskPage.partials.create-task-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
