@extends('layouts.admin')

@section('title', 'Murojaat Tafsilotlari')
@section('header_title', 'Murojaat Tafsilotlari')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-950 font-semibold text-sm transition-colors">
        <i class="fa-solid fa-arrow-left-long"></i>
        Ortga, ro'yxatga qaytish
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6 md:p-8">
        <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl shadow-sm">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <h2 class="font-display font-bold text-lg text-[#061c3f]">Murojaat tafsilotlari</h2>
                    <span class="text-xs text-gray-400">ID: {{ $inquiry->id }}</span>
                </div>
            </div>
            
            <div>
                @if($inquiry->status === 'new')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                        Yangi
                    </span>
                @elseif($inquiry->status === 'in_progress')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                        O'rganilmoqda
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                        Bog'lanildi
                    </span>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <!-- 1. Customer Name -->
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Mijoz (Ismi)</span>
                <div class="flex items-center gap-3 text-lg font-bold text-[#061c3f] bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-200/80">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-[#0084ff] flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span>{{ $inquiry->name ?: 'Mijoz ismi kiritilmagan' }}</span>
                </div>
            </div>

            <!-- 2. Phone number -->
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Telefon raqam</span>
                <a href="tel:{{ $inquiry->phone }}" class="inline-flex items-center gap-3 text-xl font-bold text-[#0084ff] hover:underline bg-blue-50/30 px-4 py-2.5 rounded-xl border border-blue-100/50 w-full sm:w-auto font-mono">
                    <i class="fa-solid fa-phone"></i>
                    {{ $inquiry->phone }}
                </a>
            </div>

            <!-- 2. Submission Date -->
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Murojaat kelgan vaqt</span>
                <p class="text-sm font-semibold text-gray-800">
                    <i class="fa-regular fa-clock text-gray-400 mr-1.5"></i>
                    {{ $inquiry->created_at ? $inquiry->created_at->format('d.m.Y H:i:s') : 'Noma\'lum' }}
                </p>
            </div>

            <!-- 3. Question/Description Content -->
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Murojaat matni (savol yoki ariza)</span>
                <div class="bg-gray-50 border border-gray-200/80 rounded-xl p-4 md:p-5 text-gray-700 leading-relaxed text-sm min-h-[120px] whitespace-pre-line">
                    {{ $inquiry->description ?? 'Ushbu murojaatda hech qanday matn yozilmagan. Faqatgina aloqaga chiqish so\'ralgan.' }}
                </div>
            </div>

            <!-- 4. Update Status form -->
            <div class="border-t border-gray-100 pt-6 mt-8">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-3">Holatni o'zgartirish</span>
                <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex-1 max-w-xs">
                        <select name="status" class="w-full text-sm border border-gray-200 rounded-xl py-3 px-4 bg-gray-50 focus:outline-none focus:border-[#0084ff] cursor-pointer font-semibold text-gray-800">
                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>Yangi murojaat</option>
                            <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>Ko'rib chiqilmoqda (O'rganilmoqda)</option>
                            <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Bajarildi (Bog'lanildi)</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-[#0084ff] hover:bg-[#0084ff]/90 active:scale-95 text-white font-bold text-sm rounded-xl transition-all shadow-md">
                        Saqlash
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
