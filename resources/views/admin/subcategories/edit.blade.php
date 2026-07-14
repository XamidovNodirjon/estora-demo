@extends('layouts.admin')

@section('title', 'Sub-kategoriyani Tahrirlash')
@section('header_title', 'Sub-kategoriyani Tahrirlash')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm space-y-6">
        <div class="flex items-center gap-4 border-b border-gray-100 pb-5">
            <a href="{{ route('admin.categories') }}" class="w-10 h-10 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-500 flex items-center justify-center transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-[#ff9e0d]"></i> Sub-kategoriya ma'lumotlarini yangilash
                </h3>
                <p class="text-xs text-gray-400 mt-1">Sub-kategoriya nomi va uning asosiy kategoriyasini o'zgartirish formasi</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.subcategories.update', $subCategory->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="category_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Asosiy Kategoriya</label>
                <select name="category_id" id="category_id" required
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $subCategory->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sub-kategoriya nomi</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $subCategory->name) }}"
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                    placeholder="Masalan: Kvartira">
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.categories') }}" class="flex-1 py-3 text-center rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm transition-all border border-gray-200">
                    Bekor qilish
                </a>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                    O'zgarishlarni saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
