<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bachri Samudera Indonesia - Company Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styling untuk Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: #20ba5a;
        }
        .whatsapp-float::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background-color: #25d366;
            animation: wa-pulse 2.4s ease-out infinite;
            z-index: -1;
        }
        @keyframes wa-pulse {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.8); opacity: 0; }
        }
 
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #93c5fd;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
        }
        .back-to-top.visible {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
        .back-to-top:hover {
            background-color: #2563eb;
            color: #fff;
        }
 
        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
 
        /* Nav active link underline */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0;
            height: 2px;
            background-color: #60a5fa;
            transition: width 0.25s ease;
        }
        .nav-link.active::after,
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active {
            color: #60a5fa;
        }
 
        /* Mobile menu */
        #mobileMenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }
        #mobileMenu.open {
            max-height: 320px;
        }
 
        /* Service card interactivity */
        .service-card {
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-6px);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 12px 30px -10px rgba(37, 99, 235, 0.35);
        }
        .service-card .fa-arrow-right {
            transition: transform 0.25s ease;
        }
        .service-card:hover .fa-arrow-right {
            transform: translateX(4px);
        }
 
        /* Counter */
        .counter-value {
            font-variant-numeric: tabular-nums;
        }
 
        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .reveal, .whatsapp-float::before, .back-to-top, .nav-link::after, .service-card {
                transition: none !important;
                animation: none !important;
            }
            .reveal { opacity: 1; transform: none; }
        }
 
        /* Focus visibility */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible {
            outline: 2px solid #60a5fa;
            outline-offset: 2px;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased">
 
    <!-- Header / Navbar -->
    <header id="siteHeader" class="fixed top-0 left-0 w-full z-50 bg-slate-950/80 backdrop-blur-md border-b border-slate-800 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-xl font-black tracking-wider text-white">PT BACHRI SAMUDERA INDONESIA</span>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="#" data-nav class="nav-link active hover:text-blue-400 transition">Beranda</a>
                <a href="#about" data-nav class="nav-link hover:text-blue-400 transition">Tentang Kami</a>
                <a href="#services" data-nav class="nav-link hover:text-blue-400 transition">Layanan</a>
                <a href="#contact" data-nav class="nav-link hover:text-blue-400 transition">Kontak</a>
            </nav>
            <button id="menuToggle" class="md:hidden text-slate-200 w-10 h-10 flex items-center justify-center" aria-label="Buka menu navigasi" aria-expanded="false">
                <i class="fa-solid fa-bars text-xl" id="menuIcon"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden px-6 border-t border-slate-800 bg-slate-950/95">
            <nav class="flex flex-col py-4 gap-4 text-sm font-medium text-slate-300">
                <a href="#" class="hover:text-blue-400 transition">Beranda</a>
                <a href="#about" class="hover:text-blue-400 transition">Tentang Kami</a>
                <a href="#services" class="hover:text-blue-400 transition">Layanan</a>
                <a href="#contact" class="hover:text-blue-400 transition">Kontak</a>
            </nav>
        </div>
    </header>
 
    <!-- Hero Section -->
    <section class="pt-32 pb-20 md:pt-44 md:pb-32 px-6 bg-gradient-to-b from-slate-900 to-slate-950 border-b border-slate-800">
        <div class="max-w-4xl mx-auto text-center">
            <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs px-3 py-1 rounded-full uppercase font-semibold tracking-wider">Solusi Maritim & Logistik Terpercaya</span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mt-6 mb-6 leading-tight">Mitra Profesional untuk Kebutuhan Industri Anda</h1>
            <p class="text-slate-400 text-base md:text-lg mb-8 max-w-2xl mx-auto">Kami berdedikasi tinggi memberikan pelayanan terbaik, efisien, dan berstandar profesional untuk mendukung kesuksesan bisnis Anda.</p>
            <div class="flex justify-center gap-4">
                <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl transition text-sm">Hubungi Kami</a>
                <a href="#services" class="bg-slate-800 hover:bg-slate-700 text-slate-200 font-medium px-6 py-3 rounded-xl transition text-sm">Lihat Layanan</a>
            </div>
        </div>
 
        <!-- Statistik animasi -->
        <div class="max-w-4xl mx-auto mt-16 grid grid-cols-3 gap-4 md:gap-8 text-center reveal">
            <div>
                <p class="text-3xl md:text-5xl font-extrabold text-white"><span class="counter-value" data-target="10">0</span>+</p>
                <p class="text-slate-400 text-xs md:text-sm mt-1">Tahun Pengalaman</p>
            </div>
            <div>
                <p class="text-3xl md:text-5xl font-extrabold text-white"><span class="counter-value" data-target="120">0</span>+</p>
                <p class="text-slate-400 text-xs md:text-sm mt-1">Proyek Terselesaikan</p>
            </div>
            <div>
                <p class="text-3xl md:text-5xl font-extrabold text-white"><span class="counter-value" data-target="24">0</span>/7</p>
                <p class="text-slate-400 text-xs md:text-sm mt-1">Layanan Siap Sedia</p>
            </div>
        </div>
    </section>
 
    <!-- Tentang Kami -->
    <section id="about" class="py-20 px-6 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <h2 class="text-blue-500 text-xs uppercase font-bold tracking-widest mb-2">Tentang Perusahaan</h2>
                <h3 class="text-3xl font-bold text-white mb-6">Membangun Kepercayaan Melalui Kualitas Layanan</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">PT Bachri Samudera Indonesia terus berkembang menjadi salah satu perusahaan terdepan yang mengedepankan profesionalisme, integritas, dan kepuasan mitra kerja di berbagai sektor industri.</p>
                <p class="text-slate-400 text-sm leading-relaxed">Didukung oleh tenaga ahli yang berpengalaman, kami siap memberikan solusi cepat, tepat, dan amanah.</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 p-8 rounded-2xl reveal">
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-blue-500/10 text-blue-400 rounded-xl"><i class="fa-solid fa-bullseye text-xl"></i></div>
                        <div>
                            <h4 class="text-white font-bold mb-1">Visi Utama</h4>
                            <p class="text-slate-400 text-xs">Menjadi perusahaan penyedia jasa dan layanan profesional terkemuka yang diandalkan di tingkat nasional maupun internasional.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-blue-500/10 text-blue-400 rounded-xl"><i class="fa-solid fa-rocket text-xl"></i></div>
                        <div>
                            <h4 class="text-white font-bold mb-1">Misi Perusahaan</h4>
                            <p class="text-slate-400 text-xs">Memberikan standar pelayanan tertinggi, menjaga kepuasan klien, serta berinovasi secara berkelanjutan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Layanan Kami -->
    <section id="services" class="py-20 px-6 bg-slate-900/50 border-t border-b border-slate-800">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-xl mx-auto mb-16 reveal">
                <h2 class="text-blue-500 text-xs uppercase font-bold tracking-widest mb-2">Layanan Kami</h2>
                <h3 class="text-3xl font-bold text-white">Apa yang Kami Tawarkan</h3>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="service-card bg-slate-900 border border-slate-800 p-6 rounded-2xl reveal">
                    <div class="p-3 bg-blue-600/10 text-blue-400 rounded-xl w-fit mb-4"><i class="fa-solid fa-ship text-2xl"></i></div>
                    <h4 class="text-white font-bold text-lg mb-2">Layanan Maritim & Logistik</h4>
                    <p class="text-slate-400 text-xs leading-relaxed mb-4">Pengelolaan operasional dan penunjang kebutuhan sektor kemaritiman secara menyeluruh.</p>
                    <a href="#contact" class="inline-flex items-center gap-2 text-blue-400 text-xs font-semibold">Tanyakan Layanan <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
                <div class="service-card bg-slate-900 border border-slate-800 p-6 rounded-2xl reveal">
                    <div class="p-3 bg-blue-600/10 text-blue-400 rounded-xl w-fit mb-4"><i class="fa-solid fa-handshake text-2xl"></i></div>
                    <h4 class="text-white font-bold text-lg mb-2">Konsultasi Bisnis</h4>
                    <p class="text-slate-400 text-xs leading-relaxed mb-4">Layanan konsultasi strategis guna membantu perkembangan dan optimalisasi operasional perusahaan Anda.</p>
                    <a href="#contact" class="inline-flex items-center gap-2 text-blue-400 text-xs font-semibold">Tanyakan Layanan <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
                <div class="service-card bg-slate-900 border border-slate-800 p-6 rounded-2xl reveal">
                    <div class="p-3 bg-blue-600/10 text-blue-400 rounded-xl w-fit mb-4"><i class="fa-solid fa-gears text-2xl"></i></div>
                    <h4 class="text-white font-bold text-lg mb-2">General Trading</h4>
                    <p class="text-slate-400 text-xs leading-relaxed mb-4">Penyediaan berbagai kebutuhan barang dan jasa penunjang industri secara profesional dan terpercaya.</p>
                    <a href="#contact" class="inline-flex items-center gap-2 text-blue-400 text-xs font-semibold">Tanyakan Layanan <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Kontak & Form Email -->
    <section id="contact" class="py-20 px-6 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Informasi Kontak -->
            <div class="reveal">
                <h3 class="text-white text-2xl font-bold mb-4">Hubungi Kami</h3>
                <p class="text-sm text-slate-400 mb-2">Reni Jaya Office, Jl. Kenari XV No. 12, Pamulang Barat,</p>
                <p class="text-sm text-slate-400 mb-4">Pamulang - Tangerang Selatan</p>
                <p class="text-sm text-slate-400 mb-2">Telepon: +62 857 1414 1802 / +62 8212 451 2741</p>
                <p class="text-sm text-slate-400 mb-6">Email: bachrisamuderaindonesia@gmail.com</p>
            </div>
 
            <!-- Form Kirim Pesan ke Email -->
            <div class="reveal">
                <h3 class="text-white text-2xl font-bold mb-4">Kirim Pesan</h3>
 
                <!-- Notifikasi Pesan Berhasil Terkirim -->
                @if(session('success'))
                    <div class="bg-emerald-600 text-white p-3 rounded-lg mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
 
                <form id="contactForm" action="{{ route('contact.send') }}" method="POST" class="space-y-4" novalidate>
                    @csrf
                    <div>
                        <label class="block text-xs uppercase font-bold mb-1 text-slate-400">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-3 text-white text-sm focus:outline-none focus:border-blue-500">
                        <p class="field-error hidden text-red-400 text-xs mt-1">Nama wajib diisi.</p>
                    </div>
                    <div>
                        <label class="block text-xs uppercase font-bold mb-1 text-slate-400">Email</label>
                        <input type="email" name="email" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-3 text-white text-sm focus:outline-none focus:border-blue-500">
                        <p class="field-error hidden text-red-400 text-xs mt-1">Masukkan alamat email yang valid.</p>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs uppercase font-bold text-slate-400">Pesan</label>
                            <span id="msgCounter" class="text-[10px] text-slate-500">0/500</span>
                        </div>
                        <textarea name="message" id="messageField" maxlength="500" rows="3" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-3 text-white text-sm focus:outline-none focus:border-blue-500"></textarea>
                        <p class="field-error hidden text-red-400 text-xs mt-1">Pesan wajib diisi.</p>
                    </div>
                    <button type="submit" id="submitBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition inline-flex items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        <span id="submitLabel">Kirim Pesan</span>
                        <i id="submitSpinner" class="fa-solid fa-circle-notch fa-spin hidden"></i>
                    </button>
                </form>
            </div>
        </div>
 
        <div class="mt-16 pt-8 border-t border-slate-900 text-center text-xs text-slate-500">
            &copy; 2026 PT Bachri Samudera Indonesia. All rights reserved.
        </div>
    </section>
 
    <!-- Floating WhatsApp Button (Langsung Klik ke WA Admin) -->
    <a href="https://wa.me/6285714141802?text=Halo%20Admin%20PT%20Bachri%20Samudera%20Indonesia,%20saya%20ingin%20bertanya%20mengenai%20layanan%20perusahaan." 
       class="whatsapp-float" 
       target="_blank" 
       title="Hubungi Admin via WhatsApp">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
    </a>
 
    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
 
    <script>
        // ===== Mobile menu toggle =====
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
 
        menuToggle.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            menuToggle.setAttribute('aria-expanded', isOpen);
            menuIcon.classList.toggle('fa-bars', !isOpen);
            menuIcon.classList.toggle('fa-xmark', isOpen);
        });
 
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', false);
                menuIcon.classList.add('fa-bars');
                menuIcon.classList.remove('fa-xmark');
            });
        });
 
        // ===== Navbar shrink + shadow on scroll =====
        const header = document.getElementById('siteHeader');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                header.classList.add('shadow-lg', 'shadow-black/30');
            } else {
                header.classList.remove('shadow-lg', 'shadow-black/30');
            }
        }, { passive: true });
 
        // ===== Active nav link highlighting =====
        const navLinks = document.querySelectorAll('[data-nav]');
        const sections = ['about', 'services', 'contact']
            .map(id => document.getElementById(id))
            .filter(Boolean);
 
        function setActiveLink() {
            let currentId = null;
            const scrollPos = window.scrollY + 120;
            sections.forEach(section => {
                if (section.offsetTop <= scrollPos) {
                    currentId = section.id;
                }
            });
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                const matches = currentId ? href === '#' + currentId : href === '#';
                link.classList.toggle('active', matches);
            });
        }
        window.addEventListener('scroll', setActiveLink, { passive: true });
        setActiveLink();
 
        // ===== Scroll reveal animations =====
        const revealEls = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('is-visible'), i * 80);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(el => revealObserver.observe(el));
 
        // ===== Animated counters =====
        const counters = document.querySelectorAll('.counter-value');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const target = parseInt(el.dataset.target, 10);
                const duration = 1200;
                const start = performance.now();
 
                function tick(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    el.textContent = Math.floor(progress * target);
                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        el.textContent = target;
                    }
                }
                requestAnimationFrame(tick);
                counterObserver.unobserve(el);
            });
        }, { threshold: 0.4 });
        counters.forEach(el => counterObserver.observe(el));
 
        // ===== Back to top button =====
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('visible', window.scrollY > 400);
        }, { passive: true });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
 
        // ===== Contact form validation + submit state =====
        const contactForm = document.getElementById('contactForm');
        const messageField = document.getElementById('messageField');
        const msgCounter = document.getElementById('msgCounter');
        const submitBtn = document.getElementById('submitBtn');
        const submitLabel = document.getElementById('submitLabel');
        const submitSpinner = document.getElementById('submitSpinner');
 
        if (messageField) {
            messageField.addEventListener('input', () => {
                msgCounter.textContent = `${messageField.value.length}/500`;
            });
        }
 
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                let hasError = false;
                contactForm.querySelectorAll('[required]').forEach(field => {
                    const errorEl = field.parentElement.querySelector('.field-error');
                    let invalid = field.value.trim() === '';
                    if (field.type === 'email' && !invalid) {
                        invalid = !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim());
                    }
                    if (invalid) {
                        hasError = true;
                        field.classList.add('border-red-500');
                        errorEl?.classList.remove('hidden');
                    } else {
                        field.classList.remove('border-red-500');
                        errorEl?.classList.add('hidden');
                    }
                });
 
                if (hasError) {
                    e.preventDefault();
                    return;
                }
 
                // Menampilkan status loading saat form benar-benar dikirim ke server
                submitBtn.disabled = true;
                submitLabel.textContent = 'Mengirim...';
                submitSpinner.classList.remove('hidden');
            });
 
            contactForm.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('input', () => {
                    field.classList.remove('border-red-500');
                    field.parentElement.querySelector('.field-error')?.classList.add('hidden');
                });
            });
        }
    </script>
 
 <!-- Lokasi / Peta Kantor -->
    <section class="py-12 px-6 max-w-7xl mx-auto">
        <div class="text-center max-w-xl mx-auto mb-10">
            <h2 class="text-blue-500 text-xs uppercase font-bold tracking-widest mb-2">Lokasi Kami</h2>
            <h3 class="text-3xl font-bold text-white">Temukan Kantor Kami</h3>
            <p class="text-slate-400 text-sm mt-2">Reni Jaya Office, Jl. Kenari XV No. 12, Pamulang Barat, Pamulang - Tangerang Selatan</p>
        </div>
        
        <div class="w-full h-96 rounded-2xl overflow-hidden border border-slate-800 shadow-2xl">
            <!-- Google Maps Embed untuk Reni Jaya, Pamulang -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.808035293677!2d106.7265!3d-6.3355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69efd8a0000001%3A0x123456789abcdef!2sJl.%20Kenari%20XV%2C%20Pamulang%20Bar.%2C%20Kec.%20Pamulang%2C%20Kota%20Tangerang%20Selatan%2C%2B Banten!5e0!3m2!1sid!2sid!4v1650000000000!5m2!1sid!2sid" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</body>
</html>
 
