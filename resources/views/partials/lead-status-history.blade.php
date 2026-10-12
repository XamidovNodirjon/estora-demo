{{-- Lid status o'zgarishlari tarixi (modal ichida ko'rsatiladi). Kerakli o'zgaruvchi: $lead --}}
<template id="lead-history-{{ $lead->id }}">
    @forelse($lead->statusHistories as $history)
        @php
            $to = \App\Enums\LeadStatus::tryFrom($history->to_status);
            $from = \App\Enums\LeadStatus::tryFrom((string) $history->from_status);
        @endphp
        <div class="relative pl-10 pb-6 last:pb-0">
            @unless($loop->last)
                <span class="absolute left-[15px] top-8 bottom-0 w-px bg-gray-200"></span>
            @endunless
            <span class="absolute left-0 top-0 w-8 h-8 rounded-full flex items-center justify-center text-xs {{ $to?->iconClasses() ?? 'bg-gray-100 text-gray-500' }}">
                <i class="fa-solid {{ $to?->icon() ?? 'fa-circle' }}"></i>
            </span>

            <div class="flex flex-wrap items-center gap-1.5 text-xs">
                @if($from)
                    @include('partials.lead-status-badge', ['status' => $from])
                    <i class="fa-solid fa-arrow-right-long text-gray-300"></i>
                @endif
                @if($to)
                    @include('partials.lead-status-badge', ['status' => $to])
                @endif
            </div>

            <div class="mt-2 p-3 rounded-xl text-sm leading-relaxed whitespace-pre-line break-words {{ $to === \App\Enums\LeadStatus::Rejected ? 'bg-red-50/70 border border-red-100 text-red-900' : 'bg-gray-50 border border-gray-100 text-gray-700' }}">
                @if($to === \App\Enums\LeadStatus::Rejected)
                    <span class="block text-[11px] font-bold uppercase tracking-wider text-red-500 mb-1">Rad etilish sababi</span>
                @endif{{ $history->comment }}</div>

            <div class="mt-1.5 flex items-center gap-2 text-[11px] text-gray-400">
                <i class="fa-solid fa-user-tie"></i>
                <span class="font-semibold text-gray-500">{{ $history->user?->name ?? 'O\'chirilgan foydalanuvchi' }}</span>
                <span>&middot;</span>
                <span>{{ $history->created_at?->format('d.m.Y H:i') }}</span>
            </div>
        </div>
    @empty
        <div class="py-10 text-center text-gray-400 text-sm">
            <i class="fa-regular fa-clock text-3xl mb-2 block"></i>
            Status hali o'zgartirilmagan.
        </div>
    @endforelse
</template>
