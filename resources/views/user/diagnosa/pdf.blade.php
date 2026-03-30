<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa - {{ $riwayat->id_diagnosis }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11.5px;
            color: #1f2937;
            background: #ffffff;
            line-height: 1.5;
        }

        /* ── HEADER ── */
        .header { background: #1a4d2e; color: white; padding: 22px 28px 18px; }
        .header-top { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .header-top td { vertical-align: top; }

        .badge {
            display: inline-block; padding: 2px 9px; border-radius: 999px;
            font-size: 8.5px; font-weight: bold; text-transform: uppercase;
            letter-spacing: 0.5px; background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25); color: white;
            margin-right: 4px; margin-bottom: 4px;
        }
        .badge-st { background: #dc2626; border-color: #dc2626; color: #fff; }
        .badge-t  { background: #f97316; border-color: #f97316; color: #fff; }
        .badge-s  { background: #fde047; border-color: #fde047; color: #713f12; }
        .badge-r  { background: #bbf7d0; border-color: #bbf7d0; color: #14532d; }

        .disease-name  { font-size: 19px; font-weight: bold; color: #fff; margin: 8px 0 2px; }
        .disease-latin { font-style: italic; font-size: 10px; color: rgba(255,255,255,0.6); }
        .meta-date     { text-align: right; font-size: 9.5px; color: rgba(255,255,255,0.55); }
        .meta-id       { font-size: 8px; color: rgba(255,255,255,0.3); margin-top: 4px; }

        .cf-box { background: rgba(0,0,0,0.22); border-radius: 9px; padding: 10px 14px; }
        .cf-inner { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        .cf-label { font-size: 10px; color: rgba(255,255,255,0.75); }
        .cf-value { font-size: 20px; font-weight: bold; color: #fff; text-align: right; }
        .cf-track { background: rgba(0,0,0,0.3); border-radius: 999px; height: 8px; width: 100%; }
        .cf-fill  { background: #ffffff; border-radius: 999px; height: 8px; }
        .cf-ticks { width: 100%; border-collapse: collapse; margin-top: 2px; }
        .cf-ticks td { font-size: 8px; color: rgba(255,255,255,0.35); }

        /* ── CONTENT ── */
        .content { padding: 18px 28px; }

        /* two-col layout */
        .two-col { width: 100%; border-collapse: separate; border-spacing: 10px 0; }
        .two-col td { vertical-align: top; }
        .col-left  { width: 38%; }
        .col-right { width: 62%; }

        /* section wrapper */
        .section { margin-bottom: 14px; }

        .section-title {
            font-size: 10px; font-weight: bold; text-transform: uppercase;
            letter-spacing: 0.07em; color: #374151;
            padding-bottom: 5px; margin-bottom: 8px;
            border-bottom: 2px solid #d1fae5;
            display: flex; align-items: center; gap: 5px;
        }
        .section-title-bar {
            display: inline-block; width: 3px; height: 12px;
            background: #2d7a4f; border-radius: 2px;
            margin-right: 4px; vertical-align: middle;
        }

        /* info grid */
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table tr td { padding: 5px 6px; font-size: 10.5px; border-bottom: 1px solid #f3f4f6; }
        .info-table tr:last-child td { border-bottom: none; }
        .info-table td:first-child { color: #6b7280; width: 42%; }
        .info-table td:last-child  { font-weight: 600; color: #111827; }
        .val-green { color: #16a34a !important; }
        .val-blue  { color: #2563eb !important; }

        /* desc */
        .desc-box { background: #f9fafb; border-radius: 7px; padding: 10px; font-size: 10.5px; color: #4b5563; line-height: 1.6; }

        /* gejala */
        .gejala-item {
            display: block; background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 5px; padding: 3px 8px 3px 6px;
            font-size: 10px; color: #166534; margin-bottom: 3px;
        }
        .gejala-check { color: #16a34a; font-weight: bold; margin-right: 3px; }

        /* pengendalian */
        .ctrl-table { width: 100%; border-collapse: separate; border-spacing: 5px; }
        .ctrl-table td { vertical-align: top; width: 50%; padding: 9px 10px; border-radius: 7px; font-size: 10px; line-height: 1.55; }
        .ctrl-label { font-weight: bold; font-size: 9.5px; margin-bottom: 4px; }
        .ctrl-pencegahan { background: #eff6ff; color: #1e40af; }
        .ctrl-kimia      { background: #fff7ed; color: #c2410c; }
        .ctrl-organik    { background: #f0fdf4; color: #15803d; }
        .ctrl-budidaya   { background: #fefce8; color: #a16207; }

        /* kemungkinan */
        .kemung-table { width: 100%; border-collapse: collapse; }
        .kemung-table thead tr { background: #f3f4f6; }
        .kemung-table th { padding: 6px 8px; text-align: left; font-size: 9px; font-weight: bold; color: #6b7280; text-transform: uppercase; }
        .kemung-table td { padding: 7px 8px; font-size: 10.5px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .kemung-table tr:last-child td { border-bottom: none; }
        .rank-circle { display: inline-block; width: 20px; height: 20px; border-radius: 50%; text-align: center; line-height: 20px; font-size: 9px; font-weight: bold; color: white; }
        .rank-1     { background: #16a34a; }
        .rank-other { background: #9ca3af; }
        .mini-track { background: #e5e7eb; border-radius: 999px; height: 5px; width: 100%; }
        .mini-fill  { border-radius: 999px; height: 5px; }

        /* relasi */
        .relasi-table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
        .relasi-table th { background: #f9fafb; padding: 6px 7px; font-size: 8.5px; font-weight: bold; color: #6b7280; border: 1px solid #e5e7eb; text-align: center; }
        .relasi-table th:first-child { text-align: left; }
        .relasi-table td { padding: 5px 7px; border: 1px solid #f3f4f6; text-align: center; }
        .relasi-table td:first-child { text-align: left; }
        .relasi-table tr:nth-child(even) { background: #f9fafb; }
        .check-yes { color: #16a34a; font-weight: bold; font-size: 12px; }
        .check-no  { color: #d1d5db; font-size: 12px; }

        /* ── FOOTER ── */
        .footer { margin-top: 20px; background: #f0fdf4; border-top: 2px solid #d1fae5; }
        .footer-table { width: 100%; border-collapse: collapse; }
        .footer-table td { padding: 10px 28px; font-size: 8.5px; vertical-align: middle; }
        .footer-note  { color: #6b7280; font-style: italic; }
        .footer-id    { color: #16a34a; font-weight: bold; text-align: right; }
    </style>
</head>
<body>

{{-- ── HEADER ── --}}
<div class="header">
    <table class="header-top">
        <tr>
            <td>
                {{-- Badges --}}
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
            <td style="text-align:right; vertical-align:top;">
                <div class="meta-date">
                    {{ $riwayat->tanggal->format('d M Y') }}<br>
                    {{ $riwayat->tanggal->format('H:i') }} WIB
                </div>
                <div class="meta-id">ID: {{ $riwayat->id_diagnosis }}</div>
            </td>
        </tr>
    </table>

    {{-- CF bar --}}
    <div class="cf-box">
        <table class="cf-inner">
            <tr>
                <td class="cf-label">Tingkat Kepercayaan (Certainty Factor)</td>
                <td class="cf-value">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</td>
            </tr>
        </table>
        <div class="cf-track">
            <div class="cf-fill" style="width:{{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
        </div>
        <table class="cf-ticks">
            <tr>
                <td>0%</td>
                <td style="text-align:center;">50%</td>
                <td style="text-align:right;">100%</td>
            </tr>
        </table>
    </div>
</div>

{{-- ── CONTENT ── --}}
<div class="content">

    {{-- Solusi / Pengendalian --}}
    @if($riwayat->penyakit?->pengendalian_pencegahan || $riwayat->penyakit?->pengendalian_kimia || $riwayat->penyakit?->pengendalian_organik || $riwayat->penyakit?->pengendalian_budidaya)
        <div class="section">
            <div class="section-title"><span class="section-title-bar"></span>Solusi &amp; Cara Pengendalian</div>
            <table class="ctrl-table">
                <tr>
                    @if($riwayat->penyakit?->pengendalian_pencegahan)
                        <td class="ctrl-pencegahan">
                            <div class="ctrl-label">Pencegahan</div>
                            {{ $riwayat->penyakit->pengendalian_pencegahan }}
                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_kimia)
                        <td class="ctrl-kimia">
                            <div class="ctrl-label">Pengendalian Kimia</div>
                            {{ $riwayat->penyakit->pengendalian_kimia }}
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    @if($riwayat->penyakit?->pengendalian_organik)
                        <td class="ctrl-organik">
                            <div class="ctrl-label">Pengendalian Organik</div>
                            {{ $riwayat->penyakit->pengendalian_organik }}
                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_budidaya)
                        <td class="ctrl-budidaya">
                            <div class="ctrl-label">Pengendalian Budidaya</div>
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
                        <th style="width:52px; text-align:right;">Akurasi</th>
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
            <p style="font-size:8px; color:#9ca3af; margin-top:5px;">&#x2713; = gejala terkait penyakit &nbsp;|&nbsp; &#x2717; = tidak terkait</p>
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