<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Barang;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with(['user', 'barang'])->get();
        return view('mutasi.index', compact('mutasis'));
    }

    public function download()
    {
        $mutasis = Mutasi::with(['user', 'barang'])->get();
        return response()->json($mutasis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        
        if ($request->jenis_mutasi === 'keluar' && $barang->stok < $request->jumlah) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Stok tidak mencukupi'], 422);
            } else {
                return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
            }
        }

        $mutasi = new Mutasi([
            'user_id' => $request->user()->id,
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        $mutasi->save();

        // Update stok barang
        if ($request->jenis_mutasi === 'masuk') {
            $barang->stok += $request->jumlah;
        } else {
            $barang->stok -= $request->jumlah;
        }
        $barang->save();

        if ($request->wantsJson()) {
            return response()->json($mutasi->load(['user', 'barang']), 201);
        } else {
            return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil disimpan.');
        }
    }

    public function show(Mutasi $mutasi)
    {
        return response()->json($mutasi->load(['user', 'barang']));
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        // Kembalikan stok ke kondisi sebelumnya
        $barang = $mutasi->barang;
        if ($mutasi->jenis_mutasi === 'masuk') {
            $barang->stok -= $mutasi->jumlah;
        } else {
            $barang->stok += $mutasi->jumlah;
        }

        // Validasi stok untuk mutasi keluar yang baru
        if ($request->jenis_mutasi === 'keluar' && $barang->stok < $request->jumlah) {
            return response()->json(['message' => 'Stok tidak mencukupi'], 422);
        }

        // Update mutasi
        $mutasi->update($request->all());

        // Update stok sesuai mutasi baru
        if ($request->jenis_mutasi === 'masuk') {
            $barang->stok += $request->jumlah;
        } else {
            $barang->stok -= $request->jumlah;
        }
        $barang->save();

        return response()->json($mutasi->load(['user', 'barang']));
    }

    public function destroy(Mutasi $mutasi)
    {
        // Kembalikan stok ke kondisi sebelum mutasi
        $barang = $mutasi->barang;
        if ($mutasi->jenis_mutasi === 'masuk') {
            $barang->stok -= $mutasi->jumlah;
        } else {
            $barang->stok += $mutasi->jumlah;
        }
        $barang->save();

        $mutasi->delete();
        return response()->json(null, 204);
    }

    public function historyByBarang(Barang $barang)
    {
        $mutasis = Mutasi::with(['user'])
            ->where('barang_id', $barang->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'barang' => $barang,
            'mutasis' => $mutasis
        ]);
    }

    public function historyByUser(Request $request)
    {
        $mutasis = Mutasi::with(['barang'])
            ->where('user_id', $request->user()->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($mutasis);
    }

    public function create()
    {
        $barangs = \App\Models\Barang::all();
        return view('mutasi.create', compact('barangs'));
    }
}