<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Laporan Inventaris</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('laporan.export.pdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Export PDF
                            </a>
                            <a href="{{ route('laporan.export.excel') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Export Excel
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold mb-2">Statistik Barang</h4>
                            <div class="space-y-2">
                                <p>Total Barang: {{ $totalBarang }}</p>
                                <p>Total Stok: {{ $totalStok }}</p>
                                <p>Barang Menipis: {{ $barangMenipis }}</p>
                            </div>
                        </div>
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold mb-2">Statistik Mutasi</h4>
                            <div class="space-y-2">
                                <p>Total Mutasi: {{ $totalMutasi }}</p>
                                <p>Barang Masuk: {{ $barangMasuk }}</p>
                                <p>Barang Keluar: {{ $barangKeluar }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Masuk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Keluar</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($laporanBarang as $barang)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $barang['kode'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $barang['nama'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $barang['stok'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $barang['total_masuk'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $barang['total_keluar'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="5">Belum ada data laporan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="overflow-x-auto mt-8">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Riwayat Mutasi Barang</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Mutasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($mutasis as $mutasi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mutasi->tanggal }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mutasi->user->name ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mutasi->barang->nama_barang ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $mutasi->jenis_mutasi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mutasi->jumlah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mutasi->keterangan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="6">Belum ada data mutasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>