<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Peserta</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2563eb;
        }

        .header h2 {
            margin: 0;
            color: #1e293b;
            font-size: 18pt;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 11pt;
        }

        .text-right {
            text-align: right;
            margin-bottom: 10px;
            font-size: 10pt;
            color: #64748b;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            text-align: left;
        }

        .table th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10pt;
            letter-spacing: 0.5px;
        }

        .table tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        .badge {
            font-weight: bold;
        }

        .badge-none {
            color: #ef4444;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10pt;
        }

        .footer p {
            margin: 0;
        }

        .footer-signature {
            margin-top: 60px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Data Peserta Kursus</h2>
        <p>Sistem Pendaftaran Kursus - Dicetak pada {{ date('d F Y') }}</p>
    </div>

    <div class="text-right">
        Total Peserta: <strong>{{ $peserta->count() }} orang</strong>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID Peserta</th>
                <th width="20%">Nama Lengkap</th>
                <th width="10%">JK</th>
                <th width="20%">Jurusan Terdaftar</th>
                <th width="15%">No HP</th>
                <th width="15%">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peserta as $index => $p)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td><strong>{{ $p->id_peserta }}</strong></td>
                    <td>{{ $p->nm_peserta }}</td>
                    <td style="text-align: center;">{{ $p->jekel }}</td>
                    <td>
                        @if($p->jurusan)
                            <span class="badge">{{ $p->jurusan->nm_jurusan }}</span>
                        @else
                            <span class="badge badge-none">- Belum Terdaftar -</span>
                        @endif
                    </td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($p->alamat, 25) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <p>Admin / Koordinator Kursus</p>
        <div class="footer-signature">
            ( .................................................. )
        </div>
    </div>

</body>

</html>