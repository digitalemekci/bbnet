<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Yönetim Sistemi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto">
            <a href="{{ route('tasks.index') }}" class="font-bold">Görevler</a>
            <span class="float-right">
                @auth
                    {{ auth()->user()->name }} |
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="underline">Çıkış Yap</button>
                    </form>
                @endauth
            </span>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

</body>
</html>
