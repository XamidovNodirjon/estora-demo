@extends('layouts.developer')
@section('title', 'Tahrirlash: Universitet')
@section('header_title', 'Tahrirlash: Universitet')
@section('content')
<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
    <form action="{{ route('developer.universities.update', $university->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nomi</label>
            <input type="text" name="name" value="{{ $university->name }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Saqlash</button>
    </form>
</div>
@endsection