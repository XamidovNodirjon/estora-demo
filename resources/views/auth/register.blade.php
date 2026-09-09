<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ro'yxatdan o'tish - Estora Real Estate</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            min-height: 100vh;
        }

        /* Subtle decorative background chevrons */
        .bg-pattern {
            background-color: #F6F9FD;
            background-image: 
                radial-gradient(circle at 12% 25%, rgba(0, 119, 254, 0.05) 0%, transparent 45%),
                radial-gradient(circle at 88% 75%, rgba(0, 119, 254, 0.05) 0%, transparent 45%);
        }

        .ambient-deco {
            position: absolute;
            pointer-events: none;
            opacity: 0.04;
            z-index: 0;
        }

        /* Step 1 Cards */
        .role-card {
            background: #FFFFFF;
            border: 2px solid transparent;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 20px -2px rgba(0, 50, 130, 0.05);
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 30px -8px rgba(0, 102, 255, 0.12);
        }

        .role-card.selected {
            border-color: #0077FE;
            box-shadow: 0 0 0 1px #0077FE, 0 16px 36px -10px rgba(0, 119, 254, 0.25);
            transform: translateY(-4px);
        }

        .role-card.selected .role-glow-icon {
            box-shadow: 0 0 28px rgba(0, 119, 254, 0.28);
        }

        .role-card.selected .arrow-circle {
            background-color: #0077FE;
            color: #FFFFFF;
        }

        /* Yellow CTA in Step 1 */
        .btn-yellow-cta {
            background: #FFC000;
            background: linear-gradient(135deg, #FFC72C 0%, #FFB100 100%);
            color: #0F172A;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-yellow-cta:hover {
            background: linear-gradient(135deg, #FFD043 0%, #FFA200 100%);
            box-shadow: 0 12px 28px -4px rgba(255, 177, 0, 0.45);
            transform: translateY(-2px);
        }

        .btn-yellow-cta:active {
            transform: translateY(0);
        }

        /* Blue CTA in Step 2 */
        .btn-blue-cta {
            background: #0077FE;
            color: #FFFFFF;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-blue-cta:hover {
            background: #0066E0;
            box-shadow: 0 12px 28px -4px rgba(0, 119, 254, 0.38);
            transform: translateY(-2px);
        }

        .btn-blue-cta:active {
            transform: translateY(0);
        }

        /* Step 2 Inputs */
        .form-input-box {
            height: 52px;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            transition: all 0.2s ease;
        }

        .form-input-box:focus-within {
            background: #FFFFFF;
            border-color: #0077FE;
            box-shadow: 0 0 0 4px rgba(0, 119, 254, 0.1);
        }

        /* Social Auth Button */
        .social-card {
            background: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            transition: all 0.2s ease;
        }

        .social-card:hover {
            border-color: #0077FE;
            background: #F8FAFC;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px -4px rgba(0, 119, 254, 0.12);
        }

        /* Transitions */
        .anim-fade-step {
            animation: fadeStep 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeStep {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.995);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>
<body class="text-slate-800 antialiased bg-pattern min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <!-- Decorative background chevrons matching Estora Logo geometry -->
    <svg class="ambient-deco -top-12 -right-12 w-[420px] h-[420px]" viewBox="0 0 100 100" fill="none" stroke="#0077FE" stroke-width="10">
        <path d="M10 50 L50 15 L90 50" />
        <path d="M10 75 L50 40 L90 75" />
    </svg>
    <svg class="ambient-deco -bottom-16 -left-16 w-[420px] h-[420px]" viewBox="0 0 100 100" fill="none" stroke="#0077FE" stroke-width="10">
        <path d="M10 50 L50 15 L90 50" />
        <path d="M10 75 L50 40 L90 75" />
    </svg>

    <!-- ============================================================ -->
    <!-- TOP HEADER -->
    <!-- ============================================================ -->
    <header class="w-full max-w-6xl mx-auto px-4 sm:px-6 pt-6 pb-2 flex items-center justify-between z-10">
        <a href="/" class="flex items-center group hover:opacity-95 transition-opacity">
            <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-11 w-auto object-contain">
        </a>

        <!-- Language Selector -->
        <div class="relative">
            <button type="button" class="flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-slate-200/90 shadow-xs text-xs font-bold text-slate-700 hover:border-slate-300 transition-colors">
                <i class="fa-solid fa-globe text-[#0077FE]"></i>
                <span>O'zbekcha</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
            </button>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- MAIN CONTENT -->
    <!-- ============================================================ -->
    <main class="w-full max-w-6xl mx-auto px-4 sm:px-6 flex-1 flex flex-col justify-center py-6 z-10">

        <!-- ======================================================== -->
        <!-- 1. STEP 1: CHOOSE ACCOUNT ROLE (Hisob turini tanlang)     -->
        <!-- Matches Screenshot 1 Exactly                              -->
        <!-- ======================================================== -->
        <div id="step-role-select" class="{{ $errors->any() ? 'hidden' : 'block' }} anim-fade-step w-full">
            
            <!-- Step 1 Titles -->
            <div class="text-center max-w-xl mx-auto mb-8">
                <span class="inline-block text-[11px] font-extrabold uppercase tracking-widest text-[#0077FE] bg-[#EBF4FF] px-4 py-1.5 rounded-full mb-3 shadow-xs">
                    Ro'yxatdan o'tish
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-[40px] font-black text-slate-900 tracking-tight leading-tight mb-2.5">
                    Hisob turini tanlang
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed">
                    Hisob turini tanlab, platformadagi imkoniyatlardan foydalaning.
                </p>
            </div>

            <!-- 5 Cards Horizontal Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-4.5 max-w-5xl mx-auto mb-8">
                
                <!-- 1. Oddiy foydalanuvchi -->
                <div class="role-card selected rounded-[28px] p-6 flex flex-col items-center justify-between text-center min-h-[295px] cursor-pointer"
                     onclick="selectRole('client', this)" ondblclick="goToStepForm()">
                    <div class="role-glow-icon w-20 h-20 rounded-full bg-gradient-to-b from-[#EDF5FF] via-[#E2EFFF] to-[#D5E8FF] flex items-center justify-center text-[#0077FE] text-2xl transition-all mt-2">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="my-2">
                        <h3 class="font-black text-slate-900 text-[15px] leading-tight mb-1.5">
                            Oddiy foydalanuvchi
                        </h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">
                            Uy yoki xonadoni qidiraman
                        </p>
                    </div>
                    <button type="button" onclick="event.stopPropagation(); selectRole('client', this.closest('.role-card')); goToStepForm();"
                            class="arrow-circle w-8 h-8 rounded-full bg-[#EBF4FF] text-[#0077FE] flex items-center justify-center text-xs transition-colors mb-1 hover:bg-[#0077FE] hover:text-white cursor-pointer" title="Davom etish">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

                <!-- 2. Uy egasi -->
                <div class="role-card rounded-[28px] p-6 flex flex-col items-center justify-between text-center min-h-[295px] cursor-pointer"
                     onclick="selectRole('owner', this)" ondblclick="goToStepForm()">
                    <div class="role-glow-icon w-20 h-20 rounded-full bg-gradient-to-b from-[#EDF5FF] to-[#E2EFFF] flex items-center justify-center text-[#0077FE] text-2xl transition-all mt-2">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="my-2">
                        <h3 class="font-black text-slate-900 text-[15px] leading-tight mb-1.5">
                            Uy egasi
                        </h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">
                            O'zim mulkinni sotaman yoki ijaraga beraman
                        </p>
                    </div>
                    <button type="button" onclick="event.stopPropagation(); selectRole('owner', this.closest('.role-card')); goToStepForm();"
                            class="arrow-circle w-8 h-8 rounded-full bg-[#EBF4FF] text-[#0077FE] flex items-center justify-center text-xs transition-colors mb-1 hover:bg-[#0077FE] hover:text-white cursor-pointer" title="Davom etish">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

                <!-- 3. Makler -->
                <div class="role-card rounded-[28px] p-6 flex flex-col items-center justify-between text-center min-h-[295px] cursor-pointer"
                     onclick="selectRole('makler', this)" ondblclick="goToStepForm()">
                    <div class="role-glow-icon w-20 h-20 rounded-full bg-gradient-to-b from-[#EDF5FF] to-[#E2EFFF] flex items-center justify-center text-[#0077FE] text-2xl transition-all mt-2">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="my-2">
                        <h3 class="font-black text-slate-900 text-[15px] leading-tight mb-1.5">
                            Makler
                        </h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">
                            Ko'chmas mulk bilan professional ishlayman
                        </p>
                    </div>
                    <button type="button" onclick="event.stopPropagation(); selectRole('makler', this.closest('.role-card')); goToStepForm();"
                            class="arrow-circle w-8 h-8 rounded-full bg-[#EBF4FF] text-[#0077FE] flex items-center justify-center text-xs transition-colors mb-1 hover:bg-[#0077FE] hover:text-white cursor-pointer" title="Davom etish">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

                <!-- 4. Mehmonxona (Locked / Coming soon) -->
                <div class="role-card rounded-[28px] p-6 flex flex-col items-center justify-between text-center min-h-[295px] cursor-not-allowed opacity-80"
                     onclick="showLockedToast('Mehmonxona')">
                    <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl mt-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="my-2">
                        <h3 class="font-black text-slate-700 text-[15px] leading-tight mb-2">
                            Mehmonxona
                        </h3>
                        <span class="inline-block text-[11px] font-extrabold text-[#0077FE] bg-[#EBF4FF] px-3.5 py-1 rounded-full">
                            Tez orada
                        </span>
                    </div>
                    <div class="w-8 h-8 rounded-full"></div>
                </div>

                <!-- 5. Qurilish (Locked / Coming soon) -->
                <div class="role-card rounded-[28px] p-6 flex flex-col items-center justify-between text-center min-h-[295px] cursor-not-allowed opacity-80"
                     onclick="showLockedToast('Qurilish')">
                    <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl mt-2">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="my-2">
                        <h3 class="font-black text-slate-700 text-[15px] leading-tight mb-2">
                            Qurilish
                        </h3>
                        <span class="inline-block text-[11px] font-extrabold text-[#0077FE] bg-[#EBF4FF] px-3.5 py-1 rounded-full">
                            Tez orada
                        </span>
                    </div>
                    <div class="w-8 h-8 rounded-full"></div>
                </div>

            </div>

            <!-- Step 1 Bottom Actions -->
            <div class="flex flex-col items-center justify-center space-y-4 max-w-sm mx-auto">
                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                    <i class="fa-solid fa-circle-info text-[#0077FE]"></i>
                    <span>Kerak bo'lsa, keyinroq hisob turini o'zgartirishingiz mumkin.</span>
                </div>

                <!-- Continue Button -->
                <button type="button" onclick="goToStepForm()"
                        class="btn-yellow-cta w-full py-4 px-8 rounded-2xl font-black text-sm sm:text-base flex items-center justify-center gap-3 shadow-md cursor-pointer">
                    <span>Davom etish</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>

                <p class="text-xs text-slate-500 font-medium pt-1">
                    Hisobingiz bormi? 
                    <a href="{{ route('login') }}" class="text-[#0077FE] hover:underline font-bold ml-1">Kirish</a>
                </p>
            </div>

        </div>

        <!-- ======================================================== -->
        <!-- 2. STEP 2: REGISTRATION FORM (Split Screen Layout)       -->
        <!-- Matches Screenshot 2 Exactly                              -->
        <!-- ======================================================== -->
        <div id="step-register-form" class="{{ $errors->any() ? 'block' : 'hidden' }} anim-fade-step w-full">
            
            <div class="max-w-4xl lg:max-w-5xl mx-auto bg-white rounded-3xl sm:rounded-[36px] shadow-[0_20px_60px_rgba(15,23,42,0.12)] border border-slate-100 overflow-hidden flex flex-col md:flex-row min-h-[590px]">
                
                <!-- Left Hero Side (Loaded House Photo with text) -->
                <div class="w-full md:w-[46%] lg:w-[48%] relative min-h-[280px] md:min-h-full overflow-hidden flex flex-col justify-between p-7 sm:p-10 text-white select-none bg-slate-900">
                    
                    <!-- Background House Photo -->
                    <img src="/images/auth-side.jpg" alt="Estora Real Estate" 
                         class="absolute inset-0 w-full h-full object-cover object-center z-0 scale-105 transition-transform duration-1000 hover:scale-100">
                    
                    <!-- Dark Gradient Overlay for high text contrast -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/35 to-slate-950/50 z-10"></div>
                    
                    <!-- Top Section: Logo & Big Quote -->
                    <div class="relative z-20">
                        <a href="/" class="inline-block mb-6 sm:mb-8 group">
                            <img src="/images/logo-white.svg" alt="ESTORA REAL ESTATE" class="h-9 sm:h-11 w-auto">
                        </a>

                        <h2 class="text-2xl sm:text-3xl lg:text-[32px] font-black text-white leading-[1.25] tracking-tight drop-shadow-md">
                            Yaxshi<br>
                            manzillar<br>
                            yorqin<br>
                            kelajak sari
                        </h2>
                    </div>

                    <!-- Bottom Section: Sub-quote & Slide Dots -->
                    <div class="relative z-20 pt-6">
                        <p class="text-xs sm:text-sm font-semibold text-white/95 leading-relaxed mb-4 drop-shadow-sm">
                            Ishonchli manzillar.<br>
                            Barqaror hayot.
                        </p>

                        <div class="flex items-center gap-2">
                            <span class="w-7 h-1.5 rounded-full bg-white shadow-sm"></span>
                            <span class="w-5 h-1.5 rounded-full bg-white/40"></span>
                            <span class="w-5 h-1.5 rounded-full bg-white/40"></span>
                        </div>
                    </div>
                </div>

                <!-- Right Form Side -->
                <div class="w-full md:w-[54%] lg:w-[52%] p-6 sm:p-10 lg:p-12 flex flex-col justify-between relative bg-white">
                    
                    <!-- Header Bar (Back button & Language) -->
                    <div class="flex items-center justify-between pb-3">
                        <button type="button" onclick="goToStepSelect()" 
                                class="inline-flex items-center gap-2 text-xs font-extrabold text-slate-500 hover:text-[#0077FE] transition-colors cursor-pointer">
                            <i class="fa-solid fa-chevron-left text-[11px]"></i>
                            <span>Hisob turini tanlash</span>
                        </button>

                        <div class="flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-full border border-slate-200 text-xs font-bold text-slate-700">
                            <i class="fa-solid fa-globe text-[#0077FE]"></i>
                            <span>O'zbekcha</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Title & Tagline -->
                    <div class="mt-2 mb-6">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                                Ro'yxatdan o'tish
                            </h2>
                            <span id="badge-selected-role" class="text-[11px] font-extrabold text-[#0077FE] bg-[#EBF4FF] border border-blue-100 px-3 py-1 rounded-full">
                                Oddiy foydalanuvchi
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 font-medium mt-1">
                            Yangi imkoniyatlar sari birinchi qadam
                        </p>
                    </div>

                    <!-- Validation Errors Banner -->
                    @if ($errors->any())
                        <div class="mb-4 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                            <div class="flex items-center gap-2 font-bold mb-1">
                                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                                <span>Iltimos, ma'lumotlarni to'g'ri kiriting:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-0.5 ml-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-3.5">
                        @csrf
                        <input type="hidden" name="role" id="form_role_input" value="{{ old('role', 'client') }}">
                        <input type="hidden" name="first_name" id="first_name_hidden" value="{{ old('first_name') }}">
                        <input type="hidden" name="last_name" id="last_name_hidden" value="{{ old('last_name') }}">
                        <input type="hidden" name="password_confirmation" id="password_confirmation_input" value="">

                        <!-- Input 1: Ism familiyangiz -->
                        <div class="form-input-box rounded-2xl flex items-center px-4">
                            <span class="text-slate-400 text-base mr-3.5 flex-shrink-0">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" name="full_name" id="full_name_input" required
                                   value="{{ old('full_name', (old('first_name') ? trim(old('first_name') . ' ' . old('last_name')) : '')) }}"
                                   placeholder="Ism familiyangiz"
                                   autocomplete="name"
                                   class="w-full bg-transparent text-sm text-slate-900 placeholder-slate-400 font-medium outline-none">
                        </div>

                        <!-- Input 2: Telefon raqamingiz -->
                        <div class="form-input-box rounded-2xl flex items-center px-4">
                            <div class="flex items-center gap-2 pr-3.5 border-r border-slate-200 text-slate-700 font-bold text-sm select-none flex-shrink-0">
                                <i class="fa-solid fa-phone text-slate-400 text-xs"></i>
                                <span>+998</span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                            </div>
                            <input type="tel" name="phone" id="phone_input" required
                                   maxlength="14"
                                   value="{{ old('phone') }}"
                                   placeholder="90 123 45 67"
                                   autocomplete="tel"
                                   class="w-full pl-3.5 bg-transparent text-sm text-slate-900 placeholder-slate-400 font-medium outline-none">
                        </div>

                        <!-- Input 3: Parol -->
                        <div class="form-input-box rounded-2xl flex items-center px-4">
                            <span class="text-slate-400 text-base mr-3.5 flex-shrink-0">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password_input" required
                                   placeholder="Parol"
                                   class="w-full bg-transparent text-sm text-slate-900 placeholder-slate-400 font-medium outline-none">
                            <button type="button" onclick="togglePasswordVisibility('password_input', this)"
                                    class="text-slate-400 hover:text-slate-600 pl-2 transition-colors cursor-pointer flex-shrink-0">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="btn-blue-cta w-full h-[52px] rounded-2xl font-black text-sm sm:text-base flex items-center justify-center gap-3 shadow-md cursor-pointer mt-1">
                            <span>Ro'yxatdan o'tish</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative flex py-4 items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-4 text-xs text-slate-400 font-medium">Yoki quyidagilar orqali</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>

                    <!-- 3 Social / Alternative Register Options -->
                    <div class="grid grid-cols-3 gap-2.5 mb-5">
                        
                        <!-- Telegram Button -->
                        <button type="button" onclick="handleSocialAuth('Telegram')"
                                class="social-card rounded-2xl py-3 px-2 flex flex-col items-center justify-center gap-1 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-[#0088CC] flex items-center justify-center text-white text-base shadow-xs">
                                <i class="fa-brands fa-telegram"></i>
                            </div>
                            <span class="text-[11px] font-bold text-slate-700 leading-tight text-center">
                                Telegram <br><span class="text-[10px] font-normal text-slate-400">orqali</span>
                            </span>
                        </button>

                        <!-- QR-kod Button -->
                        <button type="button" onclick="handleSocialAuth('QR-kod')"
                                class="social-card rounded-2xl py-3 px-2 flex flex-col items-center justify-center gap-1 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[#0077FE] text-base shadow-xs">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                            <span class="text-[11px] font-bold text-slate-700 leading-tight text-center">
                                QR-kod <br><span class="text-[10px] font-normal text-slate-400">orqali</span>
                            </span>
                        </button>

                        <!-- Google Button -->
                        <a id="google-signup-btn" href="{{ route('auth.google', ['role' => old('role', 'client')]) }}"
                                class="social-card rounded-2xl py-3 px-2 flex flex-col items-center justify-center gap-1 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center shadow-xs">
                                <svg class="w-4 h-4" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                                </svg>
                            </div>
                            <span class="text-[11px] font-bold text-slate-700 leading-tight text-center">
                                Google <br><span class="text-[10px] font-normal text-slate-400">orqali</span>
                            </span>
                        </a>

                    </div>

                    <!-- Bottom Login Redirect with Envelope Icon -->
                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500 font-medium">
                        <i class="fa-regular fa-envelope text-slate-400"></i>
                        <span>Hisobingiz bormi?</span>
                        <a href="{{ route('login') }}" class="text-[#0077FE] font-bold hover:underline">Kirish</a>
                    </div>

                </div>

            </div>

        </div>

    </main>

    <!-- ============================================================ -->
    <!-- FOOTER -->
    <!-- ============================================================ -->
    <footer class="w-full max-w-6xl mx-auto text-center py-4 px-4 text-xs text-slate-400 font-medium z-10">
        &copy; 2026 Estora Real Estate. Barcha huquqlar himoyalangan.
    </footer>

    <!-- ============================================================ -->
    <!-- JAVASCRIPT LOGIC -->
    <!-- ============================================================ -->
    <script>
        const roleLabels = {
            client: "Oddiy foydalanuvchi",
            owner: "Uy egasi",
            makler: "Makler",
            hotel: "Mehmonxona",
            builder: "Qurilish"
        };

        let selectedRole = "{{ old('role', 'client') }}";

        // Handle role selection on Step 1
        function selectRole(role, element) {
            selectedRole = role;
            
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });

            element.classList.add('selected');
            syncRole(role);
        }

        function syncRole(role) {
            const roleInput = document.getElementById('form_role_input');
            const roleBadge = document.getElementById('badge-selected-role');
            const googleBtn = document.getElementById('google-signup-btn');
            
            if (roleInput) roleInput.value = role;
            if (roleBadge) roleBadge.textContent = roleLabels[role] || "Oddiy foydalanuvchi";
            if (googleBtn) googleBtn.href = "{{ route('auth.google') }}?role=" + role;
        }

        // Navigate to Step 2
        function goToStepForm() {
            syncRole(selectedRole);
            const stepSelect = document.getElementById('step-role-select');
            const stepForm = document.getElementById('step-register-form');

            stepSelect.classList.add('hidden');
            stepForm.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Navigate back to Step 1
        function goToStepSelect() {
            const stepSelect = document.getElementById('step-role-select');
            const stepForm = document.getElementById('step-register-form');

            stepForm.classList.add('hidden');
            stepSelect.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Password visibility toggle
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Locked roles toast
        function showLockedToast(roleName) {
            showToast(`${roleName} bo'limi tez orada ishga tushadi!`);
        }

        // Social auth placeholder notification
        function handleSocialAuth(provider) {
            showToast(`${provider} orqali ro'yxatdan o'tish tez kunda ishga tushadi!`);
        }

        // Toast notification helper
        function showToast(message) {
            const oldToast = document.getElementById('auth-toast');
            if (oldToast) oldToast.remove();

            const toast = document.createElement('div');
            toast.id = 'auth-toast';
            toast.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/95 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-slate-700 backdrop-blur-md anim-fade-step text-xs font-bold';
            toast.innerHTML = `
                <i class="fa-solid fa-circle-info text-[#0077FE] text-sm"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'all 0.3s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, 15px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Full name splitting into first_name and last_name
        function splitFullName() {
            const fullNameInput = document.getElementById('full_name_input');
            const firstNameHidden = document.getElementById('first_name_hidden');
            const lastNameHidden = document.getElementById('last_name_hidden');

            if (!fullNameInput || !firstNameHidden || !lastNameHidden) return;

            const fullName = (fullNameInput.value || '').trim();
            if (fullName) {
                const parts = fullName.split(/\s+/);
                const firstName = parts[0] || '';
                const lastName = parts.slice(1).join(' ') || parts[0] || '';
                firstNameHidden.value = firstName;
                lastNameHidden.value = lastName;
            }
        }

        const fullNameElem = document.getElementById('full_name_input');
        if (fullNameElem) {
            fullNameElem.addEventListener('input', splitFullName);
            fullNameElem.addEventListener('blur', splitFullName);
        }

        // Phone input formatting (90 123 45 67)
        const phoneElem = document.getElementById('phone_input');
        if (phoneElem) {
            phoneElem.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                // If user pastes +998... strip 998 prefix
                if (val.startsWith('998') && val.length > 3) {
                    val = val.substring(3);
                }
                val = val.substring(0, 9); // max 9 digits
                
                let formatted = '';
                if (val.length > 0) formatted += val.substring(0, 2);
                if (val.length > 2) formatted += ' ' + val.substring(2, 5);
                if (val.length > 5) formatted += ' ' + val.substring(5, 7);
                if (val.length > 7) formatted += ' ' + val.substring(7, 9);
                
                e.target.value = formatted;
            });
        }

        // Auto-sync before submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            splitFullName();

            const password = document.getElementById('password_input').value;
            document.getElementById('password_confirmation_input').value = password;

            // Ensure clean +998 format for phone
            if (phoneElem) {
                const digits = phoneElem.value.replace(/\D/g, '');
                if (digits.length === 9) {
                    phoneElem.value = '+998' + digits;
                } else if (digits.length === 12 && digits.startsWith('998')) {
                    phoneElem.value = '+' + digits;
                }
            }
        });

        // Initialize with default role
        syncRole(selectedRole);
        splitFullName();
    </script>
</body>
</html>
