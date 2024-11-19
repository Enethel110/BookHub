<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags para la codificación y la vista en dispositivos móviles -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Token CSRF para proteger las solicitudes -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('tittle', 'BookHub') }}</title> <!-- Título de la página -->

    <!-- Fuentes de Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Inclusión de archivos CSS y JS con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inclusión de jQuery y Bootstrap JavaScript -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Archivos CSS personalizados -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Inclusión de librería SweetAlert para alertas -->
    <script src="{{ asset('js/sweetalert2011.js') }}"></script>

    <!-- Estilos y scripts para DataTables y gráficos -->
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <!-- Estilos de Livewire -->
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <!-- Banner de la página -->
    <x-banner />

    <!-- Contenedor principal de la página -->
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Menú de navegación de Livewire -->
        @livewire('navigation-menu')

        <!-- Encabezado de la página (si existe) -->
        @if (isset($header))
            <header class="dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Contenido principal de la página -->
        <main>
            {{ $slot }} <!-- Este es el contenido dinámico de la página -->
        </main>
    </div>

    <!-- Pila de modales (si los hay) -->
    @stack('modals')

    <!-- Scripts de Livewire -->
    @livewireScripts

    <!-- Script para funcionalidades relacionadas con los libros -->
    <script src="{{ asset('js/libros.js') }}"></script>
</body>

<!-- Pie de página -->
<x-footer />
</html>
