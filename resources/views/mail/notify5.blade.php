<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Inspeksi P3K Baru</title>
</head>
<body>
    <h1>Notifikasi Inspeksi Baru</h1>
    <p>Data inspeksi baru telah ditambahkan oleh {{ $details['user'] }}.</p>
    <ul>
        <li>Tanggal: {{ $details['tanggal'] }}</li>
        <li>Status: {{ $details['status'] }}</li>
    </ul>
    <p>Silakan cek sistem untuk detail lebih lanjut.</p>
</body>
</html>
