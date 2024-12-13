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
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemakai Obat P3K</th>
                        <th>Divisi</th>
                        <th>Tanggal Pemakaian</th>
                        <th>Jam Pemakaian</th>
                        <th>Jenis Obat P3K</th>
                        <th>Jumlah Pemakaian</th>
                        <th>Alasan Pemakaian</th>
                        <th>Kotak P3K</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $d->nama_pemakai }}</td>
                            <td>{{ $d->divisi }}</td>
                            <td class="text-center">{{ $d->tanggal }}</td>
                            <td class="text-center">{{ $d->jam_pemakaian }}</td>
                            <td>{{ $d->barang->barang_nama }}</td>
                            <td class="text-center">{{ $d->jumlah_pemakaian }}</td>
                            <td>{{ $d->alasan_pemakaian }}</td>
                            <td>{{ $d->kotakP3k->lokasi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            Dicetak oleh sistem pada: {{ now()->format('d-m-Y H:i:s') }}
        </div>
    </div>
</body>

</html>
