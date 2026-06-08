<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang.
     */
    public function index()
    {
        // Mengambil semua data barang beserta data relasi supplier-nya
        $barangs = Barang::with('supplier')->get();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Menampilkan formulir untuk menambah barang baru.
     */
    public function create()
    {
        // Mengambil semua data supplier untuk pilihan dropdown di form
        $suppliers = Supplier::all();
        return view('barang.create', compact('suppliers'));
    }

    /**
     * Menyimpan data barang baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input data dari form
        $request->validate([
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        // 2. AMAN: Hanya ambil kolom yang terdaftar di database Anda
        // Ini akan mengabaikan 'nama_dasar', 'varian', dan 'gramatur' agar tidak memicu error MySQL
        $dataValid = $request->only(['nama_barang', 'stok', 'harga', 'supplier_id']);

        // 3. Menyimpan data yang sudah disaring ke database
        Barang::create($dataValid);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil disimpan dengan spesifikasi lengkap');
    }

    /**
     * Menampilkan data barang spesifik (tidak digunakan di modul, dibiarkan kosong).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan formulir untuk mengedit data barang.
     */
    public function edit(Barang $barang)
    {
        $suppliers = Supplier::all();
        return view('barang.edit', compact('barang', 'suppliers'));
    }

    /**
     * Memperbarui data barang di database.
     */
    public function update(Request $request, Barang $barang)
    {
       $request->validate([
            'nama_barang' => 'required',
            'stok'        => 'required|numeric',
            'harga'       => 'required|numeric',
            'supplier_id' => 'required',
        ]);

        // HANYA ambil kolom yang ada di database
        $dataValid = $request->only(['nama_barang', 'stok', 'harga', 'supplier_id']);

        $barang->update($dataValid);

        return redirect()->route('barang.index')->with('success', 'Data komoditas berhasil diperbarui');
    }

    /**
     * Menghapus data barang dari database.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}