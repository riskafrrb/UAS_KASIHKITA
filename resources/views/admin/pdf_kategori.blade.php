<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Distribusi Kategori Donasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Distribusi Kategori Donasi</h2>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Total Donasi (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
