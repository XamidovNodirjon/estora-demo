@extends('layouts.admin')
@section('title', 'Metrolar Boshqaruvi')
@section('header_title', 'Metrolar Boshqaruvi')
@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6 flex justify-between items-center">
    <h2 class="font-display font-bold text-lg text-[#061c3f]">Mavjud Metrolar</h2>
    <a href="{{ route('admin.metros.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Yangi qo'shish</a>
</div>
<div class="space-y-4">
    @forelse($metros as $item)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex justify-between items-center">
            <h3 class="font-semibold text-[#061c3f]">{{ $item->name }}</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.metros.edit', $item->id) }}" class="text-blue-600 hover:bg-blue-50 p-2 rounded">Tahrirlash</a>
                <form action="{{ route('admin.metros.delete', $item->id) }}" method="POST" onsubmit="return confirm('O\'chirishni xohlaysizmi?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded">O'chirish</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Hozircha bo'sh.</p>
    @endforelse
</div>
@endsection