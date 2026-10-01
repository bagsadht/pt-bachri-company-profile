<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bachri Company Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- 1. Bagian Header / Hero (Menggunakan bgatasservice.jpeg) -->
    <header class="relative bg-cover bg-center py-32 px-6 text-white" style="background-image: url('{{ asset('images/bgatasservice.jpeg') }}');">
        <div class="absolute inset-0 bg-black/50"></div> <!-- Overlay gelap agar teks terbaca jelas -->
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">PT Bachri Company Profile</h1>
            <p class="text-lg md:text-xl mb-8 text-gray-200">Solusi profesional, inovatif, dan terpercaya untuk kebutuhan bisnis dan layanan Anda.</p>
            <a href="#layanan" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition duration-300">Jelajahi Layanan</a>
        </div>
    </header>

    <!-- 2. Bagian Tengah / Layanan (Menggunakan bgtengahservice.jpeg) -->
    <section id="layanan" class="relative bg-cover bg-center py-24 px-6" style="background-image: url('{{ asset('images/bgtengahservice.jpeg') }}');">
        <div class="absolute inset-0 bg-white/80 backdrop-blur-[2px]"></div> <!-- Overlay putih transparan agar konten mudah dibaca di atas background -->
        <div class="relative z-10 max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Layanan Kami</h2>
                <p class="text-gray-600 max-w-xl mx-auto">Kami menyediakan berbagai layanan unggulan berkualitas tinggi yang dirancang khusus untuk kepuasan klien.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4">1</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Konsultasi Bisnis</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Memberikan strategi dan arahan terbaik untuk perkembangan operasional serta profitabilitas bisnis Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4">2</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Pengembangan Solusi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Implementasi teknologi dan sistem terintegrasi yang efisien untuk mendukung transformasi digital perusahaan.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4">3</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Dukungan Profesional</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Tim ahli yang siap siaga memberikan layanan pemeliharaan dan pendampingan secara berkala.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Bagian Galeri / Foto Bersama Tim (Menggunakan ftbareng.jpeg) -->
    <section class="py-20 bg-gray-900 text-white px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Tim Kami</h2>
            <p class="text-gray-400 mb-10 max-w-lg mx-auto">Dibalik kesuksesan PT Bachri, terdapat tim solid yang berdedikasi tinggi dan berpengalaman.</p>
            <div class="overflow-hidden rounded-3xl shadow-2xl border border-gray-800">
                <img src="{{ asset('images/ftbareng.jpeg') }}" alt="Foto Bersama Tim PT Bachri" class="w-full h-auto object-cover hover:scale-105 transition duration-500">
            </div>
        </div>
    </section>

    <!-- 4. Bagian Footer (Menggunakan bgfooterdantengahservice.jpeg) -->
    <footer class="relative bg-cover bg-center py-16 text-white" style="background-image: url('{{ asset('images/bgfooterdantengahservice.jpeg') }}');">
        <div class="absolute inset-0 bg-black/70"></div> <!-- Overlay gelap agar teks footer kontras -->
        <div class="relative z-10 max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">PT Bachri Company Profile</h3>
                <p class="text-sm text-gray-300 leading-relaxed">Mitra terpercaya yang berkomitmen memberikan standar kualitas pelayanan terbaik demi kemajuan bersama.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#layanan" class="hover:text-white transition">Layanan</a></li>
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">Kontak Kami</h3>
                <p class="text-sm text-gray-300 mb-1">Email: info@ptbachri.com</p>
                <p class="text-sm text-gray-300 mb-1">Telepon: (021) 1234-5678</p>
                <p class="text-sm text-gray-300">Alamat: Indonesia</p>
            </div>
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 mt-12 pt-6 border-t border-gray-700/60 text-center text-xs text-gray-400">
            &copy; 2026 PT Bachri. All rights reserved.
        </div>
    </footer>

</body>
</html>