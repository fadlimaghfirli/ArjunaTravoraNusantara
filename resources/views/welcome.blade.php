<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arjuna Travora Nusantara</title>
    
    <!-- Memanggil Tailwind CSS melalui Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">

    <!-- Memanggil komponen Navbar di sini -->
    <x-navbar />

    <!-- Bagian Hero / Konten Utama Halaman Welcome -->
    <main>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl font-bold text-gray-900">Selamat Datang di PT Arjuna Travora Nusantara</h1>
            <p class="mt-4 text-lg text-gray-600">Solusi Software & Hardware Anda.</p>
        </section>
        
        <!-- Section lainnya (Layanan, Portofolio, dll) -->
    </main>

</body>
</html>