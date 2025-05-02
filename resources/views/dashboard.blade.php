<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Sistem Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Ringkasan Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-lg font-semibold text-gray-700 mb-2">Total Barang</div>
                        <div class="text-3xl font-bold text-blue-600">{{ App\Models\Barang::count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Item dalam inventaris</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-lg font-semibold text-gray-700 mb-2">Mutasi Hari Ini</div>
                        <div class="text-3xl font-bold text-green-600">{{ App\Models\Mutasi::whereDate('created_at', today())->count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Transaksi</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-lg font-semibold text-gray-700 mb-2">Stok Menipis</div>
                        <div class="text-3xl font-bold text-red-600">{{ App\Models\Barang::where('stok', '<', 10)->count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Item perlu perhatian</div>
                    </div>
                </div>
            </div>

            <!-- Menu Akses Cepat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Akses Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('barang.index') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <h4 class="font-semibold text-blue-700">Kelola Barang</h4>
                            <p class="text-sm text-gray-600 mt-1">Tambah, edit, dan hapus barang</p>
                        </a>
                        <a href="{{ route('mutasi.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <h4 class="font-semibold text-green-700">Catat Mutasi</h4>
                            <p class="text-sm text-gray-600 mt-1">Rekam perpindahan barang</p>
                        </a>
                        <a href="{{ route('laporan.index') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <h4 class="font-semibold text-purple-700">Laporan</h4>
                            <p class="text-sm text-gray-600 mt-1">Lihat laporan dan statistik</p>
                        </a>
                        <a href="{{ route('pengaturan.index') }}" class="block p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                            <h4 class="font-semibold text-orange-700">Pengaturan</h4>
                            <p class="text-sm text-gray-600 mt-1">Konfigurasi sistem</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terakhir -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aktivitas Terakhir</h3>
                    <div class="space-y-4">
                        @if(App\Models\Mutasi::latest()->take(5)->count() > 0)
                            @foreach(App\Models\Mutasi::with(['barang', 'user'])->latest()->take(5)->get() as $mutasi)
                                <div class="border-b border-gray-200 pb-2">
                                    <p class="text-sm text-gray-600">{{ $mutasi->user->name }} melakukan mutasi {{ $mutasi->barang->nama }} ({{ $mutasi->jenis }})</p>
                                    <p class="text-xs text-gray-500">{{ $mutasi->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-center">Belum ada aktivitas tercatat</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
