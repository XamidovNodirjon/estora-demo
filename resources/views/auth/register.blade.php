<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ro'yxatdan O'tish - Estora</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets with fallback -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F4F8FC;
            min-height: 100vh;
        }

        /* Desktop Card Styles */
        .desktop-role-card {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .desktop-role-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 20px 35px -10px rgba(0, 102, 255, 0.15);
        }

        .desktop-role-card.selected {
            border-color: #0066FF;
            box-shadow: 0 0 0 2.5px #0066FF, 0 16px 32px -8px rgba(0, 102, 255, 0.22);
            background: #FFFFFF;
            transform: translateY(-4px) scale(1.02);
        }

        .desktop-role-card.selected .radio-indicator {
            border-color: #0066FF;
            background: #0066FF;
            box-shadow: inset 0 0 0 3.5px #FFFFFF;
            animation: radioPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Mobile Card Styles */
        .mobile-role-card {
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .mobile-role-card:active {
            transform: scale(0.98);
        }

        .mobile-role-card.selected {
            border-color: #0077FE;
            box-shadow: 0 0 0 1.5px #0077FE, 0 8px 20px -4px rgba(0, 119, 254, 0.18);
        }

        .form-label-styled {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .form-input-styled {
            height: 46px;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            transition: all 0.25s ease;
        }

        .form-input-styled:focus {
            background: #FFFFFF;
            border-color: #0066FF;
            box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.12);
            transform: translateY(-1px);
        }

        .btn-yellow-primary {
            background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%);
            color: #0F172A;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-yellow-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(60deg, transparent, rgba(255, 255, 255, 0.35), transparent);
            transform: rotate(30deg) translateY(-100%);
            transition: transform 0.6s ease;
        }

        .btn-yellow-primary:hover::after {
            transform: rotate(30deg) translateY(100%);
        }

        .btn-yellow-primary:hover {
            box-shadow: 0 10px 24px -4px rgba(245, 158, 11, 0.4);
            transform: translateY(-2px);
        }

        .btn-yellow-primary:active {
            transform: translateY(0) scale(0.99);
        }

        /* Hero float animation */
        .hero-float {
            animation: heroFloat 3.5s ease-in-out infinite alternate;
        }

        @keyframes heroFloat {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-6px) rotate(1deg); }
        }

        @keyframes radioPop {
            0% { transform: scale(0.6); }
            70% { transform: scale(1.25); }
            100% { transform: scale(1); }
        }

        /* Screen transitions */
        .anim-slide-forward {
            animation: slideForward 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .anim-slide-backward {
            animation: slideBackward 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideForward {
            from {
                opacity: 0;
                transform: translateX(20px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes slideBackward {
            from {
                opacity: 0;
                transform: translateX(-20px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        /* Staggered item entrance */
        .stagger-item {
            opacity: 0;
            animation: itemFadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes itemFadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="text-slate-800 antialiased py-3 sm:py-8 px-3 sm:px-6 flex flex-col justify-between min-h-screen">

    <!-- ============================================================ -->
    <!-- DESKTOP TOP BAR (Only visible on md and up) -->
    <!-- ============================================================ -->
    <header class="hidden md:flex w-full max-w-6xl mx-auto items-center justify-between py-2 sm:py-4 mb-3 sm:mb-6">
        <a href="/" class="flex items-center gap-2 group hover:opacity-90 transition-opacity">
            <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-10 sm:h-12 w-auto object-contain">
        </a>

        <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-xs text-xs font-bold text-slate-700">
            <i class="fa-solid fa-globe text-blue-600"></i>
            <span>O'zbekcha</span>
            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
        </div>
    </header>

    <main class="w-full max-w-5xl mx-auto flex-1 flex flex-col justify-center">

        <!-- ============================================================ -->
        <!-- 1. ROLE SELECTION SCREEN -->
        <!-- ============================================================ -->
        <div id="step-role-select" class="{{ $errors->any() ? 'hidden' : 'block' }} anim-slide-forward">
            
            <!-- -------------------------------------------------------- -->
            <!-- MOBILE VERSION OF STEP 1 (Matches Mobile Mockup Screen 1) -->
            <!-- -------------------------------------------------------- -->
            <div class="block md:hidden max-w-md mx-auto w-full">
                
                <!-- Mobile Top Bar with Language -->
                <div class="flex justify-end mb-2">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-700 bg-white/80 border border-slate-200/80 px-3 py-1 rounded-full shadow-xs">
                        <i class="fa-solid fa-globe text-blue-600"></i>
                        <span>O'zbekcha</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                    </div>
                </div>

                <!-- Mobile Top Hero Scene (Sun, Skyline & House Logo) -->
                <div class="text-center relative pt-2 pb-4 mb-2">
                    <!-- Sun Illustration -->
                    <div class="absolute left-6 top-0 w-8 h-8 rounded-full bg-[#FFC000] shadow-[0_0_20px_rgba(255,192,0,0.6)]"></div>
                    
                    <!-- Modern House Emblem -->
                    <div class="w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                        <svg viewBox="0 0 64 64" class="w-14 h-14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Blue House Roof Outline -->
                            <path d="M32 8L12 24V52C12 54.2 13.8 56 16 56H48C50.2 56 52 54.2 52 52V24L32 8Z" stroke="#0077FE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            <!-- Yellow Accent Door/Chimney -->
                            <path d="M26 56V38C26 35.8 27.8 34 30 34H34C36.2 34 38 35.8 38 38V56" stroke="#FFC000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h1 class="text-2xl font-black text-slate-900 tracking-tight mb-1.5">
                        Hisob turini tanlang
                    </h1>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto leading-relaxed">
                        Sizga eng mos hisob turini tanlab, platformadagi imkoniyatlardan foydalaning
                    </p>
                </div>

                <!-- Mobile 5 Vertical Cards Stack -->
                <div class="space-y-2.5 mb-6">
                    
                    <!-- Card 1: Oddiy foydalanuvchi -->
                    <button type="button" onclick="selectRoleMobile('client')"
                            class="mobile-role-card selected w-full bg-white border-2 border-[#0077FE] rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-left shadow-xs cursor-pointer">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-lg flex-shrink-0">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-extrabold text-slate-900 text-sm leading-tight">Oddiy foydalanuvchi</h3>
                                <p class="text-xs text-slate-400 truncate mt-0.5">Uy yoki xonadosh qidiraman</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[#0077FE] text-xs pl-2"></i>
                    </button>

                    <!-- Card 2: Uy egasi -->
                    <button type="button" onclick="selectRoleMobile('owner')"
                            class="mobile-role-card w-full bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-left shadow-xs cursor-pointer">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-lg flex-shrink-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-extrabold text-slate-900 text-sm leading-tight">Uy egasi</h3>
                                <p class="text-xs text-slate-400 truncate mt-0.5">O'z mulkimni sotaman yoki ijaraga beraman</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 text-xs pl-2"></i>
                    </button>

                    <!-- Card 3: Makler -->
                    <button type="button" onclick="selectRoleMobile('makler')"
                            class="mobile-role-card w-full bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-left shadow-xs cursor-pointer">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-lg flex-shrink-0">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-extrabold text-slate-900 text-sm leading-tight">Makler</h3>
                                <p class="text-xs text-slate-400 truncate mt-0.5">Professional ravishda ko'chmas mulk bilan ishlayman</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-400 text-xs pl-2"></i>
                    </button>

                    <!-- Card 4: Mehmonxona -->
                    <button type="button" onclick="showLockedNotification('Mehmonxona')"
                            class="mobile-role-card w-full bg-white/70 border border-slate-200/90 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-left shadow-xs opacity-75 cursor-not-allowed">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-lg flex-shrink-0 filter blur-[1px]">
                                <i class="fa-solid fa-hotel"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-extrabold text-slate-800 text-sm leading-tight">Mehmonxona</h3>
                                    <span class="text-[9px] font-extrabold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-full">Tez orada</span>
                                </div>
                                <p class="text-xs text-slate-400 truncate mt-0.5">Mehmonxona yoki turar joy xizmatini taklif qilaman</p>
                            </div>
                        </div>
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs flex-shrink-0">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </button>

                    <!-- Card 5: Qurilish -->
                    <button type="button" onclick="showLockedNotification('Qurilish')"
                            class="mobile-role-card w-full bg-white/70 border border-slate-200/90 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-left shadow-xs opacity-75 cursor-not-allowed">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-lg flex-shrink-0 filter blur-[1px]">
                                <i class="fa-solid fa-city"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-extrabold text-slate-800 text-sm leading-tight">Qurilish</h3>
                                    <span class="text-[9px] font-extrabold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-full">Tez orada</span>
                                </div>
                                <p class="text-xs text-slate-400 truncate mt-0.5">Ko'chmas mulk loyihalarini quraman va sotaman</p>
                            </div>
                        </div>
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs flex-shrink-0">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </button>

                </div>

                <!-- Mobile Footer -->
                <p class="text-center text-[11px] text-slate-400 leading-relaxed px-4 mb-4">
                    Kirish orqali siz <a href="#" class="text-[#0077FE] underline">Foydalanish shartlari</a> va <a href="#" class="text-[#0077FE] underline">Maxfiylik siyosati</a>ga rozilik bildirasiz
                </p>

                <div class="text-center pt-1 pb-4">
                    <span class="text-xs text-slate-500 font-medium">Hisobingiz bormi?</span>
                    <a href="{{ route('login') }}" class="text-[#0077FE] hover:underline font-bold text-xs ml-1">Kirish</a>
                </div>

            </div>

            <!-- -------------------------------------------------------- -->
            <!-- DESKTOP VERSION OF STEP 1 (Matches Desktop Mockup Screen) -->
            <!-- -------------------------------------------------------- -->
            <div class="hidden md:block">
                
                <!-- Desktop Titles -->
                <div class="text-center mb-8">
                    <span class="inline-block text-[11px] font-extrabold uppercase tracking-widest text-[#0077FE] bg-blue-50 px-3 py-1 rounded-full mb-2">
                        Ro'yxatdan o'tish
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mb-2">
                        Hisob turini tanlang
                    </h1>
                    <p class="text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                        Hisob turini tanlab, platformadagi imkoniyatlardan foydalaning.
                    </p>
                </div>

                <!-- Desktop 5 Cards Row -->
                <div class="grid grid-cols-5 gap-3.5 mb-8">
                    
                    <!-- 1. Oddiy foydalanuvchi -->
                    <div class="desktop-role-card selected bg-white border-2 border-[#0077FE] rounded-2xl p-5 flex flex-col items-center text-center justify-between cursor-pointer min-h-[260px] shadow-sm relative"
                         onclick="handleDesktopRoleSelect('client', this)">
                        <button type="button" class="absolute top-3.5 right-3.5 text-slate-300 hover:text-slate-500 text-sm" title="Batafsil">
                            <i class="fa-regular fa-circle-question"></i>
                        </button>
                        <div class="w-16 h-16 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-2xl mt-3">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="my-3">
                            <h3 class="font-extrabold text-slate-900 text-sm leading-tight mb-1.5">Oddiy foydalanuvchi</h3>
                            <p class="text-[11px] text-slate-500 leading-snug">Uy yoki xonadosh qidiraman</p>
                        </div>
                        <div class="radio-indicator w-5 h-5 rounded-full border-2 border-[#0077FE] bg-[#0077FE] shadow-inner"></div>
                    </div>

                    <!-- 2. Uy egasi -->
                    <div class="desktop-role-card bg-white border-2 border-slate-200/90 rounded-2xl p-5 flex flex-col items-center text-center justify-between cursor-pointer min-h-[260px] shadow-xs relative"
                         onclick="handleDesktopRoleSelect('owner', this)">
                        <button type="button" class="absolute top-3.5 right-3.5 text-slate-300 hover:text-slate-500 text-sm" title="Batafsil">
                            <i class="fa-regular fa-circle-question"></i>
                        </button>
                        <div class="w-16 h-16 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-2xl mt-3">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="my-3">
                            <h3 class="font-extrabold text-slate-900 text-sm leading-tight mb-1.5">Uy egasi</h3>
                            <p class="text-[11px] text-slate-500 leading-snug">O'z mulkimni sotaman yoki ijaraga beraman</p>
                        </div>
                        <div class="radio-indicator w-5 h-5 rounded-full border-2 border-slate-300 bg-white"></div>
                    </div>

                    <!-- 3. Makler -->
                    <div class="desktop-role-card bg-white border-2 border-slate-200/90 rounded-2xl p-5 flex flex-col items-center text-center justify-between cursor-pointer min-h-[260px] shadow-xs relative"
                         onclick="handleDesktopRoleSelect('makler', this)">
                        <button type="button" class="absolute top-3.5 right-3.5 text-slate-300 hover:text-slate-500 text-sm" title="Batafsil">
                            <i class="fa-regular fa-circle-question"></i>
                        </button>
                        <div class="w-16 h-16 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-2xl mt-3">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div class="my-3">
                            <h3 class="font-extrabold text-slate-900 text-sm leading-tight mb-1.5">Makler</h3>
                            <p class="text-[11px] text-slate-500 leading-snug">Ko'chmas mulk bilan professional ishlayman</p>
                        </div>
                        <div class="radio-indicator w-5 h-5 rounded-full border-2 border-slate-300 bg-white"></div>
                    </div>

                    <!-- 4. Mehmonxona (Locked) -->
                    <div class="desktop-role-card bg-white/70 border-2 border-slate-200/80 rounded-2xl p-5 flex flex-col items-center text-center justify-between cursor-not-allowed min-h-[260px] shadow-xs relative opacity-85 hover:opacity-100"
                         onclick="showLockedNotification('Mehmonxona')">
                        <button type="button" class="absolute top-3.5 right-3.5 text-slate-300 hover:text-slate-500 text-sm" title="Batafsil">
                            <i class="fa-regular fa-circle-question"></i>
                        </button>
                        <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-blue-400 text-2xl mt-3 filter blur-[1px] opacity-70">
                            <i class="fa-solid fa-hotel"></i>
                        </div>
                        <div class="my-3">
                            <h3 class="font-extrabold text-slate-800 text-sm leading-tight mb-1.5">Mehmonxona</h3>
                            <span class="inline-block text-[10px] font-extrabold text-[#0077FE] bg-blue-50 border border-blue-100 px-2.5 py-0.5 rounded-full mb-1">
                                Tez orada
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs shadow-inner">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </div>

                    <!-- 5. Qurilish (Locked) -->
                    <div class="desktop-role-card bg-white/70 border-2 border-slate-200/80 rounded-2xl p-5 flex flex-col items-center text-center justify-between cursor-not-allowed min-h-[260px] shadow-xs relative opacity-85 hover:opacity-100"
                         onclick="showLockedNotification('Qurilish')">
                        <button type="button" class="absolute top-3.5 right-3.5 text-slate-300 hover:text-slate-500 text-sm" title="Batafsil">
                            <i class="fa-regular fa-circle-question"></i>
                        </button>
                        <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-blue-400 text-2xl mt-3 filter blur-[1px] opacity-70">
                            <i class="fa-solid fa-city"></i>
                        </div>
                        <div class="my-3">
                            <h3 class="font-extrabold text-slate-800 text-sm leading-tight mb-1.5">Qurilish</h3>
                            <span class="inline-block text-[10px] font-extrabold text-[#0077FE] bg-blue-50 border border-blue-100 px-2.5 py-0.5 rounded-full mb-1">
                                Tez orada
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs shadow-inner">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </div>

                </div>

                <!-- Desktop Bottom Action -->
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                        <i class="fa-solid fa-circle-info text-[#0077FE]"></i>
                        <span>Kerak bo'lsa, keyinroq hisob turini o'zgartirishingiz mumkin.</span>
                    </div>

                    <button type="button" onclick="goToStepDetailsOrForm()" 
                            class="btn-yellow-primary w-full max-w-sm py-3.5 px-8 rounded-2xl font-black text-sm flex items-center justify-center gap-3 shadow-md cursor-pointer">
                        <span>Davom etish</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                    <p class="text-xs text-slate-500 font-medium">
                        Hisobingiz bormi? 
                        <a href="{{ route('login') }}" class="text-[#0077FE] hover:underline font-bold ml-1">Kirish</a>
                    </p>
                </div>

            </div>

        </div>

        <!-- ============================================================ -->
        <!-- 2. MOBILE ROLE DETAILS & BENEFITS (Matches Mobile Mockup Screen 2) -->
        <!-- ============================================================ -->
        <div id="step-role-details" class="hidden max-w-md mx-auto w-full">
            
            <!-- Top Back Arrow -->
            <div class="mb-2">
                <button type="button" onclick="goToStepSelect()" class="p-2 -ml-2 text-slate-800 hover:text-blue-600 text-lg cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>

            <!-- Top Hero Illustration Box (Blue House + Magnifying Glass + Floating Badges) -->
            <div class="relative w-full h-44 mb-2 flex items-center justify-center overflow-hidden rounded-3xl bg-gradient-to-b from-[#E2EEFE] via-[#EDF5FF] to-transparent">
                <!-- Floating Hearts and Chat Badges -->
                <div class="absolute left-6 top-6 w-9 h-9 rounded-full bg-white shadow-md flex items-center justify-center text-blue-500 text-sm">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div class="absolute right-8 top-5 w-9 h-9 rounded-full bg-white shadow-md flex items-center justify-center text-blue-400 text-sm">
                    <i class="fa-solid fa-comment-dots"></i>
                </div>

                <!-- House & Search Loupe Graphic -->
                <div class="relative hero-float">
                    <div class="w-24 h-24 text-[#0077FE]">
                        <svg viewBox="0 0 64 64" class="w-full h-full" fill="currentColor">
                            <!-- Blue House Silhouette -->
                            <path d="M32 6L8 24V56C8 57.1 8.9 58 10 58H54C55.1 58 56 57.1 56 56V24L32 6ZM26 44H20V34H26V44ZM44 44H38V34H44V44Z" fill="#0077FE"/>
                            <rect x="22" y="24" width="6" height="6" fill="#FFFFFF"/>
                            <rect x="36" y="24" width="6" height="6" fill="#FFFFFF"/>
                        </svg>
                    </div>
                    <!-- Magnifying Glass with Yellow Accent -->
                    <div class="absolute -left-3 top-4 w-12 h-12">
                        <svg viewBox="0 0 48 48" class="w-full h-full" fill="none">
                            <circle cx="20" cy="20" r="14" stroke="#FFC000" stroke-width="5" fill="none"/>
                            <path d="M30 30L42 42" stroke="#0077FE" stroke-width="5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Role Title & Pill Badge -->
            <div class="text-center mb-4">
                <span class="inline-block text-[11px] font-extrabold text-white bg-[#0077FE] px-4 py-1.5 rounded-full mb-2 shadow-xs">
                    Tanlangan hisob turi
                </span>

                <h2 id="details-role-title" class="text-2xl font-black text-slate-900 tracking-tight mb-1">
                    Oddiy foydalanuvchi
                </h2>
                <p id="details-role-subtitle" class="text-xs text-slate-500 font-medium">
                    Uy yoki xonadosh qidiraman
                </p>
            </div>

            <!-- Features List Card (White rounded card matching mockup) -->
            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm mb-5">
                <h4 class="font-black text-slate-900 text-sm mb-4">
                    Siz uchun imkoniyatlar:
                </h4>

                <div id="details-features-container" class="space-y-4">
                    <!-- Injected via JS -->
                </div>
            </div>

            <!-- Yellow CTA Button: Ro'yxatdan o'tish > -->
            <div class="space-y-3 text-center">
                <button type="button" onclick="goToStepForm()"
                        class="btn-yellow-primary w-full py-4 px-6 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Ro'yxatdan o'tish</span>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>

                <p class="text-xs text-slate-500 font-medium">
                    Hisobingiz bormi? 
                    <a href="{{ route('login') }}" class="text-[#0077FE] hover:underline font-bold ml-1">Kirish</a>
                </p>
            </div>

        </div>

        <!-- ============================================================ -->
        <!-- 3. REGISTRATION INPUT FORM SCREEN -->
        <!-- ============================================================ -->
        <div id="step-register-form" class="{{ $errors->any() ? 'block' : 'hidden' }} max-w-lg mx-auto w-full">
            
            <div class="mb-3 flex items-center justify-between">
                <button type="button" onclick="goToStepSelect()" class="inline-flex items-center gap-2 text-xs font-extrabold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-3.5 py-2 rounded-xl shadow-xs cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-[11px]"></i>
                    <span>Boshqa hisob turini tanlash</span>
                </button>

                <div class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-200 text-[#0077FE] px-3 py-1.5 rounded-xl text-xs font-bold">
                    <i id="form-role-badge-icon" class="fa-solid fa-user"></i>
                    <span id="form-role-badge-title">Oddiy foydalanuvchi</span>
                </div>
            </div>

            <div class="bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-7 shadow-xl">
                <div class="text-center mb-5 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Hisob ma'lumotlari</h2>
                    <p class="text-xs text-slate-500 mt-1">Ro'yxatdan o'tish uchun quyidagi maydonlarni to'ldiring</p>
                </div>

                <!-- Errors -->
                @if ($errors->any())
                    <div class="mb-5 p-3.5 rounded-2xl bg-red-50 border border-red-200 text-red-700">
                        <div class="flex items-center gap-2 font-bold text-xs mb-1">
                            <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                            <span>Iltimos, xatoliklarni to'g'rilang:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Dynamic Hidden Role Input -->
                    <input type="hidden" name="role" id="form_role_input" value="{{ old('role', 'client') }}">

                    <!-- Row 1: Name & Username -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="name" class="form-label-styled">Ism sharifingiz</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-regular fa-user"></i>
                                </span>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="Ali Valiyev">
                            </div>
                        </div>

                        <div>
                            <label for="username" class="form-label-styled">Foydalanuvchi nomi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-solid fa-at"></i>
                                </span>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="ali_valiyev">
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Email & Phone -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="email" class="form-label-styled">Elektron pochta</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-regular fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="example@mail.com">
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="form-label-styled">Telefon raqam</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="+998901234567">
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Passport & JSHSHIR -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="passport" class="form-label-styled">Pasport seriyasi (Ixtiyoriy)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-regular fa-id-card"></i>
                                </span>
                                <input type="text" name="passport" id="passport" value="{{ old('passport') }}"
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="AA1234567">
                            </div>
                        </div>

                        <div>
                            <label for="jshshir" class="form-label-styled">JShShIR (Ixtiyoriy)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-solid fa-fingerprint"></i>
                                </span>
                                <input type="text" name="jshshir" id="jshshir" value="{{ old('jshshir') }}"
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="14 xonali raqam">
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Password & Confirmation -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label for="password" class="form-label-styled">Mahfiy kalit (Parol)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="Kamida 6 belgi">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label-styled">Parolni tasdiqlash</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                                    <i class="fa-solid fa-lock-open"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="form-input-styled block w-full pl-10 pr-3.5 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                                    placeholder="Parolni takrorlang">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn-yellow-primary w-full py-3.5 px-4 mt-2 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <span>Hisob yaratish</span>
                        <i class="fa-solid fa-check text-xs"></i>
                    </button>
                </form>

                <div class="mt-5 text-center text-xs text-slate-500 font-medium">
                    Hisobingiz bormi? 
                    <a href="{{ route('login') }}" class="text-[#0077FE] hover:underline font-bold ml-1">Kirish</a>
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER (Desktop only) -->
    <footer class="hidden md:block w-full max-w-6xl mx-auto text-center py-4 text-xs text-slate-400 font-medium">
        &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
    </footer>

    <!-- SCRIPT FOR DYNAMIC 2-STEP FLOW & ROLE DATA -->
    <script>
        const rolesData = {
            client: {
                title: "Oddiy foydalanuvchi",
                subtitle: "Uy yoki xonadosh qidiraman",
                icon: "fa-solid fa-user",
                features: [
                    { icon: "fa-solid fa-magnifying-glass", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Uy va xonadosh qidirish", desc: "E'lonlarni qidiring va filtrlar orqali oson toping" },
                    { icon: "fa-solid fa-heart", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Yoqtirgan e'lonlarni saqlash", desc: "Qiziqqan e'lonlaringizni saqlab qo'ying" },
                    { icon: "fa-solid fa-comment-dots", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Chat orqali muloqot", desc: "E'lon egasi bilan bevosita bog'laning" },
                    { icon: "fa-solid fa-circle-plus", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Cheklangan e'lon joylash", desc: "Uy yoki xonadosh izlash uchun e'lon berishingiz mumkin" }
                ]
            },
            owner: {
                title: "Uy egasi",
                subtitle: "O'z mulkimni sotaman yoki ijaraga beraman",
                icon: "fa-solid fa-house",
                features: [
                    { icon: "fa-solid fa-house-chimney", color: "bg-[#EBF4FF] text-[#0077FE]", title: "O'z mulkini joylash", desc: "Xonadon, hovli yoki tijorat joyingizni joylashtiring" },
                    { icon: "fa-solid fa-chart-line", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Ko'rishlar statistikasi", desc: "E'loningiz qancha ko'rilganini tahlil qiling" },
                    { icon: "fa-solid fa-phone", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Mijozlar bilan bevosita aloqa", desc: "O'rtakashlarsiz to'g'ridan-to'g'ri bog'lanish" },
                    { icon: "fa-solid fa-bolt", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Tezkor e'lon berish", desc: "Bir necha qadamda o'z e'loningizni platformaga chiqaring" }
                ]
            },
            makler: {
                title: "Makler",
                subtitle: "Professional ravishda ko'chmas mulk bilan ishlayman",
                icon: "fa-solid fa-user-tie",
                features: [
                    { icon: "fa-solid fa-layer-group", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Cheksiz e'lonlar joylash", desc: "Barcha obyektlaringizni erkin va cheklovlarsiz joylang" },
                    { icon: "fa-solid fa-badge-check", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Shaxsiy rieltor sahifasi", desc: "Mijozlar uchun o'z portfoliongiz va shaxsiy havolangiz" },
                    { icon: "fa-solid fa-arrow-trend-up", color: "bg-[#EBF4FF] text-[#0077FE]", title: "E'lonlar reytingi va tahlili", desc: "Top pozitsiyalar va kengaytirilgan analitika" },
                    { icon: "fa-solid fa-users", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Keng mijozlar oqimi", desc: "Har kuni minglab faol xaridor va ijarachilar bilan ishlash" }
                ]
            },
            hotel: {
                title: "Mehmonxona",
                subtitle: "Mehmonxona yoki turar joy xizmatini taklif qilaman",
                icon: "fa-solid fa-hotel",
                features: [
                    { icon: "fa-solid fa-bed", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Xonalar va apartamentlar", desc: "Xonalar turlari va qulayliklarini joylashtirish" },
                    { icon: "fa-solid fa-calendar-check", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Band qilish va buyurtmalar", desc: "Mijozlar uchun to'g'ridan-to'g'ri bron qilish" },
                    { icon: "fa-solid fa-star", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Reyting va sharhlar", desc: "Mehmonlar qoldirgan baho va fikrlarni boshqarish" },
                    { icon: "fa-solid fa-map-location-dot", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Xaritada qulay lokatsiya", desc: "Mehmonxonangizni xaritada yaqqol ko'rsatish" }
                ]
            },
            builder: {
                title: "Qurilish",
                subtitle: "Ko'chmas mulk loyihalarini quraman va sotaman",
                icon: "fa-solid fa-city",
                features: [
                    { icon: "fa-solid fa-building", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Yangi turar-joy majmualari", desc: "Novostroyka loyihalari va bloklarini taqdim etish" },
                    { icon: "fa-solid fa-ruler-combined", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Rejalashtirish (Planirovka)", desc: "Xonadonlar planirovkasi va narxlari ro'yxati" },
                    { icon: "fa-solid fa-certificate", color: "bg-[#EBF4FF] text-[#0077FE]", title: "Kompaniya rasmiy profili", desc: "Qurilish kompaniyasining ishonchli rasmiy sahifasi" },
                    { icon: "fa-solid fa-handshake", color: "bg-[#EBF4FF] text-[#0077FE]", title: "To'g'ridan-to'g'ri sotuvlar", desc: "Xaridorlar bilan to'g'ridan-to'g'ri shartnomalar tuzish" }
                ]
            }
        };

        let currentSelectedRole = "{{ old('role', 'client') }}";

        // Desktop selection
        function handleDesktopRoleSelect(role, element) {
            currentSelectedRole = role;
            document.querySelectorAll('.desktop-role-card').forEach(card => {
                card.classList.remove('selected', 'border-[#0077FE]');
                card.classList.add('border-slate-200/90');
                const radio = card.querySelector('.radio-indicator');
                if (radio) {
                    radio.classList.remove('border-[#0077FE]', 'bg-[#0077FE]', 'shadow-inner');
                    radio.classList.add('border-slate-300', 'bg-white');
                }
            });

            element.classList.add('selected', 'border-[#0077FE]');
            element.classList.remove('border-slate-200/90');
            const activeRadio = element.querySelector('.radio-indicator');
            if (activeRadio) {
                activeRadio.classList.add('border-[#0077FE]', 'bg-[#0077FE]', 'shadow-inner');
                activeRadio.classList.remove('border-slate-300', 'bg-white');
            }

            syncRoleToForm(role);
        }

        // Mobile selection (takes to Step 2 Details)
        function selectRoleMobile(role) {
            currentSelectedRole = role;
            syncRoleToForm(role);
            renderRoleDetails(role);

            // Update mobile cards active state
            document.querySelectorAll('.mobile-role-card').forEach(card => {
                card.classList.remove('selected', 'border-2', 'border-[#0077FE]');
                card.classList.add('border', 'border-slate-200/90');
                const chevron = card.querySelector('.fa-chevron-right');
                if (chevron) {
                    chevron.classList.remove('text-[#0077FE]');
                    chevron.classList.add('text-slate-400');
                }
            });

            const selectStep = document.getElementById('step-role-select');
            const detailsStep = document.getElementById('step-role-details');
            const formStep = document.getElementById('step-register-form');

            selectStep.classList.add('hidden');
            formStep.classList.add('hidden');
            
            detailsStep.classList.remove('hidden', 'anim-slide-backward');
            detailsStep.classList.add('anim-slide-forward');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function renderRoleDetails(role) {
            const data = rolesData[role] || rolesData.client;
            document.getElementById('details-role-title').textContent = data.title;
            document.getElementById('details-role-subtitle').textContent = data.subtitle;

            const container = document.getElementById('details-features-container');
            container.innerHTML = '';

            data.features.forEach((feat, index) => {
                const item = document.createElement('div');
                item.className = 'stagger-item flex items-start gap-3.5';
                item.style.animationDelay = (index * 60 + 40) + 'ms';
                item.innerHTML = `
                    <div class="w-11 h-11 rounded-2xl ${feat.color} flex items-center justify-center text-base flex-shrink-0 mt-0.5 shadow-xs transition-transform hover:scale-110">
                        <i class="${feat.icon}"></i>
                    </div>
                    <div class="min-w-0">
                        <h5 class="font-black text-slate-900 text-xs sm:text-sm leading-tight mb-0.5">${feat.title}</h5>
                        <p class="text-[11px] sm:text-xs text-slate-500 font-medium leading-relaxed">${feat.desc}</p>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function syncRoleToForm(role) {
            const data = rolesData[role] || rolesData.client;
            document.getElementById('form_role_input').value = role;
            document.getElementById('form-role-badge-title').textContent = data.title;
            document.getElementById('form-role-badge-icon').className = data.icon;
        }

        // Desktop Next Button
        function goToStepDetailsOrForm() {
            syncRoleToForm(currentSelectedRole);
            goToStepForm();
        }

        function goToStepSelect() {
            const selectStep = document.getElementById('step-role-select');
            const detailsStep = document.getElementById('step-role-details');
            const formStep = document.getElementById('step-register-form');

            detailsStep.classList.add('hidden');
            formStep.classList.add('hidden');
            
            selectStep.classList.remove('hidden', 'anim-slide-forward');
            selectStep.classList.add('anim-slide-backward');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function goToStepForm() {
            syncRoleToForm(currentSelectedRole);
            const selectStep = document.getElementById('step-role-select');
            const detailsStep = document.getElementById('step-role-details');
            const formStep = document.getElementById('step-register-form');

            selectStep.classList.add('hidden');
            detailsStep.classList.add('hidden');
            
            formStep.classList.remove('hidden', 'anim-slide-backward');
            formStep.classList.add('anim-slide-forward');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Notification for locked/coming soon roles
        function showLockedNotification(roleName) {
            const existingToast = document.getElementById('coming-soon-toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.id = 'coming-soon-toast';
            toast.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/95 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-slate-700/80 backdrop-blur-md anim-slide-forward';
            toast.innerHTML = `
                <div class="w-7 h-7 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center text-xs flex-shrink-0">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="text-xs font-bold leading-tight">
                    <span class="text-blue-400">${roleName}</span> bo'limi tez orada ishga tushadi!
                </div>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'all 0.3s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, 15px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Initialize state
        syncRoleToForm(currentSelectedRole);
    </script>

</body>
</html>


