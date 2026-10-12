{{-- Lid status belgisi. Kerakli o'zgaruvchi: $status (App\Enums\LeadStatus) --}}
@php($status = $status ?? \App\Enums\LeadStatus::New)
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border whitespace-nowrap {{ $status->badgeClasses() }}">
    <i class="fa-solid {{ $status->icon() }} text-[10px]"></i>
    {{ $status->label() }}
</span>
