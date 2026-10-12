@extends('layouts.manager')

@section('title', 'Lidlarim')
@section('header_title', 'Menga biriktirilgan lidlar')

@section('content')
@php($rejectedStatus = \App\Enums\LeadStatus::Rejected)

@if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3">
        <i class="fa-solid fa-circle-exclamation text-lg text-red-500 mt-0.5"></i>
        <ul class="text-sm font-medium space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#0084ff] to-[#0B2240] text-white flex items-center justify-center text-lg shadow-lg shadow-blue-500/20">
                <i class="fa-solid fa-address-book"></i>
            </div>
            <div>
                <h2 class="font-display font-bold text-xl text-[#061c3f]">Lidlarim</h2>
                <p class="text-xs text-gray-500">Har bir lid bilan aloqa natijasini status va izoh orqali belgilang</p>
            </div>
        </div>

        <form action="{{ route('manager.leads') }}" method="GET" class="flex items-center gap-2 w-full lg:w-auto">
            @if($status)
                <input type="hidden" name="status" value="{{ $status->value }}">
            @endif
            <div class="relative flex-1 lg:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}"
                    class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm shadow-sm"
                    placeholder="Ism, telefon yoki tavsif...">
            </div>
            @if($search)
                <a href="{{ route('manager.leads', array_filter(['status' => $status?->value])) }}" class="px-3 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold transition-colors" title="Tozalash">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Status filter cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-3">
        <a href="{{ route('manager.leads', array_filter(['search' => $search])) }}"
           class="group bg-white rounded-2xl border p-4 shadow-sm flex items-center gap-3 transition-all hover:-translate-y-0.5 hover:shadow-md {{ !$status ? 'border-[#0084ff] ring-2 ring-[#0084ff]/20' : 'border-gray-100' }}">
            <div class="w-10 h-10 rounded-xl bg-[#061c3f]/5 text-[#061c3f] flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="min-w-0">
                <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider truncate">Barchasi</span>
                <span class="block font-display font-bold text-xl text-[#061c3f]">{{ $totalCount }}</span>
            </div>
        </a>
        @foreach($statuses as $statusOption)
            <a href="{{ route('manager.leads', array_filter(['status' => $statusOption->value, 'search' => $search])) }}"
               class="group bg-white rounded-2xl border p-4 shadow-sm flex items-center gap-3 transition-all hover:-translate-y-0.5 hover:shadow-md {{ $status === $statusOption ? 'border-[#0084ff] ring-2 ring-[#0084ff]/20' : 'border-gray-100' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $statusOption->iconClasses() }}">
                    <i class="fa-solid {{ $statusOption->icon() }}"></i>
                </div>
                <div class="min-w-0">
                    <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider truncate">{{ $statusOption->label() }}</span>
                    <span class="block font-display font-bold text-xl text-[#061c3f]">{{ $statusCounts[$statusOption->value] ?? 0 }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Leads grid -->
    @if($leads->isEmpty())
        <div class="bg-white rounded-2xl border border-dashed border-gray-200 py-16 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-50 text-gray-300 flex items-center justify-center text-3xl mb-4">
                <i class="fa-regular fa-folder-open"></i>
            </div>
            <h3 class="font-display font-bold text-[#061c3f]">Lidlar topilmadi</h3>
            <p class="text-sm text-gray-400 mt-1">
                @if($search || $status)
                    Tanlangan filtr bo'yicha lidlar yo'q.
                @else
                    Sizga hali lidlar biriktirilmagan.
                @endif
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            @foreach($leads as $lead)
                @php($lastHistory = $lead->latestStatusHistory)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col overflow-hidden">
                    <!-- Status stripe -->
                    <div class="h-1 {{ $lead->status->dotClass() }}"></div>

                    <div class="p-5 flex-1 flex flex-col gap-4">
                        <!-- Head -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center font-display font-bold text-lg flex-shrink-0 {{ $lead->status->iconClasses() }}">
                                    {{ mb_strtoupper(mb_substr($lead->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-bold text-[#061c3f] truncate">{{ $lead->name }}</h3>
                                    <span class="text-[11px] text-gray-400">
                                        <i class="fa-regular fa-calendar"></i> {{ $lead->created_at?->format('d.m.Y H:i') }}
                                    </span>
                                </div>
                            </div>
                            @include('partials.lead-status-badge', ['status' => $lead->status])
                        </div>

                        <!-- Phone -->
                        <a href="tel:{{ $lead->phone }}" class="flex items-center justify-between gap-3 px-4 py-3 rounded-xl bg-[#0084ff]/5 hover:bg-[#0084ff]/10 border border-[#0084ff]/10 transition-colors group">
                            <span class="font-mono font-semibold text-[#061c3f]">{{ $lead->phone }}</span>
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0084ff]">
                                <i class="fa-solid fa-phone group-hover:animate-pulse"></i> Qo'ng'iroq
                            </span>
                        </a>

                        <!-- Description -->
                        <div>
                            <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Tavsif</span>
                            <p class="text-sm text-gray-600 line-clamp-3 break-words" title="{{ $lead->description }}">{{ $lead->description ?: 'Tavsif kiritilmagan' }}</p>
                        </div>

                        <!-- Last comment -->
                        @if($lastHistory)
                            <div class="p-3 rounded-xl text-sm {{ $lead->status === $rejectedStatus ? 'bg-red-50/70 border border-red-100' : 'bg-gray-50 border border-gray-100' }}">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="text-[11px] font-bold uppercase tracking-wider {{ $lead->status === $rejectedStatus ? 'text-red-500' : 'text-gray-400' }}">
                                        {{ $lead->status === $rejectedStatus ? 'Rad etilish sababi' : 'Oxirgi izoh' }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">{{ $lastHistory->created_at?->format('d.m.Y H:i') }}</span>
                                </div>
                                <p class="text-gray-700 line-clamp-2 break-words">{{ $lastHistory->comment }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Footer actions -->
                    <div class="px-5 py-4 bg-gray-50/70 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="relative flex-1">
                            <i class="fa-solid fa-arrows-rotate absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                            <select class="lead-status-select block w-full pl-9 pr-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0084ff] cursor-pointer transition-all"
                                    aria-label="Statusni o'zgartirish"
                                    data-lead-id="{{ $lead->id }}"
                                    data-lead-name="{{ $lead->name }}"
                                    data-current="{{ $lead->status->value }}"
                                    data-action="{{ route('manager.leads.status', $lead->id) }}">
                                @foreach($statuses as $statusOption)
                                    <option value="{{ $statusOption->value }}" {{ $lead->status === $statusOption ? 'selected' : '' }}>{{ $statusOption->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" onclick="openLeadHistory({{ $lead->id }}, @js($lead->name))"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-gray-100 border border-gray-200 text-gray-700 text-sm font-semibold transition-colors whitespace-nowrap">
                            <i class="fa-solid fa-clock-rotate-left text-[#0084ff]"></i>
                            Tarix
                            <span class="px-1.5 py-0.5 rounded-md bg-gray-100 text-[11px] text-gray-500">{{ $lead->statusHistories->count() }}</span>
                        </button>
                    </div>
                </div>

                @include('partials.lead-status-history', ['lead' => $lead])
            @endforeach
        </div>

        @if($leads->hasPages())
            <div class="pt-2">
                {{ $leads->links() }}
            </div>
        @endif
    @endif
</div>

<!-- Status change modal -->
<div id="statusChangeModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-[#061c3f]/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform scale-95 transition-transform duration-200 overflow-hidden">
        <div id="statusModalStripe" class="h-1.5 bg-[#0084ff]"></div>
        <div class="p-6">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div class="min-w-0">
                    <h3 class="text-lg font-bold text-[#061c3f]">Statusni o'zgartirish</h3>
                    <p id="statusModalLeadName" class="text-xs text-gray-400 truncate"></p>
                </div>
                <button type="button" onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-700 transition-colors">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="flex items-center gap-2 mb-5 p-3 rounded-xl bg-gray-50 border border-gray-100">
                <span id="statusModalFrom"></span>
                <i class="fa-solid fa-arrow-right-long text-gray-300"></i>
                <span id="statusModalTo"></span>
            </div>

            <form id="statusChangeForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" id="statusModalInput">
                <input type="hidden" name="lead_id" id="statusModalLeadId">

                <div>
                    <label for="statusModalComment" id="statusModalCommentLabel" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Izoh <span class="text-red-500">*</span></label>
                    <textarea name="comment" id="statusModalComment" rows="5" maxlength="2000" required
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm resize-none"></textarea>
                    <div class="mt-2 flex items-start justify-between gap-3">
                        <p id="statusModalHint" class="text-xs text-gray-500 flex items-start gap-1.5">
                            <i class="fa-solid fa-circle-info mt-0.5 text-[#0084ff]"></i>
                            <span></span>
                        </p>
                        <span id="statusModalCounter" class="text-[11px] font-semibold text-gray-400 whitespace-nowrap"></span>
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="closeStatusModal()" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                        Bekor qilish
                    </button>
                    <button type="submit" id="statusModalSubmit" disabled
                        class="flex-1 py-2.5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold shadow-lg hover:shadow-cyan-500/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        Saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.lead-history-modal')

<script>
    const LEAD_STATUSES = @json(\App\Enums\LeadStatus::toFrontend());
    const STRIPE_CLASSES = { new: 'bg-blue-500', in_progress: 'bg-amber-500', rejected: 'bg-red-500', agreed: 'bg-emerald-500' };
    let activeStatusSelect = null;

    function statusBadgeHtml(value) {
        const meta = LEAD_STATUSES[value];
        if (!meta) return '';
        return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border whitespace-nowrap ${meta.badge}"><i class="fa-solid ${meta.icon} text-[10px]"></i>${meta.label}</span>`;
    }

    function refreshStatusCounter() {
        const target = document.getElementById('statusModalInput').value;
        const min = LEAD_STATUSES[target]?.min ?? 5;
        const length = document.getElementById('statusModalComment').value.trim().length;
        const counter = document.getElementById('statusModalCounter');

        counter.textContent = length < min ? `${length} / kamida ${min}` : `${length} belgi`;
        counter.className = `text-[11px] font-semibold whitespace-nowrap ${length < min ? 'text-amber-600' : 'text-emerald-600'}`;
        document.getElementById('statusModalSubmit').disabled = length < min;
    }

    function openStatusModal(select, targetStatus, comment = '') {
        activeStatusSelect = select;
        const meta = LEAD_STATUSES[targetStatus];
        const isRejected = targetStatus === 'rejected';

        document.getElementById('statusChangeForm').action = select.dataset.action;
        document.getElementById('statusModalInput').value = targetStatus;
        document.getElementById('statusModalLeadId').value = select.dataset.leadId;
        document.getElementById('statusModalLeadName').textContent = select.dataset.leadName;
        document.getElementById('statusModalFrom').innerHTML = statusBadgeHtml(select.dataset.current);
        document.getElementById('statusModalTo').innerHTML = statusBadgeHtml(targetStatus);
        document.getElementById('statusModalStripe').className = `h-1.5 ${STRIPE_CLASSES[targetStatus] ?? 'bg-[#0084ff]'}`;
        document.getElementById('statusModalHint').querySelector('span').textContent = meta.hint;
        document.getElementById('statusModalCommentLabel').innerHTML = (isRejected ? 'Rad etilish sababi' : 'Izoh') + ' <span class="text-red-500">*</span>';

        const textarea = document.getElementById('statusModalComment');
        textarea.value = comment;
        textarea.minLength = meta.min;
        textarea.placeholder = isRejected
            ? 'Masalan: Mijoz narxni qimmat deb hisobladi, 50 000$ gacha bo\'lgan variant qidiryapti...'
            : 'Mijoz bilan aloqa natijasini yozing...';
        refreshStatusCounter();

        const modal = document.getElementById('statusChangeModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
            textarea.focus();
        }, 10);
    }

    function closeStatusModal() {
        // Saqlanmagan bo'lsa select eski statusga qaytadi
        if (activeStatusSelect) {
            activeStatusSelect.value = activeStatusSelect.dataset.current;
        }
        const modal = document.getElementById('statusChangeModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.lead-status-select').forEach(select => {
            select.addEventListener('change', function () {
                if (select.value !== select.dataset.current) {
                    openStatusModal(select, select.value);
                }
            });
        });

        document.getElementById('statusModalComment').addEventListener('input', refreshStatusCounter);

        document.getElementById('statusChangeForm').addEventListener('submit', function () {
            document.getElementById('statusModalSubmit').disabled = true;
        });

        // Validatsiya xatosi bo'lsa modalni kiritilgan ma'lumotlar bilan qayta ochamiz
        @if($errors->any() && old('lead_id'))
            const failedSelect = document.querySelector('.lead-status-select[data-lead-id="{{ (int) old('lead_id') }}"]');
            if (failedSelect && LEAD_STATUSES[@js(old('status'))]) {
                failedSelect.value = @js(old('status'));
                openStatusModal(failedSelect, @js(old('status')), @js(old('comment', '')));
            }
        @endif
    });
</script>
@endsection
