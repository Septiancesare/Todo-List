<section>
    <form method="post" action="{{ route('task.store') }}" class="space-y-6">
        @csrf


        <div>
            <x-input-label for="category" :value="__('Task Category')" />
            <select id="category" name="category_id"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                <option value="" disabled selected>{{ __('Select a category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        <div>
            <x-input-label for="title" :value="__('Task Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')"
                required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        {{-- choose status [in progress, completed, pending] --}}
        <div>
            <x-input-label for="status" :value="__('Task Status')" />
            <select id="status" name="status"
                class="status-select border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                <option value="" disabled selected>{{ __('Select a status') }}</option>
                <option value="in-progress" class="text-yellow-500">{{ __('In Progress') }}</option>
                <option value="completed" class="text-green-500">{{ __('Completed') }}</option>
                <option value="pending" class="text-red-500">{{ __('Pending') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Task Description')" />
            <textarea id="description" name="description"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="due_date" :value="__('Due Date')" />
            <div class="relative">
                <x-text-input id="due_date" name="due_date" type="text" class="mt-1 block w-full datepicker"
                    :value="old('due_date')" placeholder="Choose date" required />
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
            <x-primary-button>{{ __('Create Task') }}</x-primary-button>

            @if (session('status') === 'task-created')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Task Created.') }}</p>
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

            // Update warna saat nilai berubah
            statusSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                this.classList.remove(
                    'text-yellow-500',
                    'text-green-500',
                    'text-red-500',
                    'dark:text-gray-300'
                );

                if (selectedOption.value !== '') {
                    this.classList.add(selectedOption.className);
                } else {
                    this.classList.add('dark:text-gray-300');
                }
            });

            if (statusSelect.value !== '') {
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                statusSelect.classList.add(selectedOption.className);
            }
        });
    </script>
</section>
