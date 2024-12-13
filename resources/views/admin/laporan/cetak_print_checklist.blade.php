<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Checklist P3K</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        .header {
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header img {
            max-width: 80px;
            height: auto;
        }

        .header .info {
            text-align: center;
            line-height: 1.2;
            padding-left: 10px;
        }

        .header .info div {
            font-size: 10px;
        }

        .table-wrapper {
            max-width: 90%;
            /* Membatasi lebar tabel */
            margin: 20px auto;
            /* Memposisikan tabel di tengah */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-size: 9px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td img {
            max-width: 70px;
            height: auto;
            display: block;
            margin: 0 auto;
            border: 1px solid #ccc;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 9px;
            color: #777;
        }

        .status-label {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: white;
            font-size: 12px;
        }

        /* Warna status */
        .status-label.danger {
            background-color: #d9534f;
            /* Warna merah */
        }

        .status-label.warning {
            background-color: #f0ad4e;
            /* Warna kuning */
        }

        .status-label.success {
            background-color: #5cb85c;
            /* Warna hijau */
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <!-- Kop Surat -->
        <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Perusahaan">
            <div class="info">
                <div style="font-size: 12px; font-weight: bold;">Laporan Pemakaian P3K</div>
                {{-- <div>Unit Kerja</div>
                <div>Tanggal Pemeriksaan: {{ $patrol->tanggal }}</div>
                <div>Tim Inspeksi: {{ $nama }}</div> --}}
            </div>
        </div>

        <!-- Tabel Laporan -->
        <h3 class="text-start">Checklist Kotak P3K</h3>
        <p class="text-start"><strong>Lokasi P3K:</strong> {{ $data['lokasi_p3k'] }}</p>
        <p class="text-start"><strong>Status:</strong> {{ $data['status'] }}</p>
        <p class="text-start"><strong>Tanggal:</strong> {{ $data['tanggal'] }}</p>
        <p class="text-start"><strong>Inspektor:</strong> {{ $data['inspektor'] }}</p>

        <h4>Isi Kotak P3K</h4>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Isi Kotak</th>
                    <th>Jumlah Standar</th>
                    <th>Jumlah Aktual</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['isi_kotak']  as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['isi'] }}</td>
                        <td>{{ $item['jumlah_standar'] }}</td>
                        <td>{{ $item['jumlah_aktual'] }}</td>
                        <td>{{ $item['tanggal_kadaluarsa'] }}</td>
                        <td>{{ $item['keterangan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Kondisi Kotak</h4>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Check</th>
                    <th>Status</th>
                    <th>Tindakan Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['status_kotak'] as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['item'] }}</td>
                        <td>{{ $item['status'] }}</td>
                        <td>{{ $item['tindakan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            Dicetak oleh sistem pada: {{ now()->format('d-m-Y H:i:s') }}
        </div>
    </div>
</body>

</html>
