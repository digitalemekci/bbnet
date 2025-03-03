@extends('layout')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Görevi Düzenle</h2>
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Başlık:</label>
            <input type="text" name="title" class="border p-2 w-full" value="{{ $task->title }}" required>

            <label class="block mt-4 mb-2">Açıklama:</label>
            <textarea name="description" class="border p-2 w-full">{{ $task->description }}</textarea>

            <button type="submit" class="bg-yellow-500 text-white p-2 rounded mt-4">Güncelle</button>
        </form>
    </div>
@endsection
