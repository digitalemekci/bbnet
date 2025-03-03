@extends('layout')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Yeni Görev Ekle</h2>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <label class="block mb-2">Başlık:</label>
            <input type="text" name="title" class="border p-2 w-full" required>

            <label class="block mt-4 mb-2">Açıklama:</label>
            <textarea name="description" class="border p-2 w-full"></textarea>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Kaydet</button>
        </form>
    </div>
@endsection
