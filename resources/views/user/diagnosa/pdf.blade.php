<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa - {{ $riwayat->id_diagnosis }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1f2937; background: #ffffff; line-height: 1.5; }

        .header { background: #16a34a; color: white; padding: 24px 30px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 9px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; background: #15803d; color: white; }
        .badge-danger-sangat-tinggi { background: #dc2626; color: white; }
        .badge-danger-tinggi { background: #f97316; color: white; }
        .badge-danger-sedang { background: #facc15; color: #713f12; }
        .badge-danger-rendah { background: #bbf7d0; color: #14532d; }
        .nama-latin { font-style: italic; font-size: 11px; color: #bbf7d0; }
        .tanggal-box { text-align: right; font-size: 10px; color: #bbf7d0; }

        .cf-box { background: #15803d; border-radius: 10px; padding: 12px 16px; margin-top: 12px; }
        .cf-bar-bg { background: #166534; border-radius: 999px; height: 10px; width: 100%; }
        .cf-bar-fill { background: white; border-radius: 999px; height: 10px; }

        .content { padding: 20px 30px; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 12px; font-weight: bold; color: #374151; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 2px solid #d1fae5; }

        .info-grid { width: 100%; border-collapse: collapse; }
        .info-grid td { padding: 6px 10px; font-size: 11px; border-bottom: 1px solid #f3f4f6; }
        .info-grid td:first-child { color: #6b7280; width: 35%; }
        .info-grid td:last-child { font-weight: 600; color: #111827; }

        .deskripsi-box { background: #f9fafb; border-radius: 8px; padding: 12px; font-size: 11px; color: #4b5563; line-height: 1.6; }

        .pengendalian-grid { width: 100%; border-collapse: separate; border-spacing: 6px; }
        .pengendalian-grid td { vertical-align: top; width: 50%; padding: 10px; border-radius: 8px; font-size: 10px; line-height: 1.5; }
        .p-pencegahan { background: #eff6ff; color: #1d4ed8; }
        .p-kimia      { background: #fff7ed; color: #c2410c; }
        .p-organik    { background: #f0fdf4; color: #15803d; }
        .p-budidaya   { background: #fefce8; color: #a16207; }
        .pengendalian-label { font-weight: bold; font-size: 10px; margin-bottom: 4px; }

        .gejala-item { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 4px 10px; font-size: 10px; color: #166534; margin-bottom: 4px; display: block; }

        .kemungkinan-table { width: 100%; border-collapse: collapse; }
        .kemungkinan-table thead tr { background: #f3f4f6; }
        .kemungkinan-table th { padding: 7px 10px; text-align: left; font-size: 10px; font-weight: bold; color: #6b7280; text-transform: uppercase; }
        .kemungkinan-table td { padding: 8px 10px; font-size: 11px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .rank-badge { display: inline-block; width: 22px; height: 22px; border-radius: 50%; text-align: center; line-height: 22px; font-size: 10px; font-weight: bold; color: white; }
        .rank-1     { background: #16a34a; }
        .rank-other { background: #9ca3af; }
        .mini-bar-bg  { background: #e5e7eb; border-radius: 999px; height: 6px; width: 100%; }
        .mini-bar-fill{ border-radius: 999px; height: 6px; }

        .relasi-table { width: 100%; border-collapse: collapse; font-size: 10px; }
        .relasi-table th { background: #f9fafb; padding: 7px 8px; font-size: 9px; font-weight: bold; color: #6b7280; border: 1px solid #e5e7eb; text-align: center; }
        .relasi-table th:first-child { text-align: left; }
        .relasi-table td { padding: 6px 8px; border: 1px solid #f3f4f6; text-align: center; }
        .relasi-table td:first-child { text-align: left; }
        .relasi-table tr:nth-child(even) { background: #f9fafb; }
        .check-yes { color: #16a34a; font-weight: bold; font-size: 13px; }
        .check-no  { color: #d1d5db; font-size: 13px; }

        .two-col { width: 100%; border-collapse: separate; border-spacing: 12px; }
        .two-col td { vertical-align: top; width: 50%; }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td style="vertical-align:top;">
                <div style="margin-bottom:8px;">
                    <span class="badge">&#x1F52C; Penyakit Terdeteksi</span>
                    @if($riwayat->penyakit?->tingkat_bahaya)
                        @php
                            $badgeClass = match($riwayat->penyakit->tingkat_bahaya) {
                                'Sangat Tinggi' => 'badge-danger-sangat-tinggi',
                                'Tinggi'        => 'badge-danger-tinggi',
                                'Sedang'        => 'badge-danger-sedang',
                                default         => 'badge-danger-rendah',
                            };
                        @endphp
                        &nbsp;<span class="badge {{ $badgeClass }}">&#x26A0; {{ $riwayat->penyakit->tingkat_bahaya }}</span>
                    @endif
                </div>
                <div style="font-size:20px; font-weight:bold; color:white; margin-bottom:2px;">
                    {{ $riwayat->penyakit->nama_penyakit ?? 'Tidak Teridentifikasi' }}
                </div>
                @if($riwayat->penyakit?->nama_latin)
                    <div class="nama-latin">{{ $riwayat->penyakit->nama_latin }}</div>
                @endif
            </td>
            <td style="vertical-align:top; text-align:right;">
                <div class="tanggal-box">
                    <div>{{ $riwayat->tanggal->format('d M Y') }}</div>
                    <div>{{ $riwayat->tanggal->format('H:i') }} WIB</div>
                    <div style="margin-top:4px; font-size:9px; color:#bbf7d0;">ID: {{ $riwayat->id_diagnosis }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="cf-box">
        <table style="width:100%; border-collapse:collapse; margin-bottom:6px;">
            <tr>
                <td style="font-size:11px; color:#bbf7d0;">Tingkat Kepercayaan</td>
                <td style="font-size:22px; font-weight:bold; color:white; text-align:right;">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</td>
            </tr>
        </table>
        <div class="cf-bar-bg">
            <div class="cf-bar-fill" style="width: {{ round($riwayat->cf_tertinggi * 100, 1) }}%;"></div>
        </div>
        <table style="width:100%; border-collapse:collapse; margin-top:3px;">
            <tr>
                <td style="font-size:9px; color:#bbf7d0;">0%</td>
                <td style="font-size:9px; color:#bbf7d0; text-align:center;">50%</td>
                <td style="font-size:9px; color:#bbf7d0; text-align:right;">100%</td>
            </tr>
        </table>
    </div>
</div>

{{-- CONTENT --}}
<div class="content">

    <table class="two-col">
        <tr>
            <td>
                <div class="section">
                    <div class="section-title">Info Diagnosa</div>
                    <table class="info-grid">
                        <tr><td>Tanggal</td><td>{{ $riwayat->tanggal->format('d F Y') }}</td></tr>
                        <tr><td>Waktu</td><td>{{ $riwayat->tanggal->format('H:i') }} WIB</td></tr>
                        <tr><td>Jumlah Gejala</td><td style="color:#2563eb;">{{ count($riwayat->gejala_input) }} gejala</td></tr>
                        <tr><td>CF Tertinggi</td><td style="color:#16a34a;">{{ round($riwayat->cf_tertinggi * 100, 1) }}%</td></tr>
                        <tr><td>Tingkat Bahaya</td><td>{{ $riwayat->penyakit?->tingkat_bahaya ?? '-' }}</td></tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="section">
                    <div class="section-title">Gejala Dipilih</div>
                    @foreach($gejalaInput as $gejala)
                        <span class="gejala-item">&#x2713; {{ $gejala->nama_gejala }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>

    @if($riwayat->penyakit?->deskripsi_singkat)
        <div class="section">
            <div class="section-title">Deskripsi Penyakit</div>
            <div class="deskripsi-box">{{ $riwayat->penyakit->deskripsi_singkat }}</div>
        </div>
    @endif

    @if($riwayat->penyakit?->pengendalian_pencegahan || $riwayat->penyakit?->pengendalian_kimia || $riwayat->penyakit?->pengendalian_organik || $riwayat->penyakit?->pengendalian_budidaya)
        <div class="section">
            <div class="section-title">Cara Pengendalian</div>
            <table class="pengendalian-grid">
                <tr>
                    @if($riwayat->penyakit?->pengendalian_pencegahan)
                        <td class="p-pencegahan">
                            <div class="pengendalian-label">Pencegahan</div>
                            {{ $riwayat->penyakit->pengendalian_pencegahan }}
                        </td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_kimia)
                        <td class="p-kimia">
                            <div class="pengendalian-label">Pengendalian Kimia</div>
                            {{ $riwayat->penyakit->pengendalian_kimia }}
                        </td>
                    @endif
                </tr>
                <tr>
                    @if($riwayat->penyakit?->pengendalian_organik)
                        <td class="p-organik">
                            <div class="pengendalian-label">Pengendalian Organik</div>
                            {{ $riwayat->penyakit->pengendalian_organik }}
                        </td>
                    @endif
                    @if($riwayat->penyakit?->pengendalian_budidaya)
                        <td class="p-budidaya">
                            <div class="pengendalian-label">Pengendalian Budidaya</div>
                            {{ $riwayat->penyakit->pengendalian_budidaya }}
                        </td>
                    @endif
                </tr>
            </table>
        </div>
    @endif

    @if($riwayat->hasil_diagnosa && count($riwayat->hasil_diagnosa) > 1)
        <div class="section">
            <div class="section-title">Semua Kemungkinan Penyakit</div>
            <table class="kemungkinan-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Nama Penyakit</th>
                        <th style="width:60px; text-align:right;">CF</th>
                        <th style="width:120px;">Grafik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat->hasil_diagnosa as $index => $hasil)
                        <tr>
                            <td><span class="rank-badge {{ $index === 0 ? 'rank-1' : 'rank-other' }}">{{ $index + 1 }}</span></td>
                            <td style="{{ $index === 0 ? 'font-weight:bold; color:#166534;' : 'color:#374151;' }}">{{ $hasil['nama_penyakit'] }}</td>
                            <td style="text-align:right; font-weight:bold; color:{{ $index === 0 ? '#16a34a' : '#6b7280' }};">{{ $hasil['persentase'] }}%</td>
                            <td>
                                <div class="mini-bar-bg">
                                    <div class="mini-bar-fill" style="width:{{ $hasil['persentase'] }}%; background:{{ $index === 0 ? '#16a34a' : '#9ca3af' }};"></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($relasiGejala->count() > 0)
        <div class="section">
            <div class="section-title">Relasi Gejala &amp; Penyakit</div>
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
            <p style="font-size:9px; color:#9ca3af; margin-top:6px;">&#x2713; = gejala terkait penyakit tersebut &nbsp;|&nbsp; &#x2717; = tidak terkait</p>
        </div>
    @endif

</div>

{{-- FOOTER --}}
<table style="width:100%; border-collapse:collapse; margin-top:24px; background:#f0fdf4; border-top:2px solid #d1fae5;">
    <tr>
        <td style="padding:12px 30px; font-size:9px; color:#6b7280; font-style:italic; vertical-align:middle;">
            Dokumen ini digenerate otomatis oleh sistem pakar diagnosa penyakit tanaman kopi.<br>
            Hasil diagnosa bersifat prediktif. Konsultasikan dengan ahli pertanian untuk penanganan lebih lanjut.
        </td>
        <td style="padding:12px 30px; font-size:9px; color:#16a34a; font-weight:bold; text-align:right; vertical-align:middle;">
            ID: {{ $riwayat->id_diagnosis }}<br>
            {{ now()->format('d/m/Y H:i') }}
        </td>
    </tr>
</table>

</body>
</html>