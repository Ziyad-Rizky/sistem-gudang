<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use PDF;

class LaporanExportController extends Controller
{
    public function exportExcel()
    {
        $data = $this->getLaporanData();
        return Excel::download(new LaporanExport($data), 'laporan-barang.xlsx');
    }

    public function exportPDF()
    {
        $data = $this->getLaporanData();
        $pdf = PDF::loadView('laporan.export_pdf', $data);
        return $pdf->download('laporan-barang.pdf');
    }

    private function getLaporanData()
    {
        $mutasis = Mutasi::with(['user', 'barang'])->get();
        $barangs = Barang::with('mutasis')->get();
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

        return [
            'mutasis' => $mutasis,
            'totalBarang' => $totalBarang,
            'totalStok' => $totalStok,
            'barangMenipis' => $barangMenipis,
            'totalMutasi' => $totalMutasi,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'laporanBarang' => $laporanBarang
        ];
    }
}