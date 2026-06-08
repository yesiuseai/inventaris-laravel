<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                    {{ __('Registrasi Komoditas Baru') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Formulir standarisasi input data komoditas kopi dan logistik masuk.</p>
            </div>
            <a href="{{ route('barang.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 rounded-xl transition shadow-sm self-start sm:self-auto">
                &larr; Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                
                <form action="{{ route('barang.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Nama Produk Utama</label>
                            <select name="nama_dasar" id="nama_dasar" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium" required>
                                <option value="Kopi Kapal Api">Kopi Kapal Api</option>
                                <option value="Kopi Luwak Awaken">Kopi Luwak Awaken</option>
                                <option value="Excelso Gold Blend">Excelso Gold Blend</option>
                                <option value="Torabika Duo">Torabika Duo</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Varian / Opsi Karakter</label>
                            <select name="varian" id="varian" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium" required>
                                <option value="Special Blend">Special Blend (Original)</option>
                                <option value="Gula Aren">Gula Aren Premium</option>
                                <option value="Less Sugar">Less Sugar (Low Calories)</option>
                                <option value="Robusta Signature">Robusta Signature</option>
                                <option value="Arabica Single Origin">Arabica Single Origin</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Dimensi Gramatur (Ukuran)</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="border border-slate-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition peer-checked:border-indigo-600">
                                <span class="text-sm font-semibold text-slate-900">165 Gram</span>
                                <input type="radio" name="gramatur" value="165gr" class="text-indigo-600 focus:ring-indigo-500" checked>
                            </label>
                            <label class="border border-slate-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                                <span class="text-sm font-semibold text-slate-900">380 Gram</span>
                                <input type="radio" name="gramatur" value="380gr" class="text-indigo-600 focus:ring-indigo-500">
                            </label>
                            <label class="border border-slate-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                                <span class="text-sm font-semibold text-slate-900">500 Gram</span>
                                <input type="radio" name="gramatur" value="500gr" class="text-indigo-600 focus:ring-indigo-500">
                            </label>
                        </div>
                    </div>

                    <input type="hidden" name="nama_barang" id="nama_barang" value="">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Kuantitas Stok Masuk</label>
                            <input type="number" name="stok" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Contoh: 100" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Nilai Harga Jual Satuan (Rp)</label>
                            <input type="number" name="harga" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Contoh: 15000" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Mitra Penyuplai (Vendor)</label>
                        <select name="supplier_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('barang.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-100 transition">Otorisasi & Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function generateNamaBarang() {
            const namaDasar = document.getElementById('nama_dasar').value;
            const varian = document.getElementById('varian').value;
            const gramatur = document.querySelector('input[name="gramatur"]:checked').value;
            
            // Format Hasil Akhir: Kopi Kapal Api - Special Blend (165gr)
            document.getElementById('nama_barang').value = `${namaDasar} - ${varian} (${gramatur})`;
        }

        document.getElementById('nama_dasar').addEventListener('change', generateNamaBarang);
        document.getElementById('varian').addEventListener('change', generateNamaBarang);
        document.querySelectorAll('input[name="gramatur"]').forEach(el => el.addEventListener('change', generateNamaBarang));
        
        // Jalankan saat halaman dimuat pertama kali
        generateNamaBarang();
    </script>
</x-app-layout>