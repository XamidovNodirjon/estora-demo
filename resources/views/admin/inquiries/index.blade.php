@extends('layouts.admin')

@section('title', 'Murojaatlar Boshqaruvi')
@section('header_title', 'Murojaatlar Boshqaruvi')

@section('content')

@if (session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-semibold">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center font-bold text-lg shadow-sm">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Murojaatlar (Inquiries)</h2>
            <p class="text-xs text-gray-500">Mijozlar tomonidan qoldirilgan barcha savollar va arizalar ro'yxati</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Telefon raqam</th>
                        <th class="px-6 py-4">Qisqacha tavsif (savol)</th>
                        <th class="px-6 py-4">Holat</th>
                        <th class="px-6 py-4">Kelgan sana</th>
                        <th class="px-6 py-4 text-center">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <!-- 1st Column: Phone number -->
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <a href="tel:{{ $inquiry->phone }}" class="text-[#0084ff] hover:underline flex items-center gap-2">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                    {{ $inquiry->phone }}
                                </a>
                            </td>
                            
                            <!-- 2nd Column: Description snippet -->
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                {{ $inquiry->description ?? 'Savol matni kiritilmagan' }}
                            </td>
                            
                            <!-- 3rd Column: Status badge -->
                            <td class="px-6 py-4">
                                @if($inquiry->status === 'new')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Yangi
                                    </span>
                                @elseif($inquiry->status === 'in_progress')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Ko'rib chiqilmoqda
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Bajarildi (Bog'lanildi)
                                    </span>
                                @endif
                            </td>
                            
                            <!-- 4th Column: Submission Date -->
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $inquiry->created_at ? $inquiry->created_at->format('d.m.Y H:i') : 'No date' }}
                            </td>
                            
                            <!-- 5th Column: Actions -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-700 text-xs font-semibold transition-colors border border-gray-200">
                                        <i class="fa-regular fa-eye"></i>
                                        Batafsil
                                    </a>
                                    
                                    <!-- Quick status change form -->
                                    <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-200 rounded-lg py-1 px-2 bg-gray-50 focus:outline-none focus:border-[#0084ff] cursor-pointer">
                                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>Yangi</option>
                                            <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>O'rganilmoqda</option>
                                            <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Bog'lanildi</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                Hozircha murojaatlar kelib tushmagan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
