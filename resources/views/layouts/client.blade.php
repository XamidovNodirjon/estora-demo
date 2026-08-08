<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Makler Admin Paneli') - Estora Real Estate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-blue: #0066FF;
            --primary-dark: #08172E;
            --bg-canvas: #F4F6F8;
            --font-main: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        html, body {
            max-width: 100vw !important;
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
            background-color: var(--bg-canvas);
            font-family: var(--font-main);
            color: #0F172A;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#F4F6F8] text-slate-800 antialiased">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200/90 sticky top-0 z-40 shadow-xs">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            
            <!-- Left Side: Hamburger & Logo -->
            <div class="flex items-center gap-4 sm:gap-6 min-w-0">
                <button type="button" class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-all focus:outline-none" title="Menyu">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <a href="{{ route('maniDashboard') }}" class="flex items-center gap-2.5 flex-shrink-0 group hover:opacity-90 transition-opacity" title="ESTORA Real Estate">
                    <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-10 w-auto object-contain">
                </a>
            </div>

            <!-- Middle: Search Bar -->
            <div class="flex-1 max-w-lg mx-4 hidden lg:block">
                <div class="relative">
                    <input type="text" 
                           placeholder="E'lonlar, manzil yoki kalit so'z..." 
                           class="w-full bg-slate-50/90 border border-slate-200 rounded-xl py-2 pl-4 pr-10 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600 transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Right Side Actions & Profile -->
            <div class="flex items-center gap-3 sm:gap-4 flex-shrink-0">

                <!-- Chatlar Button -->
                <a href="#" class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition-all hidden sm:flex items-center gap-1.5 text-xs font-semibold" title="Chatlar">
                    <i class="fa-regular fa-comments text-base"></i>
                    <span>Chatlar</span>
                    <span class="bg-red-500 text-white text-[10px] font-black px-1.5 py-0.2 rounded-full absolute -top-1 -right-1 shadow-xs">3</span>
                </a>

                <!-- Yangiliklar Notification Bell -->
                <a href="#" class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition-all flex items-center gap-1.5 text-xs font-semibold" title="Yangiliklar">
                    <div class="relative">
                        <i class="fa-regular fa-bell text-base"></i>
                        <span class="bg-blue-600 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center absolute -top-1.5 -right-1.5 shadow-xs">5</span>
                    </div>
                    <span class="hidden md:inline">Yangiliklar</span>
                </a>

                <!-- User Profile Header Pill -->
                <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="flex items-center gap-3 pl-2 border-l border-slate-200 hover:opacity-90 transition-opacity">
                    <div class="relative">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center font-black text-sm ring-2 ring-blue-500/30 uppercase shadow-xs">
                            {{ mb_substr(Auth::user()->name ?? 'M', 0, 1) }}
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 bg-blue-600 text-white rounded-full w-4 h-4 flex items-center justify-center text-[9px] ring-2 ring-white" title="Tasdiqlangan Makler">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>

                    <div class="hidden md:block text-left">
                        <div class="flex items-center gap-1">
                            <span class="font-extrabold text-xs sm:text-sm text-slate-900">{{ Auth::user()->name ?? 'Foydalanuvchi' }}</span>
                            <i class="fa-solid fa-circle-check text-blue-600 text-xs" title="Verified"></i>
                            <i class="fa-solid fa-chevron-down text-slate-400 text-[10px] ml-1"></i>
                        </div>
                        <span class="text-[11px] font-bold text-slate-500 capitalize">{{ Auth::user()->role?->name ?? Auth::user()->type ?? 'Makler' }}</span>
                    </div>
                </a>

                <!-- Quick Logout Button in Header -->
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Haqiqatan ham profildan chiqmoqchimisiz?');" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer flex items-center justify-center" title="Profildan chiqish">
                        <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                    </button>
                </form>

            </div>
        </div>
    </header>

    <!-- Main Container Layout -->
    <div class="max-w-[1520px] mx-auto px-3 sm:px-6 lg:px-8 py-5 flex-1 w-full min-w-0">
        
        <!-- Toast Notifications -->
        @if(session('success'))
            <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-xs text-xs sm:text-sm animate-fade-in">
                <i class="fa-solid fa-circle-check text-lg text-emerald-500 flex-shrink-0"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3 shadow-xs text-xs sm:text-sm animate-fade-in">
                <i class="fa-solid fa-circle-exclamation text-lg text-red-500 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <h5 class="font-bold">Iltimos, kiritilgan ma'lumotlarni tekshiring:</h5>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Minimal Clean Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-4 mt-auto">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-400 font-medium">
            &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
        </div>
    </footer>

</body>
</html>
