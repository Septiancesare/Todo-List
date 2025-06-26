<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            {{ __('Task Category') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 space-y-6">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Grid Container --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Kiri: Daftar Kategori --}}
            <div class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded shadow">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">List Category</h2>

                <div class="space-y-3">
                    @forelse ($categories as $category)
                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-700 p-3 rounded hover:shadow transition">
                            <div class="text-gray-800 dark:text-white font-medium">
                                {{ $category->name }}
                            </div>
                            <div class="flex items-center gap-2">
                                {{-- Edit Button --}}
                                <button onclick="document.getElementById('edit-form-{{ $category->id }}').classList.toggle('hidden')" 
                                    class="text-blue-500 hover:underline text-sm">Edit</button>

                                {{-- Delete Form --}}
                                <form action="{{ route('category.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete Category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline text-sm">Hapus</button>
                                </form>
                            </div>
                        </div>

                        {{-- Form Edit (Hidden) --}}
                        <div id="edit-form-{{ $category->id }}" class="hidden mt-2">
                            <form action="{{ route('category.update', $category->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" 
                                    class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white" required>
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Simpan</button>
                            </form>
                        </div>
                    @empty
                        <div class="text-gray-500 dark:text-gray-300">No categories added yet.</div>
                    @endforelse
                </div>
            </div>

            {{-- Kanan: Form Tambah --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Add New Category</h2>
                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 mb-1">Category Name</label>
                        <input type="text" name="name" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
