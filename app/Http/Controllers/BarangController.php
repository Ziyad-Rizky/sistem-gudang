<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        if (request()->expectsJson()) {
            $barangs = Barang::all();
            return response()->json($barangs);
        }

        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_barang' => 'required|string|max:255',
                'kode' => 'required|string|unique:barangs,kode,NULL,id,deleted_at,NULL',
                'kategori' => 'required|string|max:100',
                'lokasi' => 'required|string|max:100',
                'deskripsi' => 'nullable|string',
                'stok' => 'required|integer|min:0'
            ]);

            $barang = Barang::create($request->all());

            if ($request->expectsJson()) {
                return response()->json($barang, 201);
            }

            return redirect()->route('barang.index')
                ->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menambahkan barang'], 500);
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan barang. ' . $e->getMessage());
        }

    }

    public function show(Barang $barang)
    {
        if (request()->expectsJson()) {
            return response()->json($barang);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function create()
    {
        return view('barang.create');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|unique:barangs,kode,' . $barang->id,
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0'
        ]);

        $barang->update($request->all());

        if ($request->expectsJson()) {
            return response()->json($barang);
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if (request()->expectsJson()) {
            $barang->delete();
            return response()->json(null, 204);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}