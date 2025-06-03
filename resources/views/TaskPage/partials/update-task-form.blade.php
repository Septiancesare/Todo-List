<section>
    <form method="post" action="{{ route('task.update', ['task' => $task]) }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="category" :value="__('Task Category')" />
            <select id="category" name="category_id"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                <option value="" disabled>{{ __('Select a category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>

        <div>
            <x-input-label for="title" :value="__('Task Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" 
                value="{{ old('title', $task->title) }}" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Task Status')" />
            <select id="status" name="status"
                class="status-select border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                <option value="" disabled>{{ __('Select a status') }}</option>
                <option value="in_progress" class="text-yellow-500" {{ $task->status == 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                <option value="completed" class="text-green-500" {{ $task->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                <option value="pending" class="text-red-500" {{ $task->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Task Description')" />
            <textarea id="description" name="description"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">{{ old('description', $task->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="due_date" :value="__('Due Date')" />
            <div class="relative">
                <x-text-input id="due_date" name="due_date" type="text" class="mt-1 block w-full datepicker"
                    value="{{ old('due_date', $task->due_date) }}" placeholder="Choose date" required />
                <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update Task') }}</x-primary-button>

            @if (session('status') === 'task-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Task Updated.') }}</p>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                allowInput: true,
                disableMobile: false
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.querySelector('.status-select');
            
            // Set initial color based on selected option
            const updateStatusColor = () => {
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                statusSelect.classList.remove(
                    'text-yellow-500',
                    'text-green-500',
                    'text-red-500',
                    'dark:text-gray-300'
                );
                
                if (selectedOption.value !== '') {
                    statusSelect.classList.add(selectedOption.className);
                } else {
                    statusSelect.classList.add('dark:text-gray-300');
                }
            };
            
            // Update warna saat nilai berubah
            statusSelect.addEventListener('change', updateStatusColor);
            
            // Initialize color
            updateStatusColor();
        });
    </script>
</section>