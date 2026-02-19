<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Laravel Task List App</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @yield('styles')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="mb-4 text-2xl">@yield('title')</h1>
    <div x-data="{ flash: true }">
        @if (session()->has('success'))
            <div x-show="flash"
                class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <div>{{ session('success') }}</div>
                <span class="absolute top-0 bottom-0 px-4 py-3 right-0">
                    <img src="{{ asset('icons/close.svg') }}" alt="Close" class="h-6 w-6 cursor-pointer"
                        @click="flash = false">
                </span>
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
