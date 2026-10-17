<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .code-input {
            height: 56px;
            font-size: 24px;
            letter-spacing: 12px;
            text-indent: 12px;
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

        .btn-outline {
            background: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            color: #334155;
            transition: all 0.25s ease;
        }

        .btn-outline:hover {
            border-color: #0066FF;
            color: #0066FF;
            background: #F5F9FF;
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

        /* Modal */
        .reset-modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
        }

        .reset-modal.is-open {
            display: flex;
        }

        .reset-modal-panel {
            width: 100%;
            max-width: 420px;
            max-height: calc(100vh - 32px);
            overflow-y: auto;
        }

        .reset-step {
            display: none;
        }

        .reset-step.is-active {
            display: block;
            animation: fadeInUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-slate-800 antialiased py-4 sm:py-8 px-3.5 sm:px-6 flex flex-col justify-between min-h-screen">

    <!-- TOP BAR (BRAND & LANGUAGE) -->
    <header class="w-full max-w-6xl mx-auto flex items-center justify-between py-2 sm:py-4 mb-2 sm:mb-4">
        <a href="/" class="flex items-center gap-2 group hover:opacity-90 transition-opacity">
            <img src="{{ asset('image/orginal.png') }}" alt="ESTORA Real Estate" class="h-9 sm:h-11 w-auto object-contain">
        </a>

        <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-xs text-xs font-bold text-slate-700">
            <i class="fa-solid fa-globe text-blue-600"></i>
            <span>O'zbekcha</span>
            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
        </div>
    </header>

    <main class="w-full max-w-md mx-auto flex-1 flex flex-col justify-center animate-fade-in-up">
        <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-xl">
            <div class="text-center mb-6">
                <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                </div>
                <span class="inline-block text-[11px] font-extrabold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-2">
                    Parolni tiklash
                </span>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Parolni unutdingizmi?</h2>
                <p class="text-xs text-slate-500 mt-1">Hisobingizni bir necha qadamda tiklab olasiz</p>
            </div>

            <!-- How it works -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2.5">
                <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                    <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">1</span>
                    <span><b class="text-slate-800">Username</b> yoki <b class="text-slate-800">telefon raqamingizni</b> kiritasiz</span>
                </div>
                <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                    <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">2</span>
                    <span>Emailingiz yoki telefoningizga kelgan <b class="text-slate-800">tasdiqlash kodini</b> kiritasiz</span>
                </div>
                <div class="flex items-start gap-3 text-[11.5px] text-slate-600">
                    <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-black flex items-center justify-center flex-shrink-0">3</span>
                    <span><b class="text-slate-800">Yangi parol</b> o'rnatasiz</span>
                </div>
            </div>

            <button type="button" data-open-reset
                class="btn-yellow-primary w-full py-3.5 px-4 mt-5 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                <span>Parolni tiklash</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>

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

    <!-- PAROLNI TIKLASH MODALI -->
    <div class="reset-modal" id="resetModal" role="dialog" aria-modal="true" aria-labelledby="resetModalTitle">
        <div class="reset-modal-panel bg-white rounded-3xl p-6 sm:p-7 shadow-2xl relative">
            <button type="button" data-close-reset aria-label="Yopish"
                class="absolute top-4 right-4 w-8 h-8 rounded-full text-slate-400 hover:text-slate-700 hover:bg-slate-100 flex items-center justify-center cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div id="resetError" class="hidden mb-4 p-3.5 rounded-2xl bg-red-50 border border-red-200 text-red-700 flex items-start gap-2 text-xs font-semibold">
                <i class="fa-solid fa-circle-exclamation text-sm mt-0.5"></i>
                <span data-text></span>
            </div>

            <!-- 1. Username esingizdami? -->
            <div class="reset-step is-active" data-step="choice">
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <h3 id="resetModalTitle" class="text-xl font-black text-slate-900 tracking-tight">Username esingizdami?</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Esingizda bo'lsa, tasdiqlash kodi emailingizga (email bo'lmasa telefoningizga) yuboriladi.
                        Aks holda telefon raqamingiz orqali tiklaymiz.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button type="button" data-go="username"
                        class="btn-yellow-primary py-3.5 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                        <i class="fa-solid fa-check text-xs"></i>
                        <span>Ha</span>
                    </button>
                    <button type="button" data-go="phone"
                        class="btn-outline py-3.5 rounded-2xl font-black text-sm flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-xmark text-xs"></i>
                        <span>Yo'q</span>
                    </button>
                </div>
            </div>

            <!-- 2a. Username -->
            <form class="reset-step space-y-4" data-step="username" novalidate>
                <div class="text-center">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Username'ingizni kiriting</h3>
                    <p class="text-xs text-slate-500 mt-1.5">Hisobingizni topib, tasdiqlash kodini yuboramiz</p>
                </div>
                <div>
                    <label for="resetUsername" class="form-label-styled">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-solid fa-at"></i>
                        </span>
                        <input type="text" id="resetUsername" autocomplete="username" autocapitalize="none" spellcheck="false"
                            class="form-input-styled block w-full pl-10 pr-4 rounded-xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:outline-none"
                            placeholder="masalan: aziz_karimov">
                    </div>
                </div>
                <button type="submit"
                    class="btn-yellow-primary w-full py-3.5 px-4 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Kod yuborish</span>
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
                <button type="button" data-go="choice" class="w-full text-xs font-bold text-slate-500 hover:text-blue-600 cursor-pointer">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Orqaga
                </button>
            </form>

            <!-- 2b. Telefon raqam -->
            <form class="reset-step space-y-4" data-step="phone" novalidate>
                <div class="text-center">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Telefon raqamingizni kiriting</h3>
                    <p class="text-xs text-slate-500 mt-1.5">Hisobingizga bog'langan raqamga SMS kod yuboramiz</p>
                </div>
                <div>
                    <label for="resetPhone" class="form-label-styled">Telefon raqam</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center gap-2 text-slate-700 text-sm font-bold pointer-events-none">
                            <i class="fa-solid fa-phone text-slate-400 text-xs"></i>
                            +998
                        </span>
                        <input type="tel" id="resetPhone" inputmode="numeric" autocomplete="tel-national"
                            class="form-input-styled block w-full pl-[86px] pr-4 rounded-xl text-slate-900 text-sm font-semibold tracking-wide placeholder-slate-400 focus:outline-none"
                            placeholder="90 123 45 67">
                    </div>
                </div>
                <button type="submit"
                    class="btn-yellow-primary w-full py-3.5 px-4 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>SMS kod yuborish</span>
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
                <button type="button" data-go="choice" class="w-full text-xs font-bold text-slate-500 hover:text-blue-600 cursor-pointer">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Orqaga
                </button>
            </form>

            <!-- 3. Tasdiqlash kodi -->
            <form class="reset-step space-y-4" data-step="code" novalidate>
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-envelope-open-text" data-channel-icon></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Tasdiqlash kodi</h3>
                    <p class="text-xs text-slate-500 mt-1.5">
                        6 xonali kod <b class="text-slate-800" data-destination></b> <span data-channel-label></span> yuborildi
                    </p>
                </div>

                <div data-mock class="hidden p-3 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-flask"></i>
                    <span>Test rejimi — kod: <b class="font-mono text-sm" data-mock-code></b></span>
                </div>

                <div>
                    <label for="resetCode" class="form-label-styled">Kod</label>
                    <input type="text" id="resetCode" inputmode="numeric" autocomplete="one-time-code" maxlength="6"
                        class="form-input-styled code-input block w-full px-4 rounded-xl text-center text-slate-900 font-black placeholder-slate-300 focus:outline-none"
                        placeholder="••••••">
                    <div class="flex items-center justify-between mt-2 text-[11px] font-semibold text-slate-500">
                        <span>Amal qiladi: <b class="text-slate-800" data-expires>05:00</b></span>
                        <button type="button" data-resend class="text-blue-600 font-bold hover:underline disabled:text-slate-400 disabled:no-underline cursor-pointer disabled:cursor-default">
                            Qayta yuborish
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="btn-yellow-primary w-full py-3.5 px-4 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Tasdiqlash</span>
                    <i class="fa-solid fa-check text-xs"></i>
                </button>
                <button type="button" data-go="choice" class="w-full text-xs font-bold text-slate-500 hover:text-blue-600 cursor-pointer">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Boshqa usul bilan tiklash
                </button>
            </form>

            <!-- 4. Yangi parol -->
            <form class="reset-step space-y-4" data-step="reset" novalidate>
                <div class="text-center">
                    <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Yangi parol o'rnating</h3>
                    <p class="text-xs text-slate-500 mt-1.5">Kod tasdiqlandi. Username'ingiz quyida ko'rsatilgan</p>
                </div>

                <div>
                    <label for="newUsername" class="form-label-styled">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-solid fa-at"></i>
                        </span>
                        <input type="text" id="newUsername" autocomplete="username" autocapitalize="none" spellcheck="false"
                            class="form-input-styled block w-full pl-10 pr-4 rounded-xl text-slate-900 text-sm font-semibold focus:outline-none">
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">Xohlasangiz username'ni ham o'zgartirishingiz mumkin</p>
                </div>

                <div>
                    <label for="newPassword" class="form-label-styled">Yangi parol</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="newPassword" autocomplete="new-password" minlength="6"
                            class="form-input-styled block w-full pl-10 pr-11 rounded-xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:outline-none"
                            placeholder="Kamida 6 ta belgi">
                        <button type="button" data-toggle-password="newPassword" aria-label="Parolni ko'rsatish"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 cursor-pointer">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="newPasswordConfirmation" class="form-label-styled">Parolni tasdiqlang</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm pointer-events-none">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="newPasswordConfirmation" autocomplete="new-password"
                            class="form-input-styled block w-full pl-10 pr-11 rounded-xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:outline-none"
                            placeholder="Parolni qayta kiriting">
                        <button type="button" data-toggle-password="newPasswordConfirmation" aria-label="Parolni ko'rsatish"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 cursor-pointer">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="btn-yellow-primary w-full py-3.5 px-4 rounded-2xl font-black text-sm flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <span>Parolni yangilash</span>
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const routes = {
                sendCode: @json(route('password.send-code')),
                verifyCode: @json(route('password.verify-code')),
                reset: @json(route('password.reset')),
            };
            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            const modal = document.getElementById('resetModal');
            const errorBox = document.getElementById('resetError');
            const steps = modal.querySelectorAll('[data-step]');
            const codeStep = modal.querySelector('[data-step="code"]');
            const resendBtn = codeStep.querySelector('[data-resend]');

            // Oxirgi kod so'rovi (qayta yuborish uchun)
            let lastRequest = null;
            let expiresTimer = null;
            let resendTimer = null;

            function openModal() {
                modal.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('is-open');
                document.body.style.overflow = '';
            }

            function showStep(name) {
                hideError();
                steps.forEach(step => step.classList.toggle('is-active', step.dataset.step === name));
                const input = modal.querySelector(`[data-step="${name}"] input`);
                if (input) setTimeout(() => input.focus(), 50);
            }

            function showError(message) {
                errorBox.querySelector('[data-text]').textContent = message;
                errorBox.classList.remove('hidden');
            }

            function hideError() {
                errorBox.classList.add('hidden');
            }

            function setLoading(form, loading, text) {
                const btn = form.querySelector('button[type="submit"]');
                const label = btn.querySelector('span');
                if (loading) {
                    btn.dataset.label = label.textContent;
                    label.textContent = text;
                } else if (btn.dataset.label) {
                    label.textContent = btn.dataset.label;
                }
                btn.disabled = loading;
            }

            async function post(url, payload) {
                let response;
                try {
                    response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                        },
                        body: JSON.stringify(payload),
                    });
                } catch (e) {
                    throw new Error("Internet aloqasini tekshirib, qayta urinib ko'ring.");
                }

                const data = await response.json().catch(() => ({}));
                if (response.ok) return data;

                if (response.status === 419) throw new Error("Sahifa muddati tugadi. Iltimos, sahifani yangilang.");
                if (response.status === 429) throw new Error("Juda ko'p urinish. Birozdan keyin qayta urinib ko'ring.");

                const firstError = data.errors ? Object.values(data.errors)[0][0] : null;
                throw new Error(firstError || data.message || "Xatolik yuz berdi. Qayta urinib ko'ring.");
            }

            function formatTime(seconds) {
                const m = String(Math.floor(seconds / 60)).padStart(2, '0');
                const s = String(seconds % 60).padStart(2, '0');
                return `${m}:${s}`;
            }

            function startCountdown(seconds, onTick, onDone) {
                let left = seconds;
                onTick(left);
                const timer = setInterval(() => {
                    left--;
                    if (left <= 0) {
                        clearInterval(timer);
                        onDone();
                    } else {
                        onTick(left);
                    }
                }, 1000);
                return timer;
            }

            function onCodeSent(data) {
                const isEmail = data.channel === 'email';
                codeStep.querySelector('[data-destination]').textContent = data.destination;
                codeStep.querySelector('[data-channel-label]').textContent = isEmail ? 'emailiga' : 'raqamiga SMS orqali';
                codeStep.querySelector('[data-channel-icon]').className = isEmail ? 'fa-solid fa-envelope-open-text' : 'fa-solid fa-comment-sms';

                const mock = codeStep.querySelector('[data-mock]');
                mock.classList.toggle('hidden', !data.mock_code);
                codeStep.querySelector('[data-mock-code]').textContent = data.mock_code || '';

                const expires = codeStep.querySelector('[data-expires]');
                clearInterval(expiresTimer);
                expiresTimer = startCountdown(data.expires_in,
                    left => { expires.textContent = formatTime(left); },
                    () => { expires.textContent = 'muddati tugadi'; });

                clearInterval(resendTimer);
                resendBtn.disabled = true;
                resendTimer = startCountdown(data.retry_after,
                    left => { resendBtn.textContent = `Qayta yuborish (${left})`; },
                    () => { resendBtn.disabled = false; resendBtn.textContent = 'Qayta yuborish'; });

                document.getElementById('resetCode').value = '';
                showStep('code');
            }

            async function requestCode(form, payload) {
                hideError();
                setLoading(form, true, 'Yuborilmoqda...');
                try {
                    const data = await post(routes.sendCode, payload);
                    lastRequest = payload;
                    onCodeSent(data);
                } catch (e) {
                    showError(e.message);
                } finally {
                    setLoading(form, false);
                }
            }

            // Telefon: "901234567" -> "90 123 45 67"
            const phoneInput = document.getElementById('resetPhone');
            function formatPhone(value) {
                let digits = value.replace(/\D/g, '');
                if (digits.length > 9 && digits.startsWith('998')) digits = digits.slice(3);
                digits = digits.slice(0, 9);
                return [digits.slice(0, 2), digits.slice(2, 5), digits.slice(5, 7), digits.slice(7, 9)].filter(Boolean).join(' ');
            }
            phoneInput.addEventListener('input', () => { phoneInput.value = formatPhone(phoneInput.value); });

            const codeInput = document.getElementById('resetCode');
            codeInput.addEventListener('input', () => { codeInput.value = codeInput.value.replace(/\D/g, '').slice(0, 6); });

            // Navigatsiya
            document.querySelectorAll('[data-open-reset]').forEach(btn => btn.addEventListener('click', () => {
                openModal();
                showStep('choice');
            }));
            modal.querySelectorAll('[data-close-reset]').forEach(btn => btn.addEventListener('click', closeModal));
            modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
            modal.querySelectorAll('[data-go]').forEach(btn => btn.addEventListener('click', () => showStep(btn.dataset.go)));

            modal.querySelectorAll('[data-toggle-password]').forEach(btn => btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.togglePassword);
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.querySelector('i').className = show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
            }));

            // 2a. Username bo'yicha
            modal.querySelector('[data-step="username"]').addEventListener('submit', function (e) {
                e.preventDefault();
                const username = document.getElementById('resetUsername').value.trim();
                if (!username) return showError('Username kiriting.');
                requestCode(this, { method: 'username', username });
            });

            // 2b. Telefon bo'yicha
            modal.querySelector('[data-step="phone"]').addEventListener('submit', function (e) {
                e.preventDefault();
                const phone = phoneInput.value.replace(/\D/g, '');
                if (phone.length !== 9) return showError("Telefon raqamni to'liq kiriting. Masalan: 90 123 45 67");
                requestCode(this, { method: 'phone', phone });
            });

            // Qayta yuborish
            resendBtn.addEventListener('click', () => {
                if (lastRequest) requestCode(codeStep, lastRequest);
            });

            // 3. Kodni tasdiqlash
            codeStep.addEventListener('submit', async function (e) {
                e.preventDefault();
                const code = codeInput.value;
                if (code.length !== 6) return showError('6 xonali tasdiqlash kodini kiriting.');

                hideError();
                setLoading(this, true, 'Tekshirilmoqda...');
                try {
                    const data = await post(routes.verifyCode, { code });
                    clearInterval(expiresTimer);
                    clearInterval(resendTimer);
                    document.getElementById('newUsername').value = data.username;
                    showStep('reset');
                    document.getElementById('newPassword').focus();
                } catch (err) {
                    showError(err.message);
                } finally {
                    setLoading(this, false);
                }
            });

            // 4. Yangi parol
            modal.querySelector('[data-step="reset"]').addEventListener('submit', async function (e) {
                e.preventDefault();
                const username = document.getElementById('newUsername').value.trim();
                const password = document.getElementById('newPassword').value;
                const passwordConfirmation = document.getElementById('newPasswordConfirmation').value;

                if (!username) return showError('Username kiriting.');
                if (password.length < 6) return showError("Parol kamida 6 ta belgidan iborat bo'lishi kerak.");
                if (password !== passwordConfirmation) return showError('Parollar mos kelmadi.');

                hideError();
                setLoading(this, true, 'Saqlanmoqda...');
                try {
                    const data = await post(routes.reset, {
                        username,
                        password,
                        password_confirmation: passwordConfirmation,
                    });
                    window.location.href = data.redirect;
                } catch (err) {
                    showError(err.message);
                    setLoading(this, false);
                }
            });

            // Sahifa ochilganda modal avtomatik chiqadi
            openModal();
        })();
    </script>

</body>
</html>
