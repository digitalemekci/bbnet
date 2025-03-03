@extends('layout')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Görevlerim</h2>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white p-2 rounded">+ Yeni Görev</a>

        <ul class="mt-4">
            @foreach ($tasks as $task)
                <li class="border-b p-2 flex justify-between items-center">
                    <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                        {{ $task->title }}
                    </span>
                    <div>
                        @if (!$task->is_completed)
                            <form action="{{ route('tasks.complete', $task) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-green-500 text-white p-1 rounded">Tamamla</button>
                            </form>
                        @endif
                        <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white p-1 rounded">Düzenle</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white p-1 rounded">Sil</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
