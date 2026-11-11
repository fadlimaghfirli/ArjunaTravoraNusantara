<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lato:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-[#667085] bg-[#F4F7F9]" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#F4F7F9] overflow-hidden">
            <!-- Topbar -->
            @include('layouts.topbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>

</html>