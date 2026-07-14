@extends('layouts.developer')

@section('title', 'Kategoriyalar Boshqaruvi')
@section('header_title', 'Kategoriyalar Boshqaruvi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Categories & Subcategories List Card -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h2 class="font-display font-bold text-lg text-[#061c3f]">Mavjud Kategoriyalar</h2>
            <p class="text-xs text-gray-400 mt-1">Tizimda yaratilgan kategoriyalar va ularning quyi (sub) kategoriyalari</p>
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

        <div class="space-y-4">
            @forelse($categories as $category)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6 space-y-4">
                    <!-- Category Header -->
                    <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg font-display">
                                <i class="fa-solid fa-folder text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#061c3f] text-base">{{ $category->name }}</h3>
                                <p class="text-xs text-gray-400">{{ $category->sub_categories_count }} ta sub-kategoriya</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('developer.categories.edit', $category->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Tahrirlash">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('developer.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Haqiqatdan ham ushbu kategoriyani va uning barcha sub-kategoriyalarini o\'chirmoqchimisiz?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="O'chirish">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Subcategories List -->
                    <div class="pl-12">
                        @if($category->subCategories->isNotEmpty())
                            <div class="flex flex-wrap gap-2">
                                @foreach($category->subCategories as $sub)
                                    <div class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 hover:bg-gray-100 rounded-xl border border-gray-100 text-xs font-semibold text-gray-600 transition-all">
                                        <i class="fa-solid fa-hashtag text-gray-400"></i>
                                        <span>{{ $sub->name }}</span>
                                        <div class="flex items-center gap-1 ml-2 border-l border-gray-200 pl-2">
                                            <a href="{{ route('developer.subcategories.edit', $sub->id) }}" class="text-blue-500 hover:text-blue-700" title="Tahrirlash">
                                                <i class="fa-solid fa-pen text-[10px]"></i>
                                            </a>
                                            <form action="{{ route('developer.subcategories.delete', $sub->id) }}" method="POST" onsubmit="return confirm('Haqiqatdan ham ushbu sub-kategoriyani o\'chirmoqchimisiz?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="O'chirish">
                                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-400 italic">Sub-kategoriyalar mavjud emas</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400 font-medium">
                    <i class="fa-regular fa-folder-open text-4xl mb-3 block"></i>
                    Kategoriyalar topilmadi.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Forms Column -->
    <div class="space-y-6">
        <!-- Create Category Card -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                    <i class="fa-solid fa-folder-plus text-[#ff9e0d]"></i> Yangi Kategoriya
                </h3>
                <p class="text-xs text-gray-400 mt-1">Tizimga yangi kategoriya qo'shish</p>
            </div>

            <form action="{{ route('developer.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="cat_name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kategoriya nomi</label>
                    <input type="text" name="name" id="cat_name" required value="{{ old('name') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="Masalan: Uy-joy, Avtomobillar">
                </div>

                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                    Kategoriyani saqlash
                </button>
            </form>
        </div>

        <!-- Create Subcategory Card -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-4">
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                    <i class="fa-solid fa-tags text-[#ff9e0d]"></i> Yangi Sub-kategoriya
                </h3>
                <p class="text-xs text-gray-400 mt-1">Kategoriyaga tegishli bo'lgan quyi kategoriya qo'shish</p>
            </div>

            <form action="{{ route('developer.subcategories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="category_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Asosiy Kategoriya</label>
                    <select name="category_id" id="category_id" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                        <option value="">Kategoriyani tanlang</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sub_name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sub-kategoriya nomi</label>
                    <input type="text" name="name" id="sub_name" required value="{{ old('name') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="Masalan: Kvartira, Hovli">
                </div>

                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                    Sub-kategoriyani saqlash
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
