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
    
    <!-- Vite Assets (Tailwind v4 via @tailwindcss/vite plugin) -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

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
                <button type="button" onclick="toggleMobileNavDrawer()" class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-all focus:outline-none flex items-center justify-center border border-slate-200 lg:hidden" title="Menyu">
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
                @php
                    $unreadMessagesCount = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
                @endphp
                <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition-all hidden sm:flex items-center gap-1.5 text-xs font-semibold" title="Chatlar">
                    <i class="fa-regular fa-comments text-base"></i>
                    <span>Chatlar</span>
                    @if($unreadMessagesCount > 0)
                        <span class="bg-red-500 text-white text-[10px] font-black px-1.5 py-0.2 rounded-full absolute -top-1 -right-1 shadow-xs animate-pulse">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>

                <!-- Yangiliklar Notification Bell -->
                <a href="{{ route('client.dashboard', ['section' => 'news']) }}" class="relative p-2.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-xl transition-all flex items-center gap-1.5 text-xs font-semibold" title="Yangiliklar">
                    <div class="relative">
                        <i class="fa-regular fa-bell text-base"></i>
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
                <button type="button" onclick="openLogoutConfirmModal()" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer flex items-center justify-center" title="Profildan chiqish">
                    <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                </button>

            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu Modal with Smooth Slide Animation -->
    <div id="mobileNavDrawer" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" onclick="toggleMobileNavDrawer()">
        <div id="mobileNavContent" class="w-72 max-w-[85vw] bg-white h-full shadow-2xl p-5 overflow-y-auto space-y-5 transform -translate-x-full transition-transform duration-300 ease-in-out" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <img src="/images/logo.svg" alt="Estora" class="h-8 w-auto">
                </div>
                <button type="button" onclick="toggleMobileNavDrawer()" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-lg hover:bg-slate-200 transition-all">
                    &times;
                </button>
            </div>

            @auth
            <!-- User Info Card in Drawer -->
            <div class="bg-blue-50/70 border border-blue-100 rounded-2xl p-3.5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-extrabold flex items-center justify-center text-sm">
                    {{ mb_substr(Auth::user()->name ?? 'M', 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-extrabold text-xs text-slate-900 truncate">{{ Auth::user()->name ?? 'Foydalanuvchi' }}</h4>
                    <p class="text-[11px] text-slate-500 capitalize">{{ Auth::user()->role?->name ?? Auth::user()->type ?? 'Client' }}</p>
                </div>
            </div>
            @endauth

            <!-- Drawer Links -->
            <div class="space-y-1">
                <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-house-chimney text-blue-600"></i>
                        <span>Bosh sahifa</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-folder-open text-blue-600"></i>
                        <span>E'lonlarim</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-comments text-blue-600"></i>
                        <span>Chatlar</span>
                    </div>
                    @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                        <span class="bg-red-500 text-white font-extrabold text-[10px] px-2 py-0.5 rounded-full animate-pulse">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chart-line text-blue-600"></i>
                        <span>Statistika</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-credit-card text-blue-600"></i>
                        <span>Obuna va to'lovlar</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-globe text-blue-600"></i>
                        <span>Mening sahifam</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'news']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-bell text-blue-600"></i>
                        <span>Yangiliklar</span>
                    </div>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'settings']) }}" class="flex items-center justify-between p-3 rounded-xl font-bold text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-sliders text-blue-600"></i>
                        <span>Sozlamalar</span>
                    </div>
                </a>
            </div>

            <div class="pt-3 border-t border-slate-100">
                <button type="button" onclick="openLogoutConfirmModal()" class="w-full text-red-600 hover:bg-red-50 font-bold rounded-xl p-3 flex items-center gap-3 text-xs text-left transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Profildan chiqish</span>
                </button>
            </div>
        </div>
    </div>


    <script>
        function toggleMobileNavDrawer() {
            const drawer = document.getElementById('mobileNavDrawer');
            const content = document.getElementById('mobileNavContent');
            if (drawer && content) {
                const isOpen = !drawer.classList.contains('pointer-events-none');
                if (isOpen) {
                    content.classList.add('-translate-x-full');
                    drawer.classList.add('opacity-0');
                    setTimeout(() => {
                        drawer.classList.add('pointer-events-none');
                    }, 300);
                } else {
                    drawer.classList.remove('pointer-events-none');
                    drawer.classList.remove('opacity-0');
                    content.classList.remove('-translate-x-full');
                }
            }
        }

        function openLogoutConfirmModal() {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeLogoutConfirmModal() {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }
    </script>

    <!-- Logout Confirmation Modal -->
    <div id="logoutConfirmModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 24px; max-width: 400px; width: 100%; padding: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
            <button type="button" onclick="closeLogoutConfirmModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>

            <div style="width: 68px; height: 68px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border: 4px solid #fee2e2;">
                <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 26px; color: #ef4444;"></i>
            </div>

            <h3 style="font-size: 19px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Profildan chiqish</h3>
            <p style="font-size: 13.5px; color: #64748b; line-height: 1.5; margin-bottom: 24px;">
                Haqiqatan ham profildan chiqmoqchimisiz?
            </p>

            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="closeLogoutConfirmModal()" style="flex: 1; padding: 12px; border-radius: 12px; font-weight: 700; font-size: 13px; background: #f1f5f9; color: #334155; border: none; cursor: pointer;">
                    Yo'q, qolaman
                </button>
                
                <form method="POST" action="{{ route('logout') }}" style="flex: 1; margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 12px; border-radius: 12px; font-weight: 800; font-size: 13px; background: #ef4444; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Chiqish
                    </button>
                </form>
            </div>
        </div>
    </div>

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
