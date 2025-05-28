<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplikasi Todo List sederhana untuk mengatur tugas harian Anda">

        <title>TodoList App - Kelola Tugas Harian Anda</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .hero-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Navbar -->
        <div class="navbar bg-base-100 shadow-sm">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#how-it-works">Cara Kerja</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                    </ul>
                </div>
                <a class="btn btn-ghost text-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    TodoList App
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#how-it-works">Cara Kerja</a></li>
                    <li><a href="#testimonials">Testimoni</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-ghost">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary ml-2">
                            Daftar
                            </a>
                        @endif
                    @endauth
                @endif
                <label class="swap swap-rotate ml-4">
                    <input type="checkbox" class="theme-controller hidden" value="dark" />
                    <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/></svg>
                    <svg class="swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/></svg>
                </label>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero min-h-screen hero-pattern">
            <div class="hero-content text-center">
                <div class="max-w-4xl">
                    <h1 class="text-5xl font-bold">Kelola Tugas Harian Anda dengan Mudah</h1>
                    <p class="py-6 text-lg">
                        TodoList App membantu Anda mengorganisir tugas, menetapkan prioritas, dan meningkatkan produktivitas. 
                        Mulai sekarang dan rasakan perbedaannya!
                    </p>
                    <div class="flex gap-4 justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a>
                            <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                        @endauth
                    </div>
                    
                    <div class="mockup-window border bg-base-300 mt-12">
                        <div class="flex justify-center px-4 py-16 bg-base-200">
                            <div class="card w-full max-w-2xl bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h2 class="card-title">Daftar Tugas Saya</h2>
                                    <div class="divider my-0"></div>
                                    <div class="flex items-center gap-2">
                                        <input type="text" placeholder="Tambah tugas baru..." class="input input-bordered w-full" />
                                        <button class="btn btn-primary">Tambah</button>
                                    </div>
                                    <div class="mt-4 space-y-2">
                                        <div class="flex items-center gap-4 p-2 hover:bg-base-200 rounded-lg">
                                            <input type="checkbox" checked="checked" class="checkbox checkbox-primary" />
                                            <span class="flex-1 line-through opacity-70">Buat presentasi proyek</span>
                                            <button class="btn btn-ghost btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex items-center gap-4 p-2 hover:bg-base-200 rounded-lg">
                                            <input type="checkbox" class="checkbox checkbox-primary" />
                                            <span class="flex-1">Kirim laporan ke tim</span>
                                            <span class="badge badge-warning">Penting</span>
                                            <button class="btn btn-ghost btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex items-center gap-4 p-2 hover:bg-base-200 rounded-lg">
                                            <input type="checkbox" class="checkbox checkbox-primary" />
                                            <span class="flex-1">Beli bahan makanan</span>
                                            <span class="badge badge-info">Personal</span>
                                            <button class="btn btn-ghost btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-16 px-12 bg-base-100">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Fitur Unggulan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 rounded-full bg-primary/10 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="card-title">Manajemen Tugas</h3>
                            </div>
                            <p>Buat, edit, dan hapus tugas dengan mudah. Atur tugas Anda dalam daftar yang terorganisir.</p>
                        </div>
                    </div>
                    
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 rounded-full bg-secondary/10 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="card-title">Pengingat Waktu</h3>
                            </div>
                            <p>Atur tenggat waktu dan dapatkan pengingat untuk tugas penting yang harus diselesaikan.</p>
                        </div>
                    </div>
                    
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 rounded-full bg-accent/10 text-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <h3 class="card-title">Prioritas Tugas</h3>
                            </div>
                            <p>Tandai tugas dengan tingkat prioritas berbeda untuk fokus pada yang paling penting.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div id="how-it-works" class="py-16 px-32 bg-base-200">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Cara Kerja</h2>
                <div class="flex flex-col lg:flex-row gap-8 items-center">
                    <div class="flex-1">
                        <div class="space-y-8">
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">1</div>
                                    <div class="w-0.5 h-full bg-gray-300"></div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2">Buat Akun</h3>
                                    <p>Daftar akun gratis dalam hitungan detik. Tidak perlu informasi kartu kredit.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-6 bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">2</div>
                                    <div class="w-0.5 h-full bg-gray-300"></div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2">Tambah Tugas</h3>
                                    <p>Mulai tambahkan tugas yang perlu Anda selesaikan. Anda bisa menambahkan deskripsi dan tenggat waktu.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-6 bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">3</div>
                                    <div class="w-0.5 h-full bg-gray-300"></div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2">Atur Prioritas</h3>
                                    <p>Tandai tugas penting dengan prioritas tinggi untuk fokus pada hal yang benar-benar penting.</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-6 bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">4</div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2">Selesaikan & Raih Produktivitas</h3>
                                    <p>Centang tugas yang sudah selesai dan lihat produktivitas Anda meningkat!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Productivity" class="rounded-lg shadow-lg" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div id="testimonials" class="py-16 bg-base-100">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Apa Kata Mereka</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="rating mb-4">
                                <input type="radio" name="rating-1" class="mask mask-star" checked />
                                <input type="radio" name="rating-1" class="mask mask-star" checked />
                                <input type="radio" name="rating-1" class="mask mask-star" checked />
                                <input type="radio" name="rating-1" class="mask mask-star" checked />
                                <input type="radio" name="rating-1" class="mask mask-star" checked />
                            </div>
                            <p class="mb-6">"Aplikasi ini benar-benar mengubah cara saya mengatur pekerjaan. Sekarang saya tidak pernah melewatkan deadline penting!"</p>
                            <div class="flex items-center gap-4">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://randomuser.me/api/portraits/women/43.jpg" />
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Sarah Johnson</h4>
                                    <p class="text-sm opacity-70">Project Manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="rating mb-4">
                                <input type="radio" name="rating-2" class="mask mask-star" checked />
                                <input type="radio" name="rating-2" class="mask mask-star" checked />
                                <input type="radio" name="rating-2" class="mask mask-star" checked />
                                <input type="radio" name="rating-2" class="mask mask-star" checked />
                                <input type="radio" name="rating-2" class="mask mask-star" />
                            </div>
                            <p class="mb-6">"Sederhana tapi powerful. Aplikasi ini membantu saya tetap produktif baik di pekerjaan maupun kehidupan pribadi."</p>
                            <div class="flex items-center gap-4">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" />
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Michael Chen</h4>
                                    <p class="text-sm opacity-70">Software Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body">
                            <div class="rating mb-4">
                                <input type="radio" name="rating-3" class="mask mask-star" checked />
                                <input type="radio" name="rating-3" class="mask mask-star" checked />
                                <input type="radio" name="rating-3" class="mask mask-star" checked />
                                <input type="radio" name="rating-3" class="mask mask-star" checked />
                                <input type="radio" name="rating-3" class="mask mask-star" checked />
                            </div>
                            <p class="mb-6">"Sebagai mahasiswa, aplikasi ini sangat membantu mengatur jadwal kuliah, tugas, dan kegiatan ekstrakurikuler."</p>
                            <div class="flex items-center gap-4">
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" />
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Diana Putri</h4>
                                    <p class="text-sm opacity-70">Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-16 bg-base-300 text-primary-content">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-6">Siap Meningkatkan Produktivitas Anda?</h2>
                <p class="text-xl mb-8">Bergabunglah dengan ribuan pengguna yang telah merasakan manfaat TodoList App.</p>
                <div class="flex gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Gratis</a>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-outline-white">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer p-10 bg-neutral text-neutral-content flex gap-32">
            <aside>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p>TodoList App<br/>Membantu Anda lebih produktif sejak 2025</p>
            </aside> 
            <nav>
                <h6 class="footer-title">Perusahaan</h6> 
                <a class="link link-hover">Tentang Kami</a>
                <a class="link link-hover">Karir</a>
                <a class="link link-hover">Kontak</a>
            </nav> 
            <nav>
                <h6 class="footer-title">Legal</h6> 
                <a class="link link-hover">Syarat Penggunaan</a>
                <a class="link link-hover">Kebijakan Privasi</a>
                <a class="link link-hover">Kebijakan Cookie</a>
            </nav>
        </footer>
        <footer class="footer px-10 py-4 border-t bg-neutral text-neutral-content border-base-300">
            <aside class="items-center grid-flow-col">
                <p>© 2025 TodoList App. All rights reserved.</p>
            </aside> 
            <nav class="md:place-self-center md:justify-self-end">
                <div class="grid grid-flow-col gap-4">
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>
                </div>
            </nav>
        </footer>

        <!-- Dark mode toggle script -->
        <script>
            // Check for saved theme preference or use system preference
            const themeToggle = document.querySelector('.theme-controller');
            const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
            
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeToggle.checked = true;
            }
            
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                }
            });
        </script>
    </body>
</html>