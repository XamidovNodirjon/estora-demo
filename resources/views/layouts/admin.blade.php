<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Estora</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-navy: #061c3f;
            --secondary-navy: #0B2240;
            --accent-blue: #0084ff;
            --accent-blue-hover: #0076e5;
            --accent-orange: #ff9e0d;
            --accent-orange-hover: #e58d05;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #f8f9fa;
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .font-display {
            font-family: var(--font-display);
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-50">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0B2240] text-white flex flex-col fixed inset-y-0 left-0 z-20 shadow-xl transition-all duration-300">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-navy-800 bg-[#061c3f]">
            <a href="/" class="flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-[#ff9e0d] text-2xl"></i>
                <span class="font-display font-extrabold text-xl tracking-wider text-white">ESTORA <span class="text-[#0084ff] text-xs font-bold">ADMIN</span></span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-house-laptop text-lg"></i>
                <span>Boshqaruv Paneli</span>
            </a>

            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('admin.users*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-users text-lg"></i>
                <span>Foydalanuvchilar</span>
            </a>

            <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('admin.categories*') || request()->routeIs('admin.subcategories*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-list text-lg"></i>
                <span>Kategoriyalar</span>
            </a>

            <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('admin.products*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-city text-lg"></i>
                <span>E'lonlar</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-file-signature text-lg"></i>
                <span>Shartnomalar</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-wallet text-lg"></i>
                <span>To'lovlar</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-sliders text-lg"></i>
                <span>Sozlamalar</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-navy-800 bg-[#061c3f]">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#ff9e0d] flex items-center justify-center font-bold text-white text-lg shadow-md font-display">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h4 class="font-semibold text-sm truncate max-w-[140px]">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                    <span class="text-xs text-gray-400">{{ Auth::user()->role->name === 'admin' ? 'Bosh Admin' : 'Hodim' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium transition-all shadow-md">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Chiqish</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="pl-64 flex-1 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-10 backdrop-blur-md bg-white/80">
            <div class="flex items-center gap-4">
                <h1 class="font-display font-bold text-xl text-[#061c3f]">@yield('header_title', 'Boshqaruv Paneli')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-500 transition-all relative">
                    <i class="fa-regular fa-bell text-lg"></i>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-[#ff9e0d] rounded-full border-2 border-white"></span>
                </button>

                <!-- Environment / Role Info -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>{{ Auth::user()->role->name === 'admin' ? 'Tizim Admini' : 'Tizim Hodimi' }}</span>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-8">
            <!-- Toast Notifications -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-500"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-8 bg-white border-t border-gray-100 text-center text-xs text-gray-400 font-medium">
            &copy; {{ date('Y') }} Estora Real Estate. Hamma huquqlar himoyalangan.
        </footer>
    </div>

</body>
</html>
