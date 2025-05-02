<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('barang', \App\Http\Controllers\BarangController::class);

    Route::get('/mutasi', [\App\Http\Controllers\MutasiController::class, 'index'])->name('mutasi.index');
    Route::get('/mutasi/create', [\App\Http\Controllers\MutasiController::class, 'create'])->name('mutasi.create');
    Route::post('/mutasi', [\App\Http\Controllers\MutasiController::class, 'store'])->name('mutasi.store');
    Route::get('/mutasi/download', [\App\Http\Controllers\MutasiController::class, 'download'])->name('mutasi.download');

    Route::get('/laporan', function () {
        $mutasis = \App\Models\Mutasi::with(['user', 'barang'])->get();
        $barangs = \App\Models\Barang::with('mutasis')->get();
        $totalBarang = $barangs->count();
        $totalStok = $barangs->sum('stok');
        $barangMenipis = $barangs->where('stok', '<=', 5)->count();
        $totalMutasi = $mutasis->count();
        $barangMasuk = $mutasis->where('jenis_mutasi', 'masuk')->sum('jumlah');
        $barangKeluar = $mutasis->where('jenis_mutasi', 'keluar')->sum('jumlah');
        $laporanBarang = $barangs->map(function($barang) {
            $totalMasuk = $barang->mutasis->where('jenis_mutasi', 'masuk')->sum('jumlah');
            $totalKeluar = $barang->mutasis->where('jenis_mutasi', 'keluar')->sum('jumlah');
            return [
                'kode' => $barang->kode,
                'nama' => $barang->nama_barang,
                'stok' => $barang->stok,
                'total_masuk' => $totalMasuk,
                'total_keluar' => $totalKeluar
            ];
        });
        return view('laporan.index', [
            'mutasis' => $mutasis,
            'totalBarang' => $totalBarang,
            'totalStok' => $totalStok,
            'barangMenipis' => $barangMenipis,
            'totalMutasi' => $totalMutasi,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'laporanBarang' => $laporanBarang
        ]);
    })->name('laporan.index');
    
    Route::get('/laporan/export/pdf', function () {
        return response()->streamDownload(function () {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pdf');
            echo $pdf->stream();
        }, 'laporan-inventaris.pdf');
    })->name('laporan.export.pdf');
    Route::get('/laporan/export/excel', function () {
        return response()->streamDownload(function () {
            $excel = \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\LaporanExport(), 'laporan-inventaris.xlsx');
            echo $excel->getFile();
        }, 'laporan-inventaris.xlsx');
    })->name('laporan.export.excel');

    Route::get('/pengaturan', function () {
        return view('pengaturan.index');
    })->name('pengaturan.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
