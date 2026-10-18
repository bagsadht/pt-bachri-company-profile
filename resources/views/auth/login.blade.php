<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk - BachriKarir | PT Bachri Samudera Indonesia</title>
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%232f7bff'/%3E%3Cstop offset='1' stop-color='%234f46e5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='64' height='64' rx='18' fill='url(%23g)'/%3E%3Cg stroke='white' stroke-width='6.4' stroke-linecap='round' stroke-linejoin='round' fill='none'%3E%3Cpath d='M23 12.5v28'/%3E%3Cpath d='M23 12.5h10.5a6.6 6.6 0 0 1 0 13.2H23'/%3E%3Cpath d='M23 25.7h12a7.4 7.4 0 0 1 0 14.8H23'/%3E%3C/g%3E%3Cpath d='M11 50c3.6-3.6 7.2-3.6 10.8 0s7.2 3.6 10.8 0 7.2-3.6 10.8 0 5 2.6 7.6.6' stroke='%2322d3ee' stroke-width='3.4' stroke-linecap='round' fill='none'/%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #0b1222;
            --blue: #0d6efd;
            --indigo: #4f46e5;
            --cyan: #22d3ee;
            --text: #e8eeff;
            --muted: #94a3c4;
            --line: rgba(255, 255, 255, .12);
            --danger: #fb7185;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--text);
            background: var(--bg);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ============ LATAR HIDUP ============ */
        .bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(1200px 700px at 15% 10%, #17275a 0%, transparent 60%),
                radial-gradient(900px 600px at 90% 90%, #1b1a5e 0%, transparent 60%),
                var(--bg);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: .55;
            will-change: transform;
        }

        .blob.b1 {
            width: 420px;
            height: 420px;
            background: var(--blue);
            top: -120px;
            left: -100px;
            animation: float1 16s ease-in-out infinite;
        }

        .blob.b2 {
            width: 380px;
            height: 380px;
            background: var(--indigo);
            bottom: -140px;
            right: -80px;
            animation: float2 19s ease-in-out infinite;
        }

        .blob.b3 {
            width: 260px;
            height: 260px;
            background: var(--cyan);
            top: 55%;
            left: 38%;
            opacity: .22;
            animation: float3 22s ease-in-out infinite;
        }

        @keyframes float1 {
            50% {
                transform: translate(90px, 70px) scale(1.12);
            }
        }

        @keyframes float2 {
            50% {
                transform: translate(-100px, -60px) scale(1.15);
            }
        }

        @keyframes float3 {
            50% {
                transform: translate(-60px, 80px) scale(.9);
            }
        }

        #net {
            position: fixed;
            inset: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
        }

        .grain {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            background-image: radial-gradient(rgba(255, 255, 255, .05) 1px, transparent 1px);
            background-size: 26px 26px;
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
        }

        /* ============ LAYOUT ============ */
        .wrap {
            position: relative;
            z-index: 3;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 3.5rem;
            max-width: 1240px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }

        .hero,
        .stage {
            animation: enter .8s cubic-bezier(.2, .7, .2, 1) both;
        }

        .stage {
            animation-delay: .1s;
        }

        @keyframes enter {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* ============ MEREK ============ */
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--text);
        }

        .logo {
            width: 60px;
            height: 60px;
            display: block;
            border-radius: 17px;
            box-shadow: 0 14px 32px -10px rgba(79, 70, 229, .9), 0 0 0 1px rgba(255, 255, 255, .2) inset;
            transition: transform .35s cubic-bezier(.2, .8, .2, 1), box-shadow .35s ease;
        }

        .brand:hover .logo {
            transform: translateY(-3px) rotate(-4deg);
            box-shadow: 0 18px 38px -8px rgba(34, 211, 238, .65), 0 0 0 1px rgba(255, 255, 255, .3) inset;
        }

        .logo .w1 {
            animation: drift 4s ease-in-out infinite;
        }

        .logo .w2 {
            animation: drift 4s ease-in-out -2s infinite;
        }

        @keyframes drift {
            50% {
                transform: translateX(3px);
            }
        }

        .wordmark {
            display: block;
            font-size: 1.55rem;
            font-weight: 800;
            letter-spacing: -.03em;
            line-height: 1;
        }

        .wordmark i {
            font-style: normal;
            color: #67e8f9;
        }

        .company {
            display: block;
            margin-top: .45rem;
            font-size: .82rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* ============ KALIMAT UTAMA ============ */
        .hero h1 {
            margin-top: 2.8rem;
            font-size: clamp(2rem, 3.2vw, 2.7rem);
            line-height: 1.16;
            font-weight: 800;
            letter-spacing: -.035em;
            max-width: 560px;
            text-wrap: balance;
        }

        .hero h1 span {
            color: #7f95c9;
        }

        .lead-text {
            margin-top: 1.15rem;
            color: var(--muted);
            line-height: 1.7;
            max-width: 440px;
            font-size: 1rem;
        }

        /* ============ ALUR KERJA ============ */
        .flow {
            position: relative;
            list-style: none;
            margin-top: 2.2rem;
            max-width: 500px;
            display: grid;
            gap: .25rem;
        }

        .flow .rail,
        .flow .fill {
            position: absolute;
            left: 34px;
            width: 2px;
            border-radius: 2px;
        }

        .flow .rail {
            background: var(--line);
        }

        .flow .fill {
            background: linear-gradient(#60a5fa, #22d3ee);
            transition: height .6s cubic-bezier(.2, .7, .2, 1);
        }

        .step {
            position: relative;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: .8rem 1rem .8rem .6rem;
            border-radius: 16px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: background .25s, border-color .25s;
        }

        .step>div {
            opacity: .62;
            transition: opacity .25s;
        }

        .step:hover>div,
        .step:focus-visible>div,
        .step.on>div {
            opacity: 1;
        }

        .step:focus-visible {
            outline: 2px solid #60a5fa;
            outline-offset: 2px;
        }

        .step.on {
            background: rgba(255, 255, 255, .06);
            border-color: rgba(122, 168, 255, .32);
            backdrop-filter: blur(8px);
        }

        .badge {
            flex: 0 0 auto;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #0e1a3a;
            border: 1.5px solid var(--line);
            color: #8fa3d0;
            font-size: 1.05rem;
            position: relative;
            z-index: 1;
            transition: background .3s, color .3s, border-color .3s, box-shadow .3s, transform .3s;
        }

        .step.on .badge {
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            border-color: transparent;
            color: #fff;
            box-shadow: 0 10px 26px -8px rgba(79, 70, 229, .9), 0 0 0 5px rgba(79, 70, 229, .18);
            transform: scale(1.04);
        }

        .step h3 {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: .6rem;
            font-size: 1.02rem;
            font-weight: 700;
            letter-spacing: -.01em;
            line-height: 1.3;
            padding-top: .2rem;
        }

        .role {
            font-size: .72rem;
            font-weight: 600;
            padding: .16rem .6rem;
            border-radius: 999px;
            color: #a5c4ff;
            background: rgba(96, 165, 250, .14);
            border: 1px solid rgba(96, 165, 250, .28);
        }

        .step p {
            margin-top: .35rem;
            font-size: .88rem;
            line-height: 1.6;
            color: var(--muted);
            max-width: 390px;
        }

        /* ============ KARTU LOGIN ============ */
        .stage {
            perspective: 1100px;
        }

        .card {
            --mx: 50%;
            --my: 0%;
            position: relative;
            width: 100%;
            max-width: 500px;
            margin-left: auto;
            padding: 2.8rem 2.6rem;
            border-radius: 26px;
            background: linear-gradient(160deg, rgba(255, 255, 255, .1), rgba(255, 255, 255, .04));
            border: 1px solid var(--line);
            backdrop-filter: blur(22px) saturate(140%);
            -webkit-backdrop-filter: blur(22px) saturate(140%);
            box-shadow: 0 30px 80px -30px rgba(0, 0, 0, .7), inset 0 1px 0 rgba(255, 255, 255, .12);
            transform-style: preserve-3d;
            transition: transform .15s ease-out;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(420px circle at var(--mx) var(--my), rgba(96, 165, 250, .22), transparent 55%);
            opacity: 0;
            transition: opacity .3s ease;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card.shake {
            animation: shake .5s ease;
        }

        @keyframes shake {

            10%,
            90% {
                transform: translateX(-2px);
            }

            20%,
            80% {
                transform: translateX(4px);
            }

            30%,
            50%,
            70% {
                transform: translateX(-7px);
            }

            40%,
            60% {
                transform: translateX(7px);
            }
        }

        .card-ico {
            width: 58px;
            height: 58px;
            border-radius: 17px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            box-shadow: 0 12px 28px -8px rgba(79, 70, 229, .8);
            font-size: 1.3rem;
            color: #fff;
            animation: pulse 3.2s ease-in-out infinite;
        }

        @keyframes pulse {
            50% {
                box-shadow: 0 12px 38px -4px rgba(34, 211, 238, .65);
                transform: translateY(-2px);
            }
        }

        .card h2 {
            margin-top: 1.5rem;
            font-size: 1.85rem;
            font-weight: 800;
            letter-spacing: -.025em;
        }

        .card .sub {
            margin-top: .5rem;
            color: var(--muted);
            font-size: .98rem;
            line-height: 1.6;
        }

        .alert {
            margin-top: 1.4rem;
            padding: .9rem 1.05rem;
            border-radius: 13px;
            background: rgba(251, 113, 133, .12);
            border: 1px solid rgba(251, 113, 133, .4);
            color: #fecdd3;
            font-size: .9rem;
            line-height: 1.55;
            display: flex;
            gap: .7rem;
        }

        .alert i {
            margin-top: 3px;
            color: var(--danger);
        }

        /* ============ INPUT ============ */
        .field {
            position: relative;
            margin-top: 1.4rem;
        }

        .field input {
            width: 100%;
            height: 66px;
            padding: 1.65rem 3.6rem .5rem 3.3rem;
            border-radius: 16px;
            border: 1.5px solid var(--line);
            background: rgba(7, 12, 28, .55);
            color: #fff;
            font: inherit;
            font-size: 1.08rem;
            font-weight: 500;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .field input:hover {
            border-color: rgba(255, 255, 255, .25);
        }

        .field input:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(7, 12, 28, .8);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .2), 0 8px 24px -12px rgba(59, 130, 246, .6);
        }

        .field input:-webkit-autofill {
            -webkit-text-fill-color: #fff;
            -webkit-box-shadow: 0 0 0 1000px #0e1a3a inset;
            caret-color: #fff;
        }

        .field label {
            position: absolute;
            left: 3.3rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 1.02rem;
            pointer-events: none;
            transition: all .18s ease;
            transform-origin: left center;
        }

        .field input:focus+label,
        .field input:not(:placeholder-shown)+label {
            top: 21px;
            transform: translateY(-50%) scale(.78);
            color: #8cb4ff;
            font-weight: 600;
        }

        .field .lead {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6f84b3;
            font-size: 1.1rem;
            transition: color .2s, transform .2s;
            pointer-events: none;
        }

        .field:focus-within .lead {
            color: #60a5fa;
            transform: translateY(-50%) scale(1.15);
        }

        .toggle {
            position: absolute;
            right: 9px;
            top: 50%;
            transform: translateY(-50%);
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 12px;
            background: transparent;
            color: #7f93bf;
            font-size: 1.05rem;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .toggle:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff;
        }

        .toggle:focus-visible {
            outline: 2px solid #60a5fa;
        }

        .hint {
            display: none;
            margin-top: .6rem;
            font-size: .84rem;
            color: #fcd34d;
            align-items: center;
            gap: .5rem;
        }

        .hint.show {
            display: flex;
        }

        /* ============ TOMBOL ============ */
        .btn {
            position: relative;
            overflow: hidden;
            margin-top: 1.9rem;
            width: 100%;
            height: 60px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            color: #fff;
            font: inherit;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .7rem;
            box-shadow: 0 16px 34px -14px rgba(79, 70, 229, .9);
            transition: transform .2s, box-shadow .2s, filter .2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 40px -14px rgba(79, 70, 229, 1);
            filter: brightness(1.08);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:focus-visible {
            outline: 3px solid rgba(96, 165, 250, .6);
            outline-offset: 3px;
        }

        .btn .arrow {
            transition: transform .2s;
        }

        .btn:hover .arrow {
            transform: translateX(4px);
        }

        .btn[disabled] {
            cursor: progress;
            filter: saturate(.8);
            transform: none;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .45);
            transform: scale(0);
            animation: ripple .6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .btn.loading .spinner {
            display: inline-block;
        }

        .btn.loading .arrow {
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .note {
            margin-top: 1.7rem;
            padding-top: 1.3rem;
            border-top: 1px dashed var(--line);
            display: flex;
            gap: .7rem;
            align-items: center;
            color: var(--muted);
            font-size: .84rem;
            line-height: 1.55;
        }

        .note i {
            color: #6f84b3;
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            margin: 1.25rem 0 0 auto;
            color: var(--muted);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            padding: .5rem .85rem;
            border-radius: 10px;
            transition: color .2s, background .2s;
        }

        .back:hover {
            color: #fff;
            background: rgba(255, 255, 255, .08);
        }

        .back i {
            transition: transform .2s;
        }

        .back:hover i {
            transform: translateX(-4px);
        }

        .foot {
            position: fixed;
            z-index: 3;
            left: 0;
            right: 0;
            bottom: 14px;
            text-align: center;
            font-size: .75rem;
            color: #5f739f;
            pointer-events: none;
        }

        /* ============ RESPONSIF ============ */
        @media (max-width: 960px) {
            .wrap {
                grid-template-columns: 1fr;
                gap: 1.75rem;
                padding: 1.75rem 1.1rem 1rem;
            }

            .hero h1 {
                margin-top: 1.6rem;
                font-size: 1.7rem;
            }

            .lead-text,
            .flow {
                display: none;
            }

            .card {
                margin: 0 auto;
                padding: 2.1rem 1.5rem;
            }

            .back {
                margin: 1rem auto 0;
                display: flex;
                width: fit-content;
            }

            .foot {
                position: static;
                padding: 0 1rem 1.5rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            #net {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="bg" aria-hidden="true">
        <span class="blob b1"></span><span class="blob b2"></span><span class="blob b3"></span>
    </div>
    <canvas id="net" aria-hidden="true"></canvas>
    <div class="grain" aria-hidden="true"></div>

    <div class="wrap">

        {{-- ============ KIRI ============ --}}
        <section class="hero">
            <a href="{{ route('home') }}" class="brand" aria-label="BachriKarir - kembali ke beranda">

                {{-- LOGO: huruf B (Bachri) di atas gelombang laut (Samudera) --}}
                <svg class="logo" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-label="Logo BachriKarir">
                    <defs>
                        <linearGradient id="logoGrad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0" stop-color="#2f7bff" />
                            <stop offset="1" stop-color="#4f46e5" />
                        </linearGradient>
                        <linearGradient id="logoShine" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0" stop-color="#fff" stop-opacity=".25" />
                            <stop offset="1" stop-color="#fff" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <rect width="64" height="64" rx="18" fill="url(#logoGrad)" />
                    <rect width="64" height="32" rx="18" fill="url(#logoShine)" />
                    <g stroke="#fff" stroke-width="6.4" stroke-linecap="round" stroke-linejoin="round" fill="none">
                        <path d="M23 12.5v28" />
                        <path d="M23 12.5h10.5a6.6 6.6 0 0 1 0 13.2H23" />
                        <path d="M23 25.7h12a7.4 7.4 0 0 1 0 14.8H23" />
                    </g>
                    <path class="w1" d="M11 50c3.6-3.6 7.2-3.6 10.8 0s7.2 3.6 10.8 0 7.2-3.6 10.8 0 5 2.6 7.6.6"
                        stroke="#22d3ee" stroke-width="3.4" stroke-linecap="round" fill="none" />
                    <path class="w2" d="M11 56c3.6-3.6 7.2-3.6 10.8 0s7.2 3.6 10.8 0 7.2-3.6 10.8 0 5 2.6 7.6.6"
                        stroke="#fff" stroke-opacity=".35" stroke-width="3" stroke-linecap="round" fill="none" />
                </svg>

                <span>
                    <span class="wordmark">Bachri<i>Karir</i></span>
                    <span class="company">PT Bachri Samudera Indonesia</span>
                </span>
            </a>

            <h1>
                Satu alur kerja
                <span>untuk seluruh proses rekrutmen.</span>
            </h1>

            <p class="lead-text">Admin menayangkan lowongan. HRD menyeleksi pelamar dan menyusun laporan rekrutmen.</p>

            <ol class="flow" id="flow" aria-label="Alur kerja rekrutmen">
                <span class="rail" id="rail" aria-hidden="true"></span>
                <span class="fill" id="fill" aria-hidden="true"></span>

                <li class="step on" tabindex="0">
                    <span class="badge"><i class="fa-solid fa-briefcase"></i></span>
                    <div>
                        <h3>Tayangkan lowongan <span class="role">Admin</span></h3>
                        <p>Isi posisi, persyaratan, dan batas waktu, lalu tampilkan di halaman karir.</p>
                    </div>
                </li>
                <li class="step" tabindex="0">
                    <span class="badge"><i class="fa-solid fa-user-check"></i></span>
                    <div>
                        <h3>Seleksi pelamar <span class="role">HRD</span></h3>
                        <p>Periksa lamaran dan CV, lalu putuskan di tiap tahap sampai diterima atau tidak.</p>
                    </div>
                </li>
                <li class="step" tabindex="0">
                    <span class="badge"><i class="fa-solid fa-file-lines"></i></span>
                    <div>
                        <h3>Rekap laporan <span class="role">HRD</span></h3>
                        <p>Lihat ringkasan pelamar dan unduh laporan rekrutmen dalam format CSV.</p>
                    </div>
                </li>
            </ol>
        </section>

        {{-- ============ KANAN ============ --}}
        <main class="stage" id="stage">
            <div class="card {{ $errors->any() || session('error') ? 'shake' : '' }}" id="card">

                <div class="card-ico"><i class="fa-solid fa-lock"></i></div>
                <h2>Selamat datang kembali</h2>
                <p class="sub">Masuk dengan akun Admin atau HRD untuk melanjutkan.</p>

                @if (session('error') || $errors->any())
                    <div class="alert" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>
                            @if (session('error'))
                                <div>{{ session('error') }}</div>
                            @endif
                            @foreach ($errors->all() as $e)
                                <div>{{ $e }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" id="loginForm" novalidate>
                    @csrf

                    <div class="field">
                        <i class="fa-regular fa-envelope lead"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder=" " autocomplete="username" autofocus required>
                        <label for="email">Email</label>
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-key lead"></i>
                        <input type="password" id="password" name="password" placeholder=" "
                            autocomplete="current-password" required>
                        <label for="password">Password</label>
                        <button type="button" class="toggle" id="toggle" aria-label="Tampilkan password">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>

                    <div class="hint" id="caps" role="status">
                        <i class="fa-solid fa-triangle-exclamation"></i> Caps Lock sedang aktif
                    </div>

                    <button type="submit" class="btn" id="submitBtn">
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="label">Masuk</span>
                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </button>
                </form>

                <div class="note">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Halaman ini khusus Admin dan HRD. Pelamar tidak perlu login untuk melamar.</span>
                </div>
            </div>

            <a href="{{ route('home') }}" class="back">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke website
            </a>
        </main>
    </div>

    <div class="foot">&copy; {{ date('Y') }} PT Bachri Samudera Indonesia</div>

    <script>
        (function() {
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const touch = window.matchMedia('(pointer: coarse)').matches;

            /* ---------- 1. Jaringan partikel yang bereaksi pada mouse ---------- */
            const cv = document.getElementById('net');
            const ctx = cv.getContext('2d');
            let dots = [],
                mouse = {
                    x: -999,
                    y: -999
                },
                raf;

            function size() {
                const dpr = Math.min(window.devicePixelRatio || 1, 2);
                cv.width = innerWidth * dpr;
                cv.height = innerHeight * dpr;
                cv.style.width = innerWidth + 'px';
                cv.style.height = innerHeight + 'px';
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                const n = Math.min(70, Math.floor(innerWidth / 22));
                dots = Array.from({
                    length: n
                }, () => ({
                    x: Math.random() * innerWidth,
                    y: Math.random() * innerHeight,
                    vx: (Math.random() - .5) * .35,
                    vy: (Math.random() - .5) * .35,
                    r: Math.random() * 1.6 + .6
                }));
            }

            function draw() {
                ctx.clearRect(0, 0, innerWidth, innerHeight);
                for (let i = 0; i < dots.length; i++) {
                    const a = dots[i];
                    a.x += a.vx;
                    a.y += a.vy;
                    if (a.x < 0 || a.x > innerWidth) a.vx *= -1;
                    if (a.y < 0 || a.y > innerHeight) a.vy *= -1;

                    const dx = mouse.x - a.x,
                        dy = mouse.y - a.y,
                        d = Math.hypot(dx, dy);
                    if (d < 160) {
                        a.x -= dx * .004;
                        a.y -= dy * .004;
                    }

                    ctx.beginPath();
                    ctx.arc(a.x, a.y, a.r, 0, 6.283);
                    ctx.fillStyle = 'rgba(147,197,253,.75)';
                    ctx.fill();

                    for (let j = i + 1; j < dots.length; j++) {
                        const b = dots[j],
                            dist = Math.hypot(a.x - b.x, a.y - b.y);
                        if (dist < 130) {
                            ctx.strokeStyle = 'rgba(96,165,250,' + (.22 * (1 - dist / 130)) + ')';
                            ctx.lineWidth = .7;
                            ctx.beginPath();
                            ctx.moveTo(a.x, a.y);
                            ctx.lineTo(b.x, b.y);
                            ctx.stroke();
                        }
                    }

                    if (d < 170) {
                        ctx.strokeStyle = 'rgba(34,211,238,' + (.4 * (1 - d / 170)) + ')';
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(mouse.x, mouse.y);
                        ctx.stroke();
                    }
                }
                raf = requestAnimationFrame(draw);
            }

            if (!reduce) {
                size();
                draw();
                addEventListener('resize', size);
                addEventListener('mousemove', e => {
                    mouse.x = e.clientX;
                    mouse.y = e.clientY;
                });
                addEventListener('mouseout', () => {
                    mouse.x = mouse.y = -999;
                });
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) cancelAnimationFrame(raf);
                    else draw();
                });
            }

            /* ---------- 2. Kartu miring 3D + cahaya mengikuti kursor ---------- */
            const card = document.getElementById('card');
            const stage = document.getElementById('stage');

            if (!reduce && !touch) {
                stage.addEventListener('mousemove', e => {
                    const r = card.getBoundingClientRect();
                    const x = e.clientX - r.left,
                        y = e.clientY - r.top;
                    card.style.transform = 'rotateX(' + (((y / r.height) - .5) * -5) + 'deg) rotateY(' + (((x /
                        r.width) - .5) * 5) + 'deg)';
                    card.style.setProperty('--mx', x + 'px');
                    card.style.setProperty('--my', y + 'px');
                });
                stage.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                });
            }

            card.addEventListener('animationend', e => {
                if (e.animationName === 'shake') card.classList.remove('shake');
            });

            /* ---------- 3. Alur kerja interaktif ---------- */
            const flow = document.getElementById('flow');
            const rail = document.getElementById('rail');
            const fill = document.getElementById('fill');
            const steps = Array.from(flow.querySelectorAll('.step'));
            let active = 0,
                timer = null,
                paused = false;

            function center(i) {
                const b = steps[i].querySelector('.badge');
                return steps[i].offsetTop + b.offsetTop + b.offsetHeight / 2;
            }

            function layout() {
                if (!flow.offsetParent) return;
                const first = center(0),
                    last = center(steps.length - 1);
                rail.style.top = first + 'px';
                rail.style.height = (last - first) + 'px';
                fill.style.top = first + 'px';
                fill.style.height = (center(active) - first) + 'px';
            }

            function setActive(i) {
                active = i;
                steps.forEach((s, k) => s.classList.toggle('on', k === i));
                layout();
            }

            function play() {
                clearInterval(timer);
                if (reduce) return;
                timer = setInterval(() => {
                    if (!paused) setActive((active + 1) % steps.length);
                }, 3600);
            }

            steps.forEach((s, i) => {
                s.addEventListener('mouseenter', () => {
                    paused = true;
                    setActive(i);
                });
                s.addEventListener('focus', () => {
                    paused = true;
                    setActive(i);
                });
                s.addEventListener('click', () => setActive(i));
                s.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        setActive(i);
                    }
                });
            });

            flow.addEventListener('mouseleave', () => {
                paused = false;
            });
            flow.addEventListener('focusout', () => {
                paused = false;
            });

            addEventListener('resize', layout);
            addEventListener('load', layout);
            if (document.fonts && document.fonts.ready) document.fonts.ready.then(layout);
            layout();
            play();

            /* ---------- 4. Tampil/sembunyi password + peringatan Caps Lock ---------- */
            const pwd = document.getElementById('password');
            const tgl = document.getElementById('toggle');
            const caps = document.getElementById('caps');

            tgl.addEventListener('click', () => {
                const show = pwd.type === 'password';
                pwd.type = show ? 'text' : 'password';
                tgl.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                tgl.firstElementChild.className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
                pwd.focus();
            });

            ['keydown', 'keyup'].forEach(ev => pwd.addEventListener(ev, e => {
                caps.classList.toggle('show', e.getModifierState && e.getModifierState('CapsLock'));
            }));
            pwd.addEventListener('blur', () => caps.classList.remove('show'));

            /* ---------- 5. Efek riak + status loading pada tombol ---------- */
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('submitBtn');
            const label = btn.querySelector('.label');

            btn.addEventListener('click', e => {
                const r = btn.getBoundingClientRect();
                const s = Math.max(r.width, r.height);
                const dot = document.createElement('span');
                dot.className = 'ripple';
                dot.style.cssText = 'width:' + s + 'px;height:' + s + 'px;left:' + (e.clientX - r.left - s /
                    2) + 'px;top:' + (e.clientY - r.top - s / 2) + 'px';
                btn.appendChild(dot);
                setTimeout(() => dot.remove(), 600);
            });

            form.addEventListener('submit', e => {
                const email = document.getElementById('email');
                if (!email.value.trim() || !pwd.value) {
                    e.preventDefault();
                    card.classList.remove('shake');
                    void card.offsetWidth;
                    card.classList.add('shake');
                    (email.value.trim() ? pwd : email).focus();
                    return;
                }
                btn.classList.add('loading');
                btn.setAttribute('aria-busy', 'true');
                label.textContent = 'Memproses...';
                setTimeout(() => {
                    btn.disabled = true;
                }, 0);
            });

            addEventListener('pageshow', e => {
                if (e.persisted) {
                    btn.disabled = false;
                    btn.classList.remove('loading');
                    btn.removeAttribute('aria-busy');
                    label.textContent = 'Masuk';
                }
            });
        })();
    </script>

</body>

</html>