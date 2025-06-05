<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4 sm:p-6">
                {{-- Filter & Jumlah --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                    <form method="GET" action="{{ route('users.index') }}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search users..."
                                class="input input-bordered w-full sm:w-60"
                            />
                            <button type="submit" class="btn btn-primary flex-shrink-0">Search</button>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('users.index') }}" class="btn btn-ghost sm:self-stretch">Clear</a>
                        @endif
                    </form>
                    <div class="text-sm text-gray-600 dark:text-gray-300 sm:text-right w-full sm:w-auto">
                        Showing <strong>{{ $users->count() }}</strong> of <strong>{{ $users->total() }}</strong> users
                    </div>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="whitespace-nowrap">Name</th>
                                <th class="whitespace-nowrap">Email</th>
                                <th class="whitespace-nowrap hidden sm:table-cell">Created At</th>
                                <th class="whitespace-nowrap hidden md:table-cell">Updated At</th>
                                <th class="whitespace-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap hidden sm:table-cell">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap hidden md:table-cell">{{ $user->updated_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap">
                                        <div class="flex flex-wrap gap-1 sm:gap-2">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4 px-2 sm:px-0">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>