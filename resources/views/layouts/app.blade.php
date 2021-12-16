<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Social Media App' }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </h2>
            </div>
        </header>
        
        @if ($errors->any())
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-red-500 shadow">
            <h2 class="font-semibold text-xl text-white leading-tight mb-4">
                Errors:
            </h2>
            <span class="text-white italic">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </span>
        </div>
        @endif

        @if (session()->has('message'))
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-green-500 shadow">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ session()->get('message') }}
            </h2>
        </div>
        @endif

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
