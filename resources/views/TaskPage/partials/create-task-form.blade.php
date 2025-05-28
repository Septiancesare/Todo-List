<section>
    <form method="POST" action="{{ route('task.store') }}" class="space-y-6">
        @csrf

        {{-- Task Category --}}
        <div class="form-control w-full">
            <label for="category" class="label">
                <span class="label-text text-base-content">{{ __('Task Category') }}</span>
            </label>
            <select id="category" name="category_id" class="select select-bordered w-full">
                <option value="" disabled selected>{{ __('Select a category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        {{-- Task Title --}}
        <div class="form-control w-full">
            <label for="title" class="label">
                <span class="label-text text-base-content">{{ __('Task Title') }}</span>
            </label>
            <input id="title" name="title" type="text" class="input input-bordered w-full"
                value="{{ old('title') }}" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        {{-- Task Status --}}
        <div class="form-control w-full">
            <label for="status" class="label">
                <span class="label-text text-base-content">{{ __('Task Status') }}</span>
            </label>
            <select id="status" name="status" class="select select-bordered w-full status-select">
                <option value="" disabled selected>{{ __('Select a status') }}</option>
                <option value="in_progress" class="text-yellow-500">{{ __('In Progress') }}</option>
                <option value="completed" class="text-green-500">{{ __('Completed') }}</option>
                <option value="pending" class="text-red-500">{{ __('Pending') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        {{-- Task Description --}}
        <div class="form-control w-full">
            <label for="description" class="label">
                <span class="label-text text-base-content">{{ __('Task Description') }}</span>
            </label>
            <textarea id="description" name="description" class="textarea textarea-bordered w-full"
                rows="4">{{ old('description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        {{-- Due Date --}}
        <div class="form-control w-full">
            <label for="due_date" class="label">
                <span class="label-text text-base-content">{{ __('Due Date') }}</span>
            </label>
            <div class="relative">
                <input id="due_date" name="due_date" type="text"
                    class="input input-bordered w-full datepicker" value="{{ old('due_date') }}"
                    placeholder="Choose date" required />
                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
        </div>

        {{-- Submit Button --}}
        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary">{{ __('Create Task') }}</button>
            <a href="{{ route('task.index') }}" class="btn btn-outline">Cancel</a>
            @if (session('status') === 'task-created')
                <p x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success mt-2">{{ __('Task Created.') }}</p>
            @endif
        </div>
    </form>

    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                allowInput: true,
                disableMobile: false
            });

            const statusSelect = document.querySelector('.status-select');
            statusSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                this.classList.remove(
                    'text-yellow-500',
                    'text-green-500',
                    'text-red-500'
                );

                if (selectedOption.value !== '') {
                    this.classList.add(selectedOption.className);
                }
            });

            if (statusSelect.value !== '') {
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                statusSelect.classList.add(selectedOption.className);
            }
        });
    </script>
</section>
