<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit User</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Update user details and permissions</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="btn btn-outline btn-sm sm:btn-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Users
                        </a>
                    </div>

                    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-gray-700 dark:text-gray-300">Name</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    required 
                                    class="input input-bordered w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    placeholder="Enter full name"
                                />
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-gray-700 dark:text-gray-300">Email</span>
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}" 
                                    required 
                                    class="input input-bordered w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    placeholder="Enter email address"
                                />
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">Password Update</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Leave password fields blank if you don't want to change the password</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text text-gray-700 dark:text-gray-300">New Password</span>
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            name="password" 
                                            class="input input-bordered w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                            placeholder="Enter new password"
                                            autocomplete="new-password"
                                        />
                                        <button type="button" class="absolute right-3 top-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" onclick="togglePassword(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text text-gray-700 dark:text-gray-300">Confirm Password</span>
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            class="input input-bordered w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                            placeholder="Confirm new password"
                                            autocomplete="new-password"
                                        />
                                        <button type="button" class="absolute right-3 top-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" onclick="togglePassword(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->can('assign roles'))
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">Roles & Permissions</h4>
                            
                            <div class="form-control">
                                <label class="label cursor-pointer justify-start gap-4">
                                    <input 
                                        type="checkbox" 
                                        name="is_admin" 
                                        class="checkbox checkbox-primary" 
                                        {{ $user->hasRole('admin') ? 'checked' : '' }}
                                    />
                                    <span class="label-text text-gray-700 dark:text-gray-300">Administrator</span>
                                </label>
                                <p class="text-sm text-gray-500 dark:text-gray-400 ml-10 mt-1">Administrators have full access to all features</p>
                            </div>
                        </div>
                        @endif

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
                            <a href="{{ route('users.index') }}" class="btn btn-outline sm:btn-wide">Cancel</a>
                            <button type="submit" class="btn btn-primary sm:btn-wide">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle eye icon
            const svg = button.querySelector('svg');
            if (type === 'text') {
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</x-app-layout>