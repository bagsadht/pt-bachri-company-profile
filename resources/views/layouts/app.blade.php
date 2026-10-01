<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT Bachri Samudera Indonesia')</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 (BARU - untuk icon-icon di halaman kontak) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false,
            },
            theme: {
                extend: {
                    colors: {
                        primary: '#0b131e',
                        accent: '#f1c40f',
                    }
                }
            }
        }
    </script>

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #0b131e;
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ==================== NAVBAR (DENGAN STRUKTUR TABEL) ==================== */
        .navbar-container {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99999 !important;
            background-color: rgba(0, 0, 0, 0.31); /* Background hitam transparan sesuai referensi[cite: 1] */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(241, 196, 15, 0.15);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        }

        .navbar-table {
            width: 100%;
            border-collapse: collapse;
        }

        .navbar-logo {
            text-align: left;
            vertical-align: middle;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 3cm; /* Jarak 3 cm dari tepi kiri layar[cite: 1] */
        }

        /* Styling untuk memperbesar gambar logo */
        .navbar-logo img {
            height: 70px; /* Diperbesar dari 45px menjadi 70px */
            width: auto;
            display: block;
            transition: all 0.4s ease;
        }

        .navbar-logo a:hover img {
            transform: translateY(-2px);
            filter: drop-shadow(0 0 8px rgba(241, 196, 15, 0.5));
        }

        .navbar-menu-td {
            text-align: right;
            vertical-align: middle;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-right: 3cm; /* Jarak 3 cm dari tepi kanan layar[cite: 1] */
        }

        /* ==================== HAMBURGER ==================== */
        .nav-toggle {
            display: none !important;
            background: transparent;
            border: 1px solid rgba(241, 196, 15, 0.3);
            border-radius: 8px;
            padding: 10px 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            float: right;
            margin-top: -5px;
        }

        .nav-toggle:hover {
            background: rgba(241, 196, 15, 0.1);
        }

        .nav-toggle svg {
            width: 24px;
            height: 24px;
            color: #f1c40f;
            display: block;
        }

        /* ==================== MENU ==================== */
        .nav-menu-custom {
            display: inline-flex !important;
            flex-direction: row !important;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 15px;
            align-items: center;
        }

        .nav-menu-custom li {
            list-style: none;
            display: inline-block;
        }

        .nav-menu-custom .nav-link {
            color: rgba(255, 255, 255, 0.85) !important; 
            font-size: 1rem; 
            font-weight: 600;
            text-decoration: none !important;
            padding: 10px 15px !important; 
            position: relative;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-block;
        }

        .nav-menu-custom .nav-link:hover, 
        .nav-menu-custom .nav-link.active {
            color: #f1c40f !important; 
            transform: translateY(-2px);
        }

        .nav-menu-custom .nav-link:not(.btn-cta)::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: 5px; left: 15px;
            background: linear-gradient(90deg, #f1c40f, #e67e22);
            transition: width 0.3s ease; border-radius: 2px;
        }

        .nav-menu-custom .nav-link:not(.btn-cta):hover::after, 
        .nav-menu-custom .nav-link:not(.btn-cta).active::after {
            width: calc(100% - 30px);
        }

        /* ==================== CTA BUTTON ==================== */
        .btn-cta {
            background: transparent !important;
            color: #f1c40f !important;
            border: 2px solid #f1c40f !important;
            border-radius: 50px !important;
            padding: 9px 25px !important;
            font-weight: 700 !important;
            transition: all 0.35s ease !important;
            position: relative; overflow: hidden; z-index: 1;
        }

        .btn-cta::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, #f1c40f, #e67e22);
            z-index: -1;
            transform: scaleX(0); transform-origin: right;
            transition: transform 0.35s ease; border-radius: 50px;
        }

        .btn-cta:hover {
            color: #0b131e !important;
            border-color: transparent !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 10px 25px rgba(241, 196, 15, 0.4) !important;
        }

        .btn-cta:hover::before {
            transform: scaleX(1); transform-origin: left;
        }

        /* ==================== MAIN ==================== */
        main.main-content {
            padding-top: 100px; 
            min-height: 80vh;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 991.98px) {
            .navbar-logo { padding-left: 20px; }
            .navbar-logo img { height: 50px; } /* Menyesuaikan untuk layar mobile/tablet */
            .navbar-menu-td { padding-right: 20px; }
            .nav-toggle { display: inline-block !important; }

            .nav-menu-custom {
                display: none !important;
                position: absolute;
                top: 100%; left: 0; right: 0;
                flex-direction: column !important;
                background: linear-gradient(180deg, #0b192c 0%, #0a1523 100%);
                padding: 1.5rem 1.25rem;
                gap: 0.5rem;
                border-top: 1px solid rgba(241, 196, 15, 0.15);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
                align-items: stretch;
            }

            .nav-menu-custom.is-open { display: flex !important; }
            .nav-menu-custom li { width: 100%; display: block; }

            .nav-menu-custom .nav-link {
                font-size: 1rem !important;
                padding: 14px 15px !important;
                width: 100%;
                display: block;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                text-align: left;
            }

            .nav-menu-custom .nav-link::after { display: none !important; }

            .btn-cta {
                text-align: center;
                margin-top: 0.75rem;
                width: 100% !important;
                display: block !important;
            }
        }
    </style>
</head>
<body>

    <!-- ==================== HEADER / NAVBAR (STRUKTUR TABEL & LOGO DIPERBESAR) ==================== -->
    <header class="navbar-container">
        <table class="navbar-table">
            <tr>
                <!-- Kolom Logo Berbasis Gambar (Ukuran Diperbesar) -->
                <td class="navbar-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo2.png') }}" alt="PT Bachri Samudera Indonesia Logo">
                    </a>
                </td>
                
                <!-- Kolom Menu Navigasi -->
                <td class="navbar-menu-td">
                    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                        <svg id="navIconOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="navIconClose" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <ul class="nav-menu-custom" id="navMenu">
                        <li><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a></li>
                        <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ url('/about') }}">Tentang Kami</a></li>
                        <li><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ url('/services') }}">Layanan</a></li>
                        <li><a class="nav-link {{ request()->routeIs('careers.*') ? 'active' : '' }}" href="{{ route('careers.index') }}">Karir</a></li>
                        <li><a class="nav-link btn-cta ..." href="{{ url('/contact') }}">Hubungi Kami</a></li>          
                    </ul>
                </td>
            </tr>
        </table>
    </header>

    <!-- ==================== KONTEN HALAMAN ==================== -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 100 });

        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('navToggle');
            const menu = document.getElementById('navMenu');
            const iconOpen = document.getElementById('navIconOpen');
            const iconClose = document.getElementById('navIconClose');

            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('is-open');
                    
                    if (menu.classList.contains('is-open')) {
                        iconOpen.style.display = 'none';
                        iconClose.style.display = 'block';
                    } else {
                        iconOpen.style.display = 'block';
                        iconClose.style.display = 'none';
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                        menu.classList.remove('is-open');
                        iconOpen.style.display = 'block';
                        iconClose.style.display = 'none';
                    }
                });

                menu.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', function() {
                        menu.classList.remove('is-open');
                        iconOpen.style.display = 'block';
                        iconClose.style.display = 'none';
                    });
                });
            }
        });
    </script>
</body>
</html>