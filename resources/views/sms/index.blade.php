@extends($layout)

@section('title', 'SMS Habarnomalar')
@section('header_title', 'SMS Habarnomalar va USMS Balans')

@section('content')
<div class="space-y-6">

    <!-- Top Grid: Balance Card & Summary -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- USMS Balance Card -->
        <div class="lg:col-span-1 bg-gradient-to-br from-[#061c3f] to-[#0B2240] rounded-2xl p-6 text-white shadow-lg relative overflow-hidden flex flex-col justify-between">
            <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-[#0084ff]/10 rounded-full blur-2xl pointer-events-none"></div>

            <div>
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-blue-200 border border-white/10">
                        <i class="fa-solid fa-wallet text-[#ff9e0d]"></i> USMS.uz Hisob
                    </span>
                    <span id="balance_status_badge" class="text-xs px-2.5 py-0.5 rounded-full {{ !empty($cachedBalanceData['success']) ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-white/10 text-gray-300' }}">
                        {{ !empty($cachedBalanceData['is_mock']) ? 'Test Rejimi' : (!empty($cachedBalanceData['success']) ? 'Faol' : 'Kutilmoqda') }}
                    </span>
                </div>

                <div class="text-xs uppercase tracking-wider text-gray-300 font-medium mb-1">
                    Joriy Balans
                </div>
                <div class="flex items-baseline gap-2 mb-2">
                    <h2 id="balance_amount_display" class="text-3xl font-display font-extrabold text-white tracking-tight">
                        {{ $cachedBalanceData['formatted_balance'] ?? "— so'm" }}
                    </h2>
                </div>

                <p class="text-xs text-gray-400 flex items-center gap-1.5 mb-5">
                    <i class="fa-regular fa-clock text-gray-400"></i>
                    <span>Oxirgi yangilanish:</span>
                    <strong id="balance_updated_display" class="text-gray-300 font-medium">
                        {{ $balanceUpdatedAt ?? "Hali yangilanmagan" }}
                    </strong>
                </p>
            </div>

            <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                <button type="button" 
                        id="btn_refresh_balance" 
                        onclick="refreshUsmsBalance()" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white text-sm font-semibold transition-all duration-200 shadow-md active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i id="btn_refresh_icon" class="fa-solid fa-arrows-rotate"></i>
                    <span id="btn_refresh_text">Balansni yangilash</span>
                </button>

                <span class="text-[11px] text-gray-400 italic text-right max-w-[150px]">
                    Faqat tugma bosilganda so'rov ketadi
                </span>
            </div>
        </div>

        <!-- Quick Statistics -->
        <div class="lg:col-span-2 grid grid-cols-2 sm:grid-cols-4 gap-4">
            <!-- Total SMS -->
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jami SMS</span>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0084ff] flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-display font-bold text-[#061c3f]">{{ number_format($totalCount) }}</h3>
                    <span class="text-xs text-gray-500">Barcha vaqtdagi</span>
                </div>
            </div>

            <!-- Today SMS -->
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Bugungi SMS</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#ff9e0d] flex items-center justify-center">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-display font-bold text-[#061c3f]">{{ number_format($todayCount) }}</h3>
                    <span class="text-xs text-gray-500">Bugungi yuborilgan</span>
                </div>
            </div>

            <!-- Delivered (Sent) -->
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Yetkazildi</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-display font-bold text-emerald-600">{{ number_format($sentCount) }}</h3>
                    <span class="text-xs text-gray-500">Muvaffaqiyatli SMS</span>
                </div>
            </div>

            <!-- Pending or Failed -->
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Navbat / Xato</span>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-xl font-display font-bold text-purple-700">{{ $pendingCount }}</h3>
                        <span class="text-xs text-gray-400">/</span>
                        <h3 class="text-xl font-display font-bold text-red-600">{{ $failedCount }}</h3>
                    </div>
                    <span class="text-xs text-gray-500">Navbatda / Xatolik</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert / Status Toast Banner -->
    <div id="status_toast" class="hidden rounded-xl p-4 text-sm font-medium transition-all duration-300 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i id="toast_icon" class="fa-solid fa-circle-check text-lg"></i>
            <span id="toast_message">Xabar matni</span>
        </div>
        <button type="button" onclick="hideToast()" class="text-current opacity-70 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <!-- Table Header & Filters -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-display font-bold text-lg text-[#061c3f]">Yuborilgan SMS'lar Ro'yxati</h3>
                    <p class="text-xs text-gray-500 mt-1">Ro'yxatdan o'tish va tasdiqlash uchun yuborilgan barcha SMS xabarlar</p>
                </div>

                <!-- Filters & Search -->
                <form action="{{ route($routePrefix . '.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="text-sm bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0084ff]/30 focus:border-[#0084ff]">
                        <option value="">Barcha holatlar</option>
                        <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Muvaffaqiyatli (Yetkazildi)</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Navbatda (Kutilmoqda)</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Xatolik bo'lgan</option>
                    </select>

                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Telefon yoki kod..." 
                               class="text-sm bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0084ff]/30 focus:border-[#0084ff] w-48 sm:w-64">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-[#061c3f] hover:bg-[#0B2240] text-white text-sm font-medium rounded-xl transition-all">
                        Qidirish
                    </button>

                    @if(request()->hasAny(['status', 'search']))
                        <a href="{{ route($routePrefix . '.index') }}" class="px-3 py-2 text-xs text-gray-500 hover:text-red-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all" title="Filtrni tozalash">
                            <i class="fa-solid fa-rotate-left"></i> Tozalash
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/70 text-gray-500 text-xs uppercase font-semibold border-b border-gray-100">
                    <tr>
                        <th class="py-3.5 px-6"># ID</th>
                        <th class="py-3.5 px-6">Telefon Raqami</th>
                        <th class="py-3.5 px-6">SMS Kodi / Xabar</th>
                        <th class="py-3.5 px-6">Holati</th>
                        <th class="py-3.5 px-6">Yuborilgan Vaqti</th>
                        <th class="py-3.5 px-6 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($smsNotifications as $sms)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-mono text-xs text-gray-400">
                                #{{ $sms->id }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#0084ff] flex items-center justify-center flex-shrink-0 text-xs">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <span class="font-mono font-bold text-gray-800 text-sm tracking-wide">
                                        {{ $sms->phone }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($sms->code)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                        {{ $sms->code }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500 truncate max-w-xs block">
                                        {{ $sms->message ?? '—' }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($sms->status === 'sent')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Yetkazildi
                                    </span>
                                @elseif($sms->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Navbatda
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Xatolik
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">
                                        {{ $sms->sent_at ? $sms->sent_at->format('d.m.Y H:i:s') : $sms->created_at->format('d.m.Y H:i:s') }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">
                                        {{ $sms->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <button type="button" 
                                        onclick="showSmsDetailModal({{ json_encode([
                                            'id' => $sms->id,
                                            'phone' => $sms->phone,
                                            'code' => $sms->code,
                                            'message' => $sms->message,
                                            'status' => $sms->status,
                                            'error' => $sms->error,
                                            'response' => $sms->response,
                                            'created_at' => $sms->created_at->format('d.m.Y H:i:s'),
                                            'sent_at' => $sms->sent_at ? $sms->sent_at->format('d.m.Y H:i:s') : null,
                                        ]) }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 bg-gray-100 hover:bg-[#0084ff] hover:text-white transition-all shadow-sm"
                                        title="Batafsil">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Tafsilot</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-solid fa-inbox text-3xl text-gray-300"></i>
                                    <p class="text-sm font-medium">Hozircha hech qanday SMS yuborilmagan.</p>
                                    @if(request()->hasAny(['status', 'search']))
                                        <a href="{{ route($routePrefix . '.index') }}" class="text-xs text-[#0084ff] hover:underline mt-1">
                                            Filtrni tozalash
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($smsNotifications->hasPages())
            <div class="p-6 border-t border-gray-100 bg-gray-50/40">
                {{ $smsNotifications->links() }}
            </div>
        @endif
    </div>

</div>

<!-- SMS Detail Modal -->
<div id="smsDetailModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 bg-[#061c3f] text-white flex items-center justify-between">
            <h4 class="font-display font-bold text-base flex items-center gap-2">
                <i class="fa-solid fa-comment-sms text-[#ff9e0d]"></i>
                <span>SMS Tafsilotlari</span>
                <span id="modal_sms_id" class="text-xs font-mono text-gray-400"></span>
            </h4>
            <button type="button" onclick="closeSmsDetailModal()" class="text-gray-300 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-100">
                <div>
                    <span class="text-xs text-gray-400 block mb-0.5">Telefon Raqami</span>
                    <strong id="modal_phone" class="font-mono text-gray-900 text-base"></strong>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block mb-0.5">Holati</span>
                    <div id="modal_status"></div>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block mb-0.5">Tasdiqlash Kodi</span>
                    <strong id="modal_code" class="font-mono text-gray-900"></strong>
                </div>
                <div>
                    <span class="text-xs text-gray-400 block mb-0.5">Yuborilgan Vaqt</span>
                    <span id="modal_time" class="text-gray-700"></span>
                </div>
            </div>

            <div id="modal_error_box" class="hidden p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                <strong class="block mb-1 flex items-center gap-1">
                    <i class="fa-solid fa-triangle-exclamation"></i> Xatolik xabari:
                </strong>
                <span id="modal_error_text"></span>
            </div>

            <div>
                <span class="text-xs text-gray-400 block mb-1">Server / API Javobi:</span>
                <pre id="modal_response" class="bg-gray-900 text-emerald-400 p-3 rounded-xl text-xs font-mono overflow-x-auto max-h-48 whitespace-pre-wrap"></pre>
            </div>
        </div>

        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button type="button" onclick="closeSmsDetailModal()" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-semibold transition-all">
                Yopish
            </button>
        </div>
    </div>
</div>

<script>
    const refreshBalanceUrl = "{{ route($routePrefix . '.balance') }}";
    const csrfToken = "{{ csrf_token() }}";

    async function refreshUsmsBalance() {
        const btn = document.getElementById('btn_refresh_balance');
        const icon = document.getElementById('btn_refresh_icon');
        const text = document.getElementById('btn_refresh_text');
        const display = document.getElementById('balance_amount_display');
        const updatedDisplay = document.getElementById('balance_updated_display');
        const statusBadge = document.getElementById('balance_status_badge');

        // Loading state
        btn.disabled = true;
        icon.classList.add('fa-spin');
        text.innerText = 'Yuklanmoqda...';

        try {
            const response = await fetch(refreshBalanceUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                display.innerText = data.formatted_balance || (data.balance + " so'm");
                updatedDisplay.innerText = data.updated_at || 'Hozir';
                
                statusBadge.className = 'text-xs px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30';
                statusBadge.innerText = 'Faol';

                showToast(data.message || 'Balans yangilandi!', 'success');
            } else {
                showToast(data.message || 'Balansni yangilashda xatolik yuz berdi.', 'error');
            }
        } catch (error) {
            console.error('Balance refresh error:', error);
            showToast('Server bilan aloqa xatoligi.', 'error');
        } finally {
            btn.disabled = false;
            icon.classList.remove('fa-spin');
            text.innerText = 'Balansni yangilash';
        }
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('status_toast');
        const msg = document.getElementById('toast_message');
        const icon = document.getElementById('toast_icon');

        msg.innerText = message;
        toast.classList.remove('hidden');

        if (type === 'success') {
            toast.className = 'rounded-xl p-4 text-sm font-medium transition-all duration-300 flex items-center justify-between bg-emerald-50 text-emerald-800 border border-emerald-200';
            icon.className = 'fa-solid fa-circle-check text-emerald-600 text-lg';
        } else {
            toast.className = 'rounded-xl p-4 text-sm font-medium transition-all duration-300 flex items-center justify-between bg-red-50 text-red-800 border border-red-200';
            icon.className = 'fa-solid fa-triangle-exclamation text-red-600 text-lg';
        }

        setTimeout(() => {
            hideToast();
        }, 5000);
    }

    function hideToast() {
        const toast = document.getElementById('status_toast');
        toast.classList.add('hidden');
    }

    function showSmsDetailModal(data) {
        document.getElementById('modal_sms_id').innerText = '#' + data.id;
        document.getElementById('modal_phone').innerText = data.phone;
        document.getElementById('modal_code').innerText = data.code || '—';
        document.getElementById('modal_time').innerText = data.sent_at || data.created_at;

        const statusEl = document.getElementById('modal_status');
        if (data.status === 'sent') {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Yetkazildi</span>';
        } else if (data.status === 'pending') {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Navbatda</span>';
        } else {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Xatolik</span>';
        }

        const errBox = document.getElementById('modal_error_box');
        const errText = document.getElementById('modal_error_text');
        if (data.error) {
            errBox.classList.remove('hidden');
            errText.innerText = data.error;
        } else {
            errBox.classList.add('hidden');
        }

        const respBox = document.getElementById('modal_response');
        try {
            const parsed = JSON.parse(data.response);
            respBox.innerText = JSON.stringify(parsed, null, 2);
        } catch (e) {
            respBox.innerText = data.response || "Javob ma'lumoti mavjud emas";
        }

        document.getElementById('smsDetailModal').classList.remove('hidden');
    }

    function closeSmsDetailModal() {
        document.getElementById('smsDetailModal').classList.add('hidden');
    }
</script>
@endsection
