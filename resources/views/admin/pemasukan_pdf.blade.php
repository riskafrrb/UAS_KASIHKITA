<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemasukan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #000; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Pemasukan Donasi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Donasi</th>
                <th>Kategori</th>
                <th>Total Donasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donasis as $index => $donasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $donasi->judul }}</td>
                <td>{{ $donasi->kategori }}</td>
                <td>Rp {{ number_format($donasi->total_donasi, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
