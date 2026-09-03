<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tizimga Kirish - Estora</title>
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
            background-image: 
                radial-gradient(circle at 10% 15%, rgba(0, 102, 255, 0.08) 0%, transparent 45%),
                radial-gradient(circle at 90% 85%, rgba(255, 183, 3, 0.07) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(240, 246, 255, 0.5) 0%, transparent 100%);
            min-height: 100vh;
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

        .animate-fade-in-up {
            animation: fadeInUp 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="text-slate-800 antialiased py-4 sm:py-8 px-3.5 sm:px-6 flex flex-col justify-between min-h-screen">

    <!-- TOP BAR (BRAND & LANGUAGE) -->
    <header class="w-full max-w-6xl mx-auto flex items-center justify-between py-2 sm:py-4 mb-2 sm:mb-4">
        <a href="/" class="flex items-center gap-2 group hover:opacity-90 transition-opacity">
            <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-11 w-auto object-contain">
        </a>

        <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-xs text-xs font-bold text-slate-700">
            <i class="fa-solid fa-globe text-blue-600"></i>
            <span>O'zbekcha</span>
            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
        </div>
    </header>

    <main class="w-full max-w-md mx-auto flex-1 flex flex-col justify-center animate-fade-in-up">

        <!-- Info Banner (e.g. from Add Ad button) -->
        @if(session('info'))
            <div class="mb-4 p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 flex items-start gap-3 shadow-xs text-xs sm:text-sm">
                <i class="fa-solid fa-circle-info text-lg text-blue-600 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <span class="font-bold text-slate-900 block">{{ session('info') }}</span>
                    <span class="text-xs text-blue-700 block">Agar hali ro'yxatdan o'tmagan bo'lsangiz, <a href="{{ route('register') }}" class="underline font-bold text-blue-600 hover:text-blue-800">Ro'yxatdan o'ting &rarr;</a></span>
                </div>
            </div>
        @endif

        <!-- Login Card -->
        <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-xl">
            <div class="text-center mb-6">
                <span class="inline-block text-[11px] font-extrabold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-2">
                    Xush kelibsiz
                </span>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Tizimga kirish</h2>
                <p class="text-xs text-slate-500 mt-1">Hisobingizga kirish uchun ma'lumotlaringizni kiriting</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-red-50 border border-red-200 text-red-700">
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-5 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-2 text-xs font-bold">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Login input (Username or Email) -->
                <div>
                    <label for="login" class="form-label-styled">Email yoki Foydalanuvchi nomi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus
                            class="form-input-styled block w-full pl-10 pr-4 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                            placeholder="username yoki email...">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="form-label-styled mb-0">Mahfiy kalit (Parol)</label>
                        <a href="#" class="text-[11px] font-bold text-blue-600 hover:underline">Unutdingizmi?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required
                            class="form-input-styled block w-full pl-10 pr-10 rounded-xl text-slate-900 text-xs sm:text-sm placeholder-slate-400 focus:outline-none"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 transition-all cursor-pointer">
                            <i id="password-icon" class="fa-regular fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" value="1"
                            class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <span class="text-xs text-slate-600 font-medium">Meni eslab qol</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn-yellow-primary w-full py-3.5 px-4 mt-2 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Kirish</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <div class="mt-5 text-center text-xs text-slate-500 font-medium">
                Hisobingiz yo'qmi? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-bold ml-1">Ro'yxatdan o'tish</a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="w-full max-w-6xl mx-auto text-center py-4 text-xs text-slate-400 font-medium">
        &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
