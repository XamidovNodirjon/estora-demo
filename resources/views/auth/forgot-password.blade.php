<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parolni tiklash - Estora</title>
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

        .btn-yellow-primary:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
        @php
            $oldPhone = substr(preg_replace('/[^\d]/', '', (string) old('phone')), -9);
        @endphp

        <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-xl">
            <div class="text-center mb-6">
                <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                </div>
                <span class="inline-block text-[11px] font-extrabold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-2">
                    Parolni tiklash
                </span>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Parolni unutdingizmi?</h2>
                <p class="text-xs text-slate-500 mt-1">Hisobingizga bog'langan telefon raqamni kiriting</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-red-50 border border-red-200 text-red-700 flex items-start gap-2 text-xs font-semibold">
                    <i class="fa-solid fa-circle-exclamation text-sm mt-0.5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('password.send') }}" method="POST" class="space-y-4" id="forgotPasswordForm">
                @csrf

                <div>
                    <label for="phone" class="form-label-styled">Telefon raqam</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center gap-2 text-slate-700 text-sm font-bold pointer-events-none">
                            <i class="fa-solid fa-phone text-slate-400 text-xs"></i>
                            +998
                        </span>
                        <input type="tel" name="phone" id="phone" required autofocus inputmode="numeric" autocomplete="tel-national"
                            value="{{ $oldPhone }}"
                            class="form-input-styled block w-full pl-[86px] pr-4 rounded-xl text-slate-900 text-sm font-semibold tracking-wide placeholder-slate-400 focus:outline-none {{ $errors->has('phone') ? 'border-red-300' : '' }}"
                            placeholder="90 123 45 67">
                    </div>
                </div>

                <!-- How it works -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2.5">
                    <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">1</span>
                        <span>Raqamingiz tizimda bor-yo'qligini tekshiramiz</span>
                    </div>
                    <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">2</span>
                        <span>Siz uchun <b class="text-slate-800">yangi parol</b> yaratamiz</span>
                    </div>
                    <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">3</span>
                        <span><b class="text-slate-800">Loginingiz va yangi parolingiz</b> SMS orqali keladi</span>
                    </div>
                </div>

                <button type="submit" id="forgotPasswordSubmit"
                    class="btn-yellow-primary w-full py-3.5 px-4 mt-2 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Yangi parol olish</span>
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
            </form>

            <div class="mt-5 text-center text-xs text-slate-500 font-medium">
                Parolingiz esingizga tushdimi?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-bold ml-1">Tizimga kirish</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full max-w-6xl mx-auto text-center py-4 text-xs text-slate-400 font-medium">
        &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
    </footer>

    <script>
        (function () {
            const input = document.getElementById('phone');

            // "901234567" -> "90 123 45 67"
            function formatPhone(value) {
                let digits = value.replace(/\D/g, '');
                if (digits.length > 9 && digits.startsWith('998')) digits = digits.slice(3);
                digits = digits.slice(0, 9);
                return [digits.slice(0, 2), digits.slice(2, 5), digits.slice(5, 7), digits.slice(7, 9)].filter(Boolean).join(' ');
            }

            input.value = formatPhone(input.value);
            input.addEventListener('input', () => { input.value = formatPhone(input.value); });

            document.getElementById('forgotPasswordForm').addEventListener('submit', function () {
                const btn = document.getElementById('forgotPasswordSubmit');
                btn.disabled = true;
                btn.querySelector('span').textContent = 'Yuborilmoqda...';
            });
        })();
    </script>

</body>
</html>
