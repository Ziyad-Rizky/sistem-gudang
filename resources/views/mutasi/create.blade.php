<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Mutasi Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('mutasi.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="barang_id" class="block text-gray-700 font-bold mb-2">Barang</label>
                            <select name="barang_id" id="barang_id" class="form-select w-full" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_mutasi" class="block text-gray-700 font-bold mb-2">Jenis Mutasi</label>
                            <select name="jenis_mutasi" id="jenis_mutasi" class="form-select w-full" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah" class="block text-gray-700 font-bold mb-2">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-input w-full" min="1" required>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-input w-full" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-textarea w-full" rows="3"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('mutasi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>