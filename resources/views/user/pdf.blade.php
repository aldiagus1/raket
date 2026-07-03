<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0d6efd; padding-bottom: 10px; margin-bottom: 20px; }
        .title { color: #0d6efd; margin: 0; font-size: 24px; }
        .subtitle { margin: 5px 0 0 0; color: #666; font-size: 14px; }
        .brand-badge { background-color: #e3f2fd; color: #0d6efd; padding: 4px 10px; font-weight: bold; font-size: 12px; border-radius: 4px; display: inline-block; text-transform: uppercase; }
        .table-spec { width: 100%; border-collapse: collapse; margin-top: 25px; }
        .table-spec th, .table-spec td { border: 1px solid #dee2e6; padding: 10px; text-align: left; font-size: 13px; }
        .table-spec th { background-color: #f8f9fa; color: #333; font-weight: bold; }
        .chart-box { text-align: center; margin-top: 20px; padding: 10px; border: 1px dashed #ccc; border-radius: 10px; background: #fafafa; }
    </style>
</head>
<body>

    <div class="header">
        <h2 class="title">SMASHZONE BADMINTON RACKET</h2>
        <p class="subtitle">Lembar Spesifikasi & Analisis Performa Resmi</p>
    </div>
    
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 60%; vertical-align: top; border: none;">
                <span class="brand-badge">{{ $raket->brand }}</span>
                <h3 style="margin: 10px 0 5px 0; font-size: 20px; color: #222;">{{ $raket->nama_raket }}</h3>
                <p style="font-size: 13px; color: #555; line-height: 1.6; margin-top: 10px;">
                    <strong>Deskripsi:</strong><br>
                    {{ $raket->deskripsi }}
                </p>
            </td>
            <td style="width: 40%; text-align: right; vertical-align: top; border: none;">
                @if($raket->gambar && file_exists(public_path('storage/' . $raket->gambar)))
                    <img src="{{ public_path('storage/' . $raket->gambar) }}" style="width: 150px; max-height: 180px; border: 1px solid #eee; padding: 5px; border-radius: 8px;">
                @endif
            </td>
        </tr>
    </table>

    <h4 style="margin-top: 25px; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Analisis Parameter Performa</h4>
    
    <table style="width: 100%; border: none; margin-top: 10px;">
        <tr>
            <td style="width: 50%; vertical-align: middle; border: none;">
                <table class="table-spec" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Aspek Penilaian</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Power</strong></td><td>{{ $raket->power }} / 100</td></tr>
                        <tr><td><strong>Control</strong></td><td>{{ $raket->control }} / 100</td></tr>
                        <tr><td><strong>Speed</strong></td><td>{{ $raket->speed }} / 100</td></tr>
                        <tr><td><strong>Durability</strong></td><td>{{ $raket->durability }} / 100</td></tr>
                        <tr><td><strong>Flexibility</strong></td><td>{{ $raket->flexibility }} / 100</td></tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: middle; border: none;">
                <div class="chart-box">
                    <img src="{{ $chartUrl }}" style="width: 250px; height: 250px;">
                </div>
            </td>
        </tr>
    </table>

    <div style="margin-top: 40px; text-align: center; font-size: 11px; color: #999;">
        Dokumen ini dihasilkan secara otomatis oleh sistem komputer SmashZone pada tanggal {{ date('d-m-Y') }}.
    </div>

</body>
</html>