@extends($layout)

@section('title', 'Lidlar')
@section('header_title', 'Lidlar Boshqaruvi')

@section('content')

@if (session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
        <ul class="list-disc list-inside text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center font-bold text-lg shadow-sm">
                <i class="fa-solid fa-address-book"></i>
            </div>
            <div>
                <h2 class="font-display font-bold text-xl text-[#061c3f]">Lidlar <span class="text-sm font-semibold text-gray-400">({{ $totalCount }} ta)</span></h2>
                <p class="text-xs text-gray-500">Potensial mijozlar ro'yxati va ularni menejerlarga biriktirish</p>
            </div>
        </div>

        <form action="{{ route($routePrefix) }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
            <input type="hidden" name="tab" value="{{ $tab }}">
            @if($status)
                <input type="hidden" name="status" value="{{ $status->value }}">
            @endif
            <div class="relative flex-1 sm:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" value="{{ $search }}"
                    class="block w-full pl-9 pr-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                    placeholder="Ism, telefon yoki tavsif...">
            </div>
            @if($search)
                <a href="{{ route($routePrefix, array_filter(['tab' => $tab, 'status' => $status?->value])) }}" class="px-3 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold transition-colors" title="Tozalash">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Menejerlar ishini nazorat qilish: statuslar bo'yicha -->
    @php
        $agreedRate = $assignedCount > 0 ? round(($statusCounts['agreed'] ?? 0) / $assignedCount * 100) : 0;
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-3 mb-8">
        @foreach($statuses as $statusOption)
            <a href="{{ route($routePrefix, ['tab' => 'assigned', 'status' => $statusOption->value]) }}"
               class="bg-white rounded-2xl border p-4 shadow-sm flex items-center gap-3 transition-all hover:-translate-y-0.5 hover:shadow-md {{ $status === $statusOption ? 'border-[#0084ff] ring-2 ring-[#0084ff]/20' : 'border-gray-100' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $statusOption->iconClasses() }}">
                    <i class="fa-solid {{ $statusOption->icon() }}"></i>
                </div>
                <div class="min-w-0">
                    <span class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider truncate">{{ $statusOption->label() }}</span>
                    <span class="block font-display font-bold text-xl text-[#061c3f]">{{ $statusCounts[$statusOption->value] ?? 0 }}</span>
                </div>
            </a>
        @endforeach
        <div class="col-span-2 md:col-span-1 bg-gradient-to-br from-[#061c3f] to-[#0B2240] rounded-2xl p-4 shadow-sm text-white flex flex-col justify-between">
            <span class="text-[11px] font-semibold text-blue-200 uppercase tracking-wider">Kelishuv darajasi</span>
            <div class="flex items-end justify-between gap-2 mt-1">
                <span class="font-display font-extrabold text-2xl">{{ $agreedRate }}%</span>
                <i class="fa-solid fa-chart-line text-[#ff9e0d] text-lg mb-1"></i>
            </div>
            <div class="mt-2 h-1.5 rounded-full bg-white/10 overflow-hidden">
                <div class="h-full rounded-full bg-emerald-400" style="width: {{ $agreedRate }}%"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Leads List -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Tabs -->
            <div class="flex flex-wrap items-center gap-2">
                @php
                    $tabs = [
                        'new' => ['label' => 'Yangi lidlar', 'icon' => 'fa-inbox', 'count' => $newCount],
                        'assigned' => ['label' => 'Biriktirilgan lidlar', 'icon' => 'fa-user-check', 'count' => $assignedCount],
                    ];
                @endphp
                @foreach($tabs as $key => $tabItem)
                    <a href="{{ route($routePrefix, ['tab' => $key]) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border transition-all {{ $tab === $key ? 'bg-[#0084ff] text-white border-[#0084ff] shadow-md shadow-blue-500/20' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        <i class="fa-solid {{ $tabItem['icon'] }}"></i>
                        <span>{{ $tabItem['label'] }}</span>
                        <span class="px-1.5 py-0.5 rounded-md text-[11px] {{ $tab === $key ? 'bg-white/20' : 'bg-gray-100 text-gray-500' }}">{{ $tabItem['count'] }}</span>
                    </a>
                @endforeach
            </div>

            @if($tab === 'assigned')
                <!-- Status filter -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider mr-1">Status:</span>
                    <a href="{{ route($routePrefix, array_filter(['tab' => 'assigned', 'search' => $search])) }}"
                       class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all {{ !$status ? 'bg-[#061c3f] text-white border-[#061c3f]' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        Barchasi
                    </a>
                    @foreach($statuses as $statusOption)
                        <a href="{{ route($routePrefix, array_filter(['tab' => 'assigned', 'status' => $statusOption->value, 'search' => $search])) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border transition-all {{ $status === $statusOption ? $statusOption->badgeClasses() . ' shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusOption->dotClass() }}"></span>
                            {{ $statusOption->label() }}
                            <span class="text-[10px] opacity-70">{{ $statusCounts[$statusOption->value] ?? 0 }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Bulk Assign Bar -->
            <form id="bulkAssignForm" action="{{ route($routePrefix . '.bulk-assign') }}" method="POST"
                  class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row sm:items-center gap-3">
                @csrf
                <div class="flex items-center gap-2 text-sm text-gray-600 flex-1">
                    <i class="fa-solid fa-list-check text-[#0084ff]"></i>
                    <span>Tanlangan: <strong id="bulkSelectedCount" class="text-[#061c3f]">0</strong> / {{ $bulkLimit }}</span>
                    <span id="bulkLimitHint" class="hidden text-[11px] text-amber-600 font-semibold">Ko'pi bilan {{ $bulkLimit }} ta lid tanlash mumkin</span>
                </div>
                <select name="manager_id" required
                    class="block w-full sm:w-56 px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                    <option value="">— Menejerni tanlang —</option>
                    @foreach($managers as $managerOption)
                        <option value="{{ $managerOption->id }}">{{ $managerOption->name }}</option>
                    @endforeach
                </select>
                <button type="submit" id="bulkAssignBtn" disabled
                    class="inline-flex items-center justify-center gap-2 py-2.5 px-5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20 disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>{{ $tab === 'assigned' ? 'Qayta biriktirish' : 'Menejerga berish' }}</span>
                </button>
            </form>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <th class="pl-6 pr-2 py-4 w-10">
                                    <input type="checkbox" id="bulkSelectAll" class="w-4 h-4 rounded text-[#0084ff] focus:ring-[#0084ff] cursor-pointer" title="Sahifadagi birinchi {{ $bulkLimit }} tasini tanlash">
                                </th>
                                <th class="px-6 py-4">Ism</th>
                                <th class="px-6 py-4">Telefon raqam</th>
                                <th class="px-6 py-4">Tavsif</th>
                                <th class="px-6 py-4">Menejer</th>
                                <th class="px-6 py-4">Status / Oxirgi izoh</th>
                                <th class="px-6 py-4 text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                            @forelse($leads as $lead)
                                @php
                                    $manager = $lead->managers->first();
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="pl-6 pr-2 py-4">
                                        <input type="checkbox" name="lead_ids[]" value="{{ $lead->id }}" form="bulkAssignForm"
                                            class="bulk-lead-checkbox w-4 h-4 rounded text-[#0084ff] focus:ring-[#0084ff] cursor-pointer disabled:cursor-not-allowed disabled:opacity-40">
                                    </td>
                                    <td class="px-6 py-4 font-bold text-[#061c3f]">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-blue-50 text-[#0084ff] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                {{ mb_strtoupper(mb_substr($lead->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="block">{{ $lead->name }}</span>
                                                <span class="block text-[11px] font-normal text-gray-400">{{ $lead->created_at?->format('d.m.Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold whitespace-nowrap">
                                        <a href="tel:{{ $lead->phone }}" class="text-[#0084ff] hover:underline flex items-center gap-2 font-mono">
                                            <i class="fa-solid fa-phone text-xs"></i>
                                            {{ $lead->phone }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 max-w-xs truncate" title="{{ $lead->description }}">
                                        {{ $lead->description ?: '—' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($manager)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100 whitespace-nowrap">
                                                <i class="fa-solid fa-user-tie text-[10px]"></i>
                                                {{ $manager->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-500 border border-gray-200 whitespace-nowrap">
                                                <i class="fa-regular fa-clock text-[10px]"></i>
                                                Berilmagan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 min-w-[220px] max-w-xs">
                                        @include('partials.lead-status-badge', ['status' => $lead->status])
                                        @if($lead->latestStatusHistory)
                                            <p class="mt-1.5 text-xs line-clamp-2 break-words {{ $lead->status === \App\Enums\LeadStatus::Rejected ? 'text-red-700' : 'text-gray-500' }}" title="{{ $lead->latestStatusHistory->comment }}">
                                                {{ $lead->latestStatusHistory->comment }}
                                            </p>
                                            <span class="block mt-0.5 text-[10px] text-gray-400">
                                                {{ $lead->latestStatusHistory->user?->name }} &middot; {{ $lead->latestStatusHistory->created_at?->format('d.m.Y H:i') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button type="button"
                                                onclick="openLeadHistory({{ $lead->id }}, @js($lead->name))"
                                                class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors"
                                                title="Aloqa tarixi">
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                @if($lead->statusHistories->isNotEmpty())
                                                    <span class="absolute -top-1 -right-1 min-w-[16px] h-4 px-1 rounded-full bg-[#0084ff] text-white text-[10px] font-bold flex items-center justify-center">{{ $lead->statusHistories->count() }}</span>
                                                @endif
                                            </button>
                                            <button type="button"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors btn-edit-lead"
                                                data-action="{{ route($routePrefix . '.update', $lead->id) }}"
                                                data-lead="{{ json_encode(['name' => $lead->name, 'phone' => $lead->phone, 'description' => $lead->description, 'manager_id' => $manager?->id]) }}"
                                                title="Tahrirlash">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors btn-delete-lead"
                                                data-action="{{ route($routePrefix . '.delete', $lead->id) }}"
                                                data-name="{{ $lead->name }}"
                                                title="O'chirish">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                        @include('partials.lead-status-history', ['lead' => $lead])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                                        <i class="fa-regular fa-folder-open text-3xl mb-3 block"></i>
                                        @if($search || $status)
                                            Tanlangan filtr bo'yicha lidlar topilmadi.
                                        @elseif($tab === 'assigned')
                                            Hozircha menejerga berilgan lidlar yo'q.
                                        @else
                                            Yangi (menejerga berilmagan) lidlar yo'q.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($leads->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $leads->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Create Lead Form -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:sticky lg:top-0">
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-plus text-[#ff9e0d]"></i> Yangi Lid
                </h3>
                <form action="{{ route($routePrefix . '.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ism</label>
                        <input type="text" name="name" required maxlength="255" value="{{ old('name') }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: Aziz Karimov">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon raqam</label>
                        <input type="text" name="phone" required maxlength="30" value="{{ old('phone') }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm font-mono"
                            placeholder="+998 90 123 45 67">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tavsif</label>
                        <textarea name="description" rows="4" maxlength="5000"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm resize-none"
                            placeholder="Mijoz nima qidirmoqda, byudjeti va h.k.">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menejerga biriktirish</label>
                        <select name="manager_id"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                            <option value="">— Biriktirilmagan —</option>
                            @foreach($managers as $managerOption)
                                <option value="{{ $managerOption->id }}" {{ old('manager_id') == $managerOption->id ? 'selected' : '' }}>{{ $managerOption->name }}</option>
                            @endforeach
                        </select>
                        @if($managers->isEmpty())
                            <p class="text-[11px] text-amber-600 mt-1.5">Tizimda menejer roli bilan foydalanuvchi yo'q.</p>
                        @endif
                    </div>
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                        Saqlash
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- O'chirish (Delete) Modali -->
<div id="deleteLeadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-[#061c3f]">O'chirishni tasdiqlang</h3>
                <p id="deleteLeadMessage" class="text-sm text-gray-500 mt-1">Ushbu lidni rostdan ham o'chirmoqchimisiz?</p>
            </div>
        </div>
        <form id="deleteLeadForm" method="POST" class="flex gap-3 pt-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeLeadModal('deleteLeadModal')" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                Bekor qilish
            </button>
            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-lg hover:shadow-red-500/30 transition-all">
                Ha, o'chirish
            </button>
        </form>
    </div>
</div>

<!-- Tahrirlash (Edit) Modali -->
<div id="editLeadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-[#061c3f] flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-[#0084ff]"></i> Lidni tahrirlash
            </h3>
            <button type="button" onclick="closeLeadModal('editLeadModal')" class="text-gray-400 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <form id="editLeadForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ism</label>
                <input type="text" name="name" id="editLeadName" required maxlength="255"
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon raqam</label>
                <input type="text" name="phone" id="editLeadPhone" required maxlength="30"
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm font-mono">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tavsif</label>
                <textarea name="description" id="editLeadDescription" rows="4" maxlength="5000"
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm resize-none"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menejer</label>
                <select name="manager_id" id="editLeadManager"
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                    <option value="">— Biriktirilmagan —</option>
                    @foreach($managers as $managerOption)
                        <option value="{{ $managerOption->id }}">{{ $managerOption->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pt-2 flex gap-3">
                <button type="button" onclick="closeLeadModal('editLeadModal')" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                    Bekor qilish
                </button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold shadow-lg hover:shadow-cyan-500/30 transition-all">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>

@include('partials.lead-history-modal')

<script>
    function openLeadModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }, 10);
    }

    function closeLeadModal(id) {
        const modal = document.getElementById(id);
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Bulk assign: bir vaqtda ko'pi bilan BULK_LIMIT ta lid tanlanadi
        const BULK_LIMIT = {{ $bulkLimit }};
        const checkboxes = Array.from(document.querySelectorAll('.bulk-lead-checkbox'));
        const selectAll = document.getElementById('bulkSelectAll');
        const countEl = document.getElementById('bulkSelectedCount');
        const limitHint = document.getElementById('bulkLimitHint');
        const assignBtn = document.getElementById('bulkAssignBtn');

        function refreshBulkState() {
            const checked = checkboxes.filter(cb => cb.checked).length;
            const limitReached = checked >= BULK_LIMIT;

            checkboxes.forEach(cb => { cb.disabled = !cb.checked && limitReached; });
            countEl.textContent = checked;
            limitHint.classList.toggle('hidden', !limitReached);
            assignBtn.disabled = checked === 0;
            selectAll.checked = checked > 0 && (checked === checkboxes.length || limitReached);
            selectAll.indeterminate = checked > 0 && !selectAll.checked;
        }

        checkboxes.forEach(cb => cb.addEventListener('change', refreshBulkState));

        if (selectAll) {
            selectAll.disabled = checkboxes.length === 0;
            selectAll.addEventListener('change', function () {
                const shouldCheck = selectAll.checked;
                checkboxes.forEach(cb => { cb.checked = false; });
                if (shouldCheck) {
                    checkboxes.slice(0, BULK_LIMIT).forEach(cb => { cb.checked = true; });
                }
                refreshBulkState();
            });
        }

        refreshBulkState();

        document.querySelectorAll('.btn-edit-lead').forEach(btn => {
            btn.addEventListener('click', function () {
                const lead = JSON.parse(btn.dataset.lead);
                document.getElementById('editLeadForm').action = btn.dataset.action;
                document.getElementById('editLeadName').value = lead.name ?? '';
                document.getElementById('editLeadPhone').value = lead.phone ?? '';
                document.getElementById('editLeadDescription').value = lead.description ?? '';
                document.getElementById('editLeadManager').value = lead.manager_id ?? '';
                openLeadModal('editLeadModal');
            });
        });

        document.querySelectorAll('.btn-delete-lead').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('deleteLeadForm').action = btn.dataset.action;
                document.getElementById('deleteLeadMessage').textContent = `"${btn.dataset.name}" lidini rostdan ham o'chirmoqchimisiz?`;
                openLeadModal('deleteLeadModal');
            });
        });
    });
</script>

@endsection
