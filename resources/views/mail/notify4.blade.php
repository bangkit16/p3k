<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Inspeksi Ditolak</title>
</head>
<body>
    <h1>Notifikasi Inspeksi Ditolak </h1>
    <p>Data Temuan telah ditolak</p>
    <ul>
        <li>Tanggal: {{ $details['tanggal'] }}</li>
        <li>Status: {{ $details['status'] }}</li>
    </ul>
    <p>Silakan cek sistem untuk melihat detailnya.</p>
</body>
</html>
