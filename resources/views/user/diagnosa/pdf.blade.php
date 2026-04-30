<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa - {{ $riwayat->id_diagnosis }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #0f1f14;
            background: #ffffff;
            line-height: 1.5;
        }

        /* ── BANNER ── */
        .banner { background: #1a4d2e; color: white; padding: 22px 28px 20px; }

        .badge {
            display: inline-block; padding: 2px 9px; border-radius: 999px;
            font-size: 8px; font-weight: bold; text-transform: uppercase;
            letter-spacing: 0.5px; background: rgba(255,255,255,0.13);
            border: 1px solid rgba(255,255,255,0.22); color: rgba(255,255,255,.9);
            margin-right: 4px; margin-bottom: 6px;
        }
        .badge-st { background: #dc2626; border-color: #dc2626; color: #fff; }
        .badge-t  { background: #ea580c; border-color: #ea580c; color: #fff; }
        .badge-s  { background: #ca8a04; border-color: #ca8a04; color: #fff; }
        .badge-r  { background: rgba(106,173,94,.25); border-color: rgba(106,173,94,.4); color: #a3e09a; }

        .disease-name  { font-size: 20px; font-weight: bold; color: #fff; margin: 8px 0 3px; line-height: 1.2; }
        .disease-latin { font-style: italic; font-size: 10px; color: rgba(255,255,255,0.45); margin-bottom: 6px; }
        .meta-date     { text-align: right; font-size: 9px; color: rgba(255,255,255,0.55); }
        .meta-time     { font-size: 8.5px; color: rgba(255,255,255,.35); margin-top: 2px; }
        .meta-id       { font-size: 7.5px; color: rgba(255,255,255,0.25); margin-top: 5px; }

        .cf-box   { background: rgba(0,0,0,0.22); border-radius: 9px; padding: 10px 14px; margin-top: 14px; }
        .cf-lbl   { font-size: 8.5px; color: rgba(255,255,255,.55); text-transform: uppercase; letter-spacing: .05em; }
        .cf-val   { font-size: 22px; font-weight: bold; color: #fff; text-align: right; line-height: 1; }
        .cf-track { background: rgba(0,0,0,0.3); border-radius: 999px; height: 7px; }
        .cf-fill  { background: #ffffff; border-radius: 999px; height: 7px; }
        .cf-tick  { font-size: 7.5px; color: rgba(255,255,255,.3); }

        /* ── CONTENT ── */
        .content { padding: 18px 28px; }

        .section { margin-bottom: 16px; }
        .section-title {
            font-size: 9.5px; font-weight: bold; text-transform: uppercase;
            letter-spacing: .07em; color: #374151;
            padding-bottom: 5px; margin-bottom: 9px;
            border-bottom: 2px solid #d1fae5;
        }
        .section-title-bar {
            display: inline-block; width: 3px; height: 12px;
            background: #2d7a4f; border-radius: 2px;
            margin-right: 5px; vertical-align: middle;
        }

        /* Deskripsi */
        .desc-box {
            background: #f9fafb; border-radius: 7px; padding: 10px 12px;
            font-size: 10.5px; color: #4b5563; line-height: 1.65;
        }

        /* Pengendalian */
        .ctrl-table { width: 100%; border-collapse: separate; border-spacing: 5px; }
        .ctrl-table td { vertical-align: top; width: 50%; padding: 9px 10px; border-radius: 7px; font-size: 10px; line-height: 1.55; }
        .ctrl-label { font-weight: bold; font-size: 9px; margin-bottom: 4px; display: block; }
        .ctrl-pencegahan { background: #eff6ff; color: #1e40af; }
        .ctrl-kimia      { background: #fff7ed; color: #c2410c; }
        .ctrl-organik    { background: #f0fdf4; color: #15803d; }
        .ctrl-budidaya   { background: #fefce8; color: #a16207; }

        /* Kemungkinan */
        .kemung-table { width: 100%; border-collapse: collapse; }
        .kemung-table thead tr { background: #f3f4f6; }
        .kemung-table th { padding: 6px 8px; text-align: left; font-size: 8.5px; font-weight: bold; color: #6b7280; text-transform: uppercase; letter-spacing: .04em; }
        .kemung-table td { padding: 7px 8px; font-size: 10.5px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .kemung-table tr:last-child td { border-bottom: none; }
        .rank-circle { display: inline-block; width: 20px; height: 20px; border-radius: 50%; text-align: center; line-height: 20px; font-size: 8.5px; font-weight: bold; color: white; }
        .rank-1     { background: #16a34a; }
        .rank-other { background: #9ca3af; }
        .mini-track { background: #e5e7eb; border-radius: 999px; height: 5px; width: 100%; }
        .mini-fill  { border-radius: 999px; height: 5px; }

        /* Relasi */
        .relasi-table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
        .relasi-table th { background: #f9fafb; padding: 6px 7px; font-size: 8px; font-weight: bold; color: #6b7280; border: 1px solid #e5e7eb; text-align: center; }
        .relasi-table th:first-child { text-align: left; }
        .relasi-table td { padding: 5px 7px; border: 1px solid #f3f4f6; text-align: center; }
        .relasi-table td:first-child { text-align: left; }
        .relasi-table tr:nth-child(even) { background: #f9fafb; }
        .check-yes { color: #16a34a; font-weight: bold; font-size: 12px; }
        .check-no  { color: #d1d5db; font-size: 12px; }

        /* Footer */
        .footer { margin-top: 20px; background: #f0fdf4; border-top: 2px solid #d1fae5; }
        .footer-table { width: 100%; border-collapse: collapse; }
        .footer-table td { padding: 10px 28px; font-size: 8px; vertical-align: middle; }
        .footer-note { color: #6b7280; font-style: italic; }
        .footer-id   { color: #16a34a; font-weight: bold; text-align: right; }
    </style>
</head>
<body>

{{-- ── BANNER ── --}}
<div class="banner">
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td style="vertical-align:top;">
                <span class="badge">Penyakit Terdeteksi</span>
                @if($riwayat->penyakit?->tingkat_bahaya)
                    @php
                        $bc = match($riwayat->penyakit->tingkat_bahaya) {
                            'Sangat Tinggi' => 'badge-st',
                            'Tinggi'        => 'badge-t',
                            'Sedang'        => 'badge-s',
                            default         => 'badge-r',
                        };
                    @endphp
                    <span class="badge {{ $bc }}">{{ $riwayat->penyakit->tingkat_bahaya }}</span>
                @endif
                <div class="disease-name">{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}</div>
                @if($riwayat->penyakit?->nama_latin)
                    <div class="disease-latin">{{ $riwayat->penyakit->nama_latin }}</div>
                @endif
            </td>
            <td style="text-align:right; vertical-align:top; white-space:nowrap;">
                <div class="meta-date">{{ $riwayat->tanggal->format('d M Y') }}</div>
                <div class="meta-time">{{ $riwayat->tanggal->format('H:i') }} WIB</div>
                <div class="meta-id">{{ $riwayat->id_diagnosis }}</div>
            </td>
        </tr>
    </table>

    <div class="cf-box">
        <table style="width:100%; border-collapse:collapse; margin-bottom:6px;">
            <tr>
                <td class="cf-lbl">Certainty Factor</td>
                <td class="cf-val">{{ round($riwayat->cf_tertinggi * 100, 1) }}<span style="font-size:13px; opacity:.6;">%</span></td>
            </tr>
        </table>
        <div class="cf-track">
            <div class="cf-fill" style="width:{{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
        </div>
        <table style="width:100%; border-collapse:collapse; margin-top:3px;">
            <tr>
                <td class="cf-tick">0%</td>
                <td class="cf-tick" style="text-align:center;">50%</td>
                <td class="cf-tick" style="text-align:right;">100%</td>
            </tr>
        </table>
    </div>
</div>

{{-- ── CONTENT ── --}}
<div class="content">

    {{-- Tentang Penyakit --}}
    @if($riwayat->penyakit?->deskripsi_singkat)
        <div class="section">
            <div class="section-title"><span class="section-title-bar"></span>Tentang Penyakit</div>
            <div class="desc-box">{{ $riwayat->penyakit->deskripsi_singkat }}</div>
        </div>
    @endif

    {{-- Solusi & Pengendalian --}}
    @if($riwayat->penyakit?->pengendalian_pencegahan || $riwayat->penyakit?->pengendalian_kimia || $riwayat->penyakit?->pengendalian_organik || $riwayat->penyakit?->pengendalian_budidaya)
        <div class="section">
            <div class="section-title"><span class="section-title-bar"></span>Solusi &amp; Cara Pengendalian</div>
            <table class="ctrl-table">
                <tr>
                    @if($riwayat->penyakit?->pengendalian_pencegahan)
                        <td class="ctrl-pencegahan">
                            <span class="ctrl-label">Pencegahan</span>
                            {{ $riwayat->penyakit->pengendalian_pencegahan }}
                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_kimia)
                        <td class="ctrl-kimia">
                            <span class="ctrl-label">Pengendalian Kimia</span>
                            {{ $riwayat->penyakit->pengendalian_kimia }}
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    @if($riwayat->penyakit?->pengendalian_organik)
                        <td class="ctrl-organik">
                            <span class="ctrl-label">Pengendalian Organik</span>
                            {{ $riwayat->penyakit->pengendalian_organik }}
                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_budidaya)
                        <td class="ctrl-budidaya">
                            <span class="ctrl-label">Pengendalian Budidaya</span>
                            {{ $riwayat->penyakit->pengendalian_budidaya }}
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            </table>
        </div>
    @endif

    {{-- Semua Kemungkinan Penyakit --}}
    @if($riwayat->hasil_diagnosa && count($riwayat->hasil_diagnosa) > 1)
        <div class="section">
            <div class="section-title"><span class="section-title-bar"></span>Semua Kemungkinan Penyakit</div>
            <table class="kemung-table">
                <thead>
                    <tr>
                        <th style="width:32px;">#</th>
                        <th>Nama Penyakit</th>
                        <th style="width:55px; text-align:right;">Akurasi</th>
                        <th style="width:110px;">Grafik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat->hasil_diagnosa as $index => $hasil)
                        <tr>
                            <td><span class="rank-circle {{ $index === 0 ? 'rank-1' : 'rank-other' }}">{{ $index + 1 }}</span></td>
                            <td style="{{ $index === 0 ? 'font-weight:bold; color:#166534;' : 'color:#374151;' }}">{{ $hasil['nama_penyakit'] }}</td>
                            <td style="text-align:right; font-weight:bold; color:{{ $index === 0 ? '#16a34a' : '#6b7280' }};">{{ $hasil['persentase'] }}%</td>
                            <td>
                                <div class="mini-track">
                                    <div class="mini-fill" style="width:{{ $hasil['persentase'] }}%; background:{{ $index === 0 ? '#16a34a' : '#9ca3af' }};"></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Relasi Gejala --}}
    @if($relasiGejala->count() > 0)
        <div class="section">
            <div class="section-title"><span class="section-title-bar"></span>Relasi Gejala &amp; Penyakit</div>
            <table class="relasi-table">
                <thead>
                    <tr>
                        <th>Gejala</th>
                        @foreach($riwayat->hasil_diagnosa as $hasil)
                            <th>
                                {{ $hasil['nama_penyakit'] }}<br>
                                <span style="color:#16a34a; text-transform:none; letter-spacing:0;">{{ $hasil['persentase'] }}%</span>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($gejalaInput as $gejala)
                        <tr>
                            <td>{{ $gejala->nama_gejala }}</td>
                            @foreach($riwayat->hasil_diagnosa as $hasil)
                                <td>
                                    @if(isset($relasiGejala[$hasil['id_penyakit']]) &&
                                        $relasiGejala[$hasil['id_penyakit']]->contains('id_gejala', $gejala->id_gejala))
                                        <span class="check-yes">&#x2713;</span>
                                    @else
                                        <span class="check-no">&#x2717;</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="font-size:8px; color:#9ca3af; margin-top:5px;">&#x2713; = gejala terkait &nbsp;|&nbsp; &#x2717; = tidak terkait</p>
        </div>
    @endif

</div>

{{-- ── FOOTER ── --}}
<div class="footer">
    <table class="footer-table">
        <tr>
            <td class="footer-note">
                Dokumen ini digenerate otomatis oleh sistem pakar diagnosa penyakit tanaman kopi.<br>
                Hasil diagnosa bersifat prediktif. Konsultasikan dengan ahli pertanian untuk penanganan lebih lanjut.
            </td>
            <td class="footer-id">
                ID: {{ $riwayat->id_diagnosis }}<br>
                {{ now()->format('d/m/Y H:i') }}
            </td>
        </tr>
    </table>
</div>

</body>
</html>