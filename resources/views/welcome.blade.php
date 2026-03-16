<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Kopi - Deteksi Penyakit Tanaman Kopi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --green-950: #052e16;
            --green-900: #14532d;
            --green-800: #166534;
            --green-700: #15803d;
            --green-600: #16a34a;
            --green-500: #22c55e;
            --green-400: #4ade80;
            --green-200: #bbf7d0;
            --green-100: #dcfce7;
            --green-50:  #f0fdf4;
            --cream: #fafaf7;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: #1a1a1a; overflow-x: hidden; }

        /* NAVBAR */
        .navbar {
            padding: 16px 0;
            background: rgba(250,250,247,0.92) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(22,163,74,0.1);
            transition: box-shadow 0.3s;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 19px; font-weight: 700;
            color: var(--green-900) !important;
            display: flex; align-items: center; gap: 10px;
        }
        .brand-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--green-600), var(--green-900));
            display: flex; align-items: center; justify-content: center;
        }
        .brand-icon i { color: white; font-size: 18px; }
        .nav-link {
            font-size: 14px; font-weight: 500;
            color: #4b5563 !important; transition: color 0.2s;
            padding: 8px 16px !important;
        }
        .nav-link:hover { color: var(--green-600) !important; }
        .btn-nav-outline {
            padding: 8px 22px; border: 1.5px solid var(--green-600);
            color: var(--green-700); border-radius: 8px;
            font-size: 14px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
            background: transparent;
        }
        .btn-nav-outline:hover { background: var(--green-50); color: var(--green-700); }
        .btn-nav-solid {
            padding: 8px 22px;
            background: linear-gradient(135deg, var(--green-600), var(--green-800));
            color: white !important; border-radius: 8px;
            font-size: 14px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(22,163,74,0.3);
        }
        .btn-nav-solid:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(22,163,74,0.4); }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center;
            padding: 120px 0 80px;
            background: linear-gradient(160deg, #f0fdf4 0%, #fafaf7 50%, #dcfce7 100%);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; top: -200px; right: -200px;
            width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(74,222,128,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px; border-radius: 100px;
            background: var(--green-100); color: var(--green-800);
            font-size: 12px; font-weight: 600; margin-bottom: 24px;
            letter-spacing: 0.5px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 4.5vw, 60px);
            font-weight: 900; line-height: 1.1;
            color: var(--green-950); margin-bottom: 20px;
        }
        .hero h1 em { font-style: italic; color: var(--green-600); }
        .hero p { font-size: 16px; color: #4b5563; line-height: 1.7; margin-bottom: 36px; }
        .btn-hero-primary {
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--green-600), var(--green-800));
            color: white; border-radius: 10px;
            font-size: 15px; font-weight: 600;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(22,163,74,0.35);
            transition: all 0.2s; display: inline-block;
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(22,163,74,0.45); color: white; }
        .btn-hero-secondary {
            padding: 14px 32px;
            border: 2px solid var(--green-200);
            color: var(--green-700); border-radius: 10px;
            font-size: 15px; font-weight: 600;
            text-decoration: none; background: white;
            transition: all 0.2s; display: inline-block;
        }
        .btn-hero-secondary:hover { border-color: var(--green-400); background: var(--green-50); color: var(--green-700); }

        /* HERO CARD */
        .hero-mockup { animation: floatUp 0.8s ease 0.3s both; }
        .mockup-card {
            background: white; border-radius: 20px;
            padding: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin-bottom: 14px;
        }
        .mockup-mini {
            background: white; border-radius: 14px;
            padding: 14px 18px; box-shadow: 0 6px 20px rgba(0,0,0,0.07);
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 10px;
        }
        .mockup-icon {
            width: 42px; height: 42px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-top: 14px; }
        .stat-box { background: var(--green-50); border-radius: 10px; padding: 12px; text-align: center; }
        .stat-num { font-size: 20px; font-weight: 800; color: var(--green-700); }
        .stat-lbl { font-size: 10px; color: #6b7280; margin-top: 2px; }
        .cf-bar { background: #e5e7eb; border-radius: 99px; height: 8px; margin-top: 10px; }
        .cf-fill { background: linear-gradient(90deg, var(--green-400), var(--green-700)); height: 8px; border-radius: 99px; width: 87%; }

        /* SECTIONS */
        section { padding: 96px 0; }
        .section-label {
            font-size: 11px; font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase; color: var(--green-600);
            display: block; margin-bottom: 10px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 3vw, 40px);
            font-weight: 700; color: var(--green-950); line-height: 1.2;
            margin-bottom: 14px;
        }
        .section-sub { font-size: 15px; color: #6b7280; line-height: 1.7; }

        /* FEATURES */
        #fitur { background: white; }
        .feature-card {
            padding: 30px; border-radius: 16px;
            border: 1.5px solid #e5e7eb;
            transition: all 0.3s; height: 100%;
            position: relative; overflow: hidden;
        }
        .feature-card::after {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--green-400), var(--green-600));
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.3s;
        }
        .feature-card:hover { border-color: var(--green-200); transform: translateY(-4px); box-shadow: 0 16px 40px rgba(22,163,74,0.1); }
        .feature-card:hover::after { transform: scaleX(1); }
        .feature-icon {
            width: 50px; height: 50px; border-radius: 12px;
            background: var(--green-50);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }
        .feature-icon i { font-size: 22px; color: var(--green-600); }
        .feature-card h5 { font-size: 17px; font-weight: 700; color: var(--green-900); margin-bottom: 10px; }
        .feature-card p { font-size: 14px; color: #6b7280; line-height: 1.6; margin-bottom: 16px; }
        .feature-link { font-size: 13px; font-weight: 600; color: var(--green-600); text-decoration: none; }
        .feature-link:hover { text-decoration: underline; }
        .feature-link i { transition: transform 0.2s; }
        .feature-link:hover i { transform: translateX(4px); }

        /* ARTIKEL */
        #artikel { background: var(--green-50); }
        .artikel-card {
            background: white; border-radius: 16px;
            overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            transition: all 0.3s; height: 100%;
        }
        .artikel-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
        .artikel-thumb {
            height: 160px; display: flex;
            align-items: center; justify-content: center;
        }
        .artikel-thumb i { font-size: 52px; opacity: 0.6; }
        .artikel-body { padding: 20px; }
        .artikel-tag { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .artikel-body h6 { font-size: 15px; font-weight: 700; color: #1a1a1a; margin: 8px 0; line-height: 1.4; }
        .artikel-body p { font-size: 13px; color: #6b7280; line-height: 1.5; }
        .artikel-footer { padding: 12px 20px; border-top: 1px solid #f3f4f6; display: flex; justify-content: space-between; align-items: center; }
        .login-overlay { position: relative; }
        .login-blur { filter: blur(3px); pointer-events: none; }
        .login-gate {
            position: absolute; inset: 0;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(2px);
            border-radius: 16px; gap: 12px;
        }
        .login-gate p { font-size: 13px; font-weight: 600; color: var(--green-800); margin: 0; }
        .btn-login-gate {
            padding: 8px 20px; background: var(--green-600);
            color: white; border-radius: 8px; font-size: 13px; font-weight: 600;
            text-decoration: none; transition: background 0.2s;
        }
        .btn-login-gate:hover { background: var(--green-700); color: white; }

        /* CARA KERJA */
        #cara-kerja { background: white; }
        .step-connector {
            position: absolute; top: 35px; left: 60%; right: -40%;
            height: 2px; background: linear-gradient(90deg, var(--green-300, #86efac), var(--green-200));
            z-index: 0;
        }
        .step-wrap { position: relative; }
        .step-num {
            width: 70px; height: 70px; border-radius: 50%;
            background: linear-gradient(135deg, var(--green-500), var(--green-700));
            color: white; font-size: 22px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(22,163,74,0.3);
            position: relative; z-index: 1;
        }
        .step h6 { font-size: 15px; font-weight: 700; color: var(--green-900); margin-bottom: 8px; }
        .step p { font-size: 13px; color: #6b7280; line-height: 1.6; }

        /* TENTANG */
        #tentang { background: linear-gradient(135deg, var(--green-900), var(--green-950)); color: white; }
        #tentang .section-title { color: white; }
        #tentang .section-sub { color: rgba(255,255,255,0.65); }
        .about-check-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px; }
        .check-circle {
            width: 22px; height: 22px; border-radius: 50%;
            background: var(--green-500); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            margin-top: 2px;
        }
        .check-circle i { font-size: 11px; color: white; }
        .about-check-item p { font-size: 14px; color: rgba(255,255,255,0.82); line-height: 1.5; margin: 0; }
        .about-stat-card {
            background: rgba(255,255,255,0.08); border-radius: 14px;
            padding: 24px; text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .about-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 900; color: var(--green-400);
        }
        .about-stat-lbl { font-size: 12px; color: rgba(255,255,255,0.55); margin-top: 4px; }

        /* KONTAK */
        #kontak { background: var(--cream); }
        .contact-icon-box {
            width: 48px; height: 48px; border-radius: 12px;
            background: var(--green-100);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .contact-icon-box i { font-size: 20px; color: var(--green-600); }
        .contact-info-title { font-size: 15px; font-weight: 700; color: var(--green-900); margin-bottom: 2px; }
        .contact-info-text { font-size: 13px; color: #6b7280; margin: 0; }
        .contact-form-card {
            background: white; border-radius: 18px;
            padding: 36px; box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }
        .form-control, .form-control:focus {
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            font-size: 14px; padding: 12px 16px;
            box-shadow: none; font-family: 'DM Sans', sans-serif;
        }
        .form-control:focus { border-color: var(--green-500); }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; }
        .btn-submit {
            width: 100%; padding: 13px;
            background: linear-gradient(135deg, var(--green-600), var(--green-800));
            color: white; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(22,163,74,0.3);
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(22,163,74,0.4); }

        /* FOOTER */
        footer {
            background: var(--green-950);
            padding: 60px 0 0;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px; font-weight: 700; color: white;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 14px;
        }
        .footer-brand .brand-icon { background: rgba(255,255,255,0.15); }
        .footer-desc { font-size: 14px; color: rgba(255,255,255,0.5); line-height: 1.7; max-width: 280px; }
        .footer-heading { font-size: 13px; font-weight: 700; color: white; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { font-size: 14px; color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--green-400); }
        .footer-bottom {
            margin-top: 50px; padding: 20px 0;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 12px;
        }
        .footer-bottom p { font-size: 13px; color: rgba(255,255,255,0.35); margin: 0; }
        .footer-social { display: flex; gap: 12px; }
        .social-btn {
            width: 36px; height: 36px; border-radius: 8px;
            background: rgba(255,255,255,0.08);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.5); text-decoration: none;
            transition: all 0.2s; font-size: 15px;
        }
        .social-btn:hover { background: var(--green-600); color: white; }

        /* ANIMATIONS */
        @keyframes floatUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="brand-icon"><i class="bi bi-flower1"></i></div>
            Sistem Pakar Kopi
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
                <li class="nav-item"><a class="nav-link" href="#cara-kerja">Cara Kerja</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn-nav-outline">Login</a>
                <a href="{{ route('register') }}" class="btn-nav-solid">Register</a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" style="animation: floatUp 0.8s ease both;">
                <div class="hero-badge">
                    <i class="bi bi-patch-check-fill" style="color:var(--green-500);font-size:11px;"></i>
                    Sistem Pakar Berbasis Certainty Factor
                </div>
                <h1>Deteksi <em>Penyakit</em> Tanaman Kopi dengan Tepat</h1>
                <p>Platform cerdas untuk petani kopi Indonesia. Diagnosa penyakit tanaman, baca artikel budidaya, dan dapatkan solusi pengendalian hama secara akurat.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn-hero-primary">Mulai Diagnosa <i class="bi bi-arrow-right ms-1"></i></a>
                    <a href="#cara-kerja" class="btn-hero-secondary">Cara Kerja</a>
                </div>
            </div>
            <div class="col-lg-6 hero-mockup">
                <div class="mockup-card">
                    <div style="font-size:11px;font-weight:700;color:#9ca3af;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:12px;">Hasil Diagnosa</div>
                    <div style="font-size:20px;font-weight:800;color:var(--green-900);margin-bottom:4px;">Penggerek Buah Kopi</div>
                    <div style="font-size:12px;color:#6b7280;margin-bottom:16px;font-style:italic;">Hypothenemus hampei</div>
                    <div style="display:flex;justify-content:space-between;font-size:12px;color:#6b7280;margin-bottom:6px;">
                        <span>Tingkat Kepercayaan</span>
                        <span style="font-weight:700;color:var(--green-600);">87%</span>
                    </div>
                    <div class="cf-bar"><div class="cf-fill"></div></div>
                    <div class="stat-grid">
                        <div class="stat-box"><div class="stat-num">5</div><div class="stat-lbl">Gejala</div></div>
                        <div class="stat-box"><div class="stat-num">3</div><div class="stat-lbl">Solusi</div></div>
                        <div class="stat-box"><div class="stat-num">87%</div><div class="stat-lbl">Akurasi</div></div>
                    </div>
                </div>
                <div class="mockup-mini">
                    <div class="mockup-icon" style="background:var(--green-100);">
                        <i class="bi bi-shield-check" style="font-size:20px;color:var(--green-600);"></i>
                    </div>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:var(--green-900);">Pengendalian Organik</div>
                        <div style="font-size:12px;color:#6b7280;">Perangkap feromon betina</div>
                    </div>
                </div>
                <div class="mockup-mini">
                    <div class="mockup-icon" style="background:#fef3c7;">
                        <i class="bi bi-journal-text" style="font-size:20px;color:#d97706;"></i>
                    </div>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:var(--green-900);">Artikel Terbaru</div>
                        <div style="font-size:12px;color:#6b7280;">Persiapan Lahan Budidaya Kopi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR -->
<section id="fitur">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Fitur Unggulan</span>
            <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
            <p class="section-sub mx-auto" style="max-width:520px;">Dari diagnosa penyakit hingga panduan budidaya, semua tersedia dalam satu platform.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-search"></i></div>
                    <h5>Diagnosa Penyakit</h5>
                    <p>Identifikasi penyakit tanaman kopi secara akurat menggunakan metode Certainty Factor. Pilih gejala dan dapatkan hasil instan.</p>
                    <a href="{{ route('login') }}" class="feature-link">Coba Sekarang <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-book"></i></div>
                    <h5>Artikel Budidaya</h5>
                    <p>Panduan lengkap budidaya kopi dari persiapan lahan hingga panen. Disusun sistematis dan mudah dipahami petani.</p>
                    <a href="{{ route('login') }}" class="feature-link">Baca Artikel <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-bug"></i></div>
                    <h5>Info Hama & Penyakit</h5>
                    <p>Database lengkap hama dan penyakit tanaman kopi beserta cara pengendalian kimia, organik, dan budidaya.</p>
                    <a href="{{ route('login') }}" class="feature-link">Lihat Database <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-clock-history"></i></div>
                    <h5>Riwayat Diagnosa</h5>
                    <p>Simpan dan pantau riwayat diagnosa tanaman kopi kamu. Unduh hasil diagnosa dalam format PDF kapan saja.</p>
                    <a href="{{ route('login') }}" class="feature-link">Lihat Riwayat <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h5>Akurasi Tinggi</h5>
                    <p>Menggunakan algoritma Certainty Factor yang telah terbukti akurat dalam mendeteksi penyakit tanaman kopi.</p>
                    <a href="#cara-kerja" class="feature-link">Pelajari Lebih <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-laptop"></i></div>
                    <h5>Mudah Digunakan</h5>
                    <p>Antarmuka intuitif dan ramah pengguna. Dapat diakses dari perangkat apapun, kapanpun dan dimanapun.</p>
                    <a href="{{ route('register') }}" class="feature-link">Daftar Gratis <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ARTIKEL PREVIEW -->
<section id="artikel">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
            <div>
                <span class="section-label">Konten Terkurasi</span>
                <h2 class="section-title mb-2">Artikel & Informasi</h2>
                <p class="section-sub">Akses artikel lengkap setelah login. Berikut preview konten yang tersedia.</p>
            </div>
            <a href="{{ route('login') }}" class="btn-nav-solid">Login untuk Akses Penuh</a>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="login-overlay h-100">
                    <div class="artikel-card login-blur">
                        <div class="artikel-thumb" style="background:linear-gradient(135deg,#dcfce7,#bbf7d0);">
                            <i class="bi bi-tree" style="color:var(--green-600);"></i>
                        </div>
                        <div class="artikel-body">
                            <span class="artikel-tag" style="color:var(--green-600);">Budidaya</span>
                            <h6>Persiapan Lahan untuk Budidaya Kopi</h6>
                            <p>Panduan lengkap memilih dan menyiapkan lahan yang ideal untuk tanaman kopi berkualitas.</p>
                        </div>
                        <div class="artikel-footer">
                            <span style="font-size:12px;color:#9ca3af;">Panduan Lengkap</span>
                        </div>
                    </div>
                    <div class="login-gate">
                        <p><i class="bi bi-lock-fill me-1"></i> Login untuk membaca</p>
                        <a href="{{ route('login') }}" class="btn-login-gate">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="login-overlay h-100">
                    <div class="artikel-card login-blur">
                        <div class="artikel-thumb" style="background:linear-gradient(135deg,#ffedd5,#fed7aa);">
                            <i class="bi bi-bug" style="color:#ea580c;"></i>
                        </div>
                        <div class="artikel-body">
                            <span class="artikel-tag" style="color:#ea580c;">Hama</span>
                            <h6>Penggerek Buah Kopi (PBKo)</h6>
                            <p>Mengenal hama paling merusak pada tanaman kopi dan cara pengendaliannya secara efektif.</p>
                        </div>
                        <div class="artikel-footer">
                            <span style="font-size:12px;color:#9ca3af;">Info Hama</span>
                        </div>
                    </div>
                    <div class="login-gate">
                        <p><i class="bi bi-lock-fill me-1"></i> Login untuk membaca</p>
                        <a href="{{ route('login') }}" class="btn-login-gate">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="login-overlay h-100">
                    <div class="artikel-card login-blur">
                        <div class="artikel-thumb" style="background:linear-gradient(135deg,#fce7f3,#fbcfe8);">
                            <i class="bi bi-virus" style="color:#db2777;"></i>
                        </div>
                        <div class="artikel-body">
                            <span class="artikel-tag" style="color:#db2777;">Penyakit</span>
                            <h6>Karat Daun Kopi (Coffee Leaf Rust)</h6>
                            <p>Penyakit jamur paling umum pada kopi dan strategi pengendalian yang tepat sasaran.</p>
                        </div>
                        <div class="artikel-footer">
                            <span style="font-size:12px;color:#9ca3af;">Info Penyakit</span>
                        </div>
                    </div>
                    <div class="login-gate">
                        <p><i class="bi bi-lock-fill me-1"></i> Login untuk membaca</p>
                        <a href="{{ route('login') }}" class="btn-login-gate">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section id="cara-kerja">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Cara Penggunaan</span>
            <h2 class="section-title">Mudah dalam 4 Langkah</h2>
            <p class="section-sub mx-auto" style="max-width:480px;">Proses diagnosa yang cepat dan akurat untuk membantu petani kopi.</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3 step reveal">
                <div class="step-wrap">
                    <div class="step-num">1</div>
                    <h6>Daftar Akun</h6>
                    <p>Buat akun gratis dengan email kamu untuk mengakses semua fitur platform.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 step reveal">
                <div class="step-wrap">
                    <div class="step-num">2</div>
                    <h6>Pilih Gejala</h6>
                    <p>Centang gejala yang terlihat pada tanaman kopi kamu dari daftar yang tersedia.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 step reveal">
                <div class="step-wrap">
                    <div class="step-num">3</div>
                    <h6>Analisis Sistem</h6>
                    <p>Sistem menghitung probabilitas menggunakan metode Certainty Factor secara otomatis.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 step reveal">
                <div class="step-wrap">
                    <div class="step-num">4</div>
                    <h6>Terima Hasil</h6>
                    <p>Dapatkan diagnosa lengkap beserta solusi pengendalian dan unduh laporan PDF.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <span class="section-label" style="color:var(--green-400);">Tentang Platform</span>
                <h2 class="section-title">Mengapa Sistem Pakar Kopi?</h2>
                <p class="section-sub">Dikembangkan khusus untuk membantu petani kopi Indonesia mendeteksi dan menangani penyakit tanaman secara cepat dan tepat.</p>
                <div class="mt-4">
                    <div class="about-check-item">
                        <div class="check-circle"><i class="bi bi-check"></i></div>
                        <p>Menggunakan metode Certainty Factor yang telah terbukti akurat dalam sistem pakar</p>
                    </div>
                    <div class="about-check-item">
                        <div class="check-circle"><i class="bi bi-check"></i></div>
                        <p>Database penyakit dan hama tanaman kopi yang lengkap dan terus diperbarui</p>
                    </div>
                    <div class="about-check-item">
                        <div class="check-circle"><i class="bi bi-check"></i></div>
                        <p>Solusi pengendalian berbasis kimia, organik, dan budidaya untuk setiap penyakit</p>
                    </div>
                    <div class="about-check-item">
                        <div class="check-circle"><i class="bi bi-check"></i></div>
                        <p>Dapat diakses kapan saja dan di mana saja melalui browser</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="about-stat-card">
                            <div class="about-stat-num">Certainty Factor</div>
                            <div class="about-stat-lbl">Metode Sistem Pakar yang Digunakan</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-stat-card">
                            <div class="about-stat-num" style="font-size:24px;"><i class="bi bi-search" style="color:var(--green-400);"></i></div>
                            <div class="about-stat-lbl">Diagnosa Akurat</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-stat-card">
                            <div class="about-stat-num" style="font-size:24px;"><i class="bi bi-file-earmark-pdf" style="color:var(--green-400);"></i></div>
                            <div class="about-stat-lbl">Laporan PDF</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="kontak">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5 reveal">
                <span class="section-label">Hubungi Kami</span>
                <h2 class="section-title">Ada Pertanyaan?</h2>
                <p class="section-sub mb-5">Kami siap membantu kamu dalam menggunakan platform Sistem Pakar Kopi.</p>
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="contact-icon-box"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="contact-info-title">Email</div>
                            <p class="contact-info-text">sistempakar.kopi@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="contact-icon-box"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="contact-info-title">Lokasi</div>
                            <p class="contact-info-text">Indonesia</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="contact-icon-box"><i class="bi bi-clock"></i></div>
                        <div>
                            <div class="contact-info-title">Jam Layanan</div>
                            <p class="contact-info-text">Senin - Jumat, 08.00 - 17.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 reveal">
                <div class="contact-form-card">
                    <h5 style="font-size:18px;font-weight:700;color:var(--green-900);margin-bottom:24px;">Kirim Pesan</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama kamu...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="email@contoh.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subjek</label>
                            <input type="text" class="form-control" placeholder="Subjek pesan...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pesan</label>
                            <textarea class="form-control" rows="4" placeholder="Tulis pesanmu di sini..."></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn-submit">Kirim Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand">
                    <div class="brand-icon"><i class="bi bi-flower1" style="color:white;font-size:18px;"></i></div>
                    Sistem Pakar Kopi
                </div>
                <p class="footer-desc">Platform cerdas untuk mendeteksi penyakit tanaman kopi dan memberikan solusi pengendalian yang tepat bagi petani Indonesia.</p>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Fitur</div>
                <ul class="footer-links">
                    <li><a href="{{ route('login') }}">Diagnosa Penyakit</a></li>
                    <li><a href="{{ route('login') }}">Artikel Budidaya</a></li>
                    <li><a href="{{ route('login') }}">Info Hama</a></li>
                    <li><a href="{{ route('login') }}">Riwayat Diagnosa</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Navigasi</div>
                <ul class="footer-links">
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#artikel">Artikel</a></li>
                    <li><a href="#cara-kerja">Cara Kerja</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="footer-heading">Mulai Sekarang</div>
                <p style="font-size:14px;color:rgba(255,255,255,0.5);margin-bottom:16px;">Bergabung dan mulai deteksi penyakit tanaman kopi kamu secara gratis.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" style="padding:10px 20px;border:1.5px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.7);border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;">Login</a>
                    <a href="{{ route('register') }}" style="padding:10px 20px;background:var(--green-600);color:white;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;">Register</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Sistem Pakar Kopi. Hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
        document.querySelector('.navbar').style.boxShadow =
            window.scrollY > 50 ? '0 4px 20px rgba(0,0,0,0.07)' : 'none';
    });
</script>
</body>
</html>