<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .summary { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Barang</h1>
        <p>Tanggal: {{ now()->format('d-m-Y') }}</p>
    </div>

    <div class="summary">
        <h3>Ringkasan</h3>
        <p>Total Barang: {{ $totalBarang }}</p>
        <p>Total Stok: {{ $totalStok }}</p>
        <p>Barang Menipis (stok <= 5): {{ $barangMenipis }}</p>
        <p>Total Mutasi: {{ $totalMutasi }}</p>
        <p>Barang Masuk: {{ $barangMasuk }}</p>
        <p>Barang Keluar: {{ $barangKeluar }}</p>
    </div>

    <h3>Detail Barang</h3>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanBarang as $barang)
                <tr>
                    <td>{{ $barang['kode'] }}</td>
                    <td>{{ $barang['nama'] }}</td>
                    <td>{{ $barang['stok'] }}</td>
                    <td>{{ $barang['total_masuk'] }}</td>
                    <td>{{ $barang['total_keluar'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>