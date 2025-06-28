<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List Application') }}
        </h2>
    </x-slot>

    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        List Category
                    </h3>
                    @role('user')
                    <button
                        onclick="document.getElementById('add-category-form').classList.toggle('hidden')"
                        class="btn btn-primary w-full sm:w-auto"
                    >
                        Add Category
                    </button>
                    @endrole
                </div>

                {{-- Add Category Form --}}
                <div id="add-category-form" class="hidden mb-6">
                    <form action="{{ route('category.store') }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                        @csrf
                        <input 
                            type="text" 
                            name="category_name" 
                            placeholder="Enter category name"
                            class="input input-bordered w-full"
                            required
                        >
                        <button type="submit" class="btn btn-primary flex-shrink-0">Save</button>
                        <button 
                            type="button" 
                            onclick="document.getElementById('add-category-form').classList.add('hidden')"
                            class="btn btn-ghost flex-shrink-0"
                        >
                            Cancel
                        </button>
                    </form>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                    <form method="GET" action="{{ route('category.index') }}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search categories..."
                                class="input input-bordered w-full sm:w-60"
                            />
                            <button type="submit" class="btn btn-primary flex-shrink-0">Search</button>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('category.index') }}" class="btn btn-ghost sm:self-stretch">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="whitespace-nowrap">Category Name</th>
                                @role('admin')
                                    <th class="whitespace-nowrap">User</th>
                                @endrole
                                <th class="whitespace-nowrap hidden sm:table-cell">Created At</th>
                                <th class="whitespace-nowrap hidden md:table-cell">Updated At</th>
                                <th class="whitespace-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $category->category_name }}</td>
                                    @role('admin')
                                        <th class="whitespace-nowrap">{{ $category->user->name }}</th>
                                    @endrole
                                    <td class="whitespace-nowrap hidden sm:table-cell">{{ $category->created_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap hidden md:table-cell">{{ $category->updated_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap">
                                        <div class="flex flex-wrap gap-1 sm:gap-2">
                                            @role('user')
                                            <button
                                                onclick="openEditModal('{{ $category->id }}', '{{ addslashes($category->category_name) }}')"
                                                class="btn btn-sm btn-warning"
                                            >
                                                Edit
                                            </button>
                                            @endrole
                                            <form 
                                                action="{{ route('category.destroy', $category) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Are you sure to delete this category?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4 px-2 sm:px-0">
                    {{ $categories->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">Edit Category</h3>
                    <form id="edit-form" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="category_id" id="modal-category-id">
                        <div>
                            <label for="modal-category-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                            <input type="text" name="category_name" id="modal-category-name" 
                                   class="mt-1 input input-bordered w-full" required>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeEditModal()" 
                                    class="btn btn-ghost">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="btn btn-primary">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, name) {
            document.getElementById('modal-category-id').value = id;
            document.getElementById('modal-category-name').value = name;
            
            const form = document.getElementById('edit-form');
            form.action = `/category/${id}`;
            
            document.getElementById('edit-modal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        document.getElementById('edit-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
</x-app-layout>