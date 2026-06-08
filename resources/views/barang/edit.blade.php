<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                    {{ __('Modifikasi Komoditas') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Sistem deteksi otomatis parameter produk untuk pembaruan data yang presisi.</p>
            </div>
            <a href="{{ route('barang.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 rounded-xl transition shadow-sm self-start sm:self-auto">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                
                <form action="{{ route('barang.update', $barang->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Nama Produk Utama</label>
                            <select id="nama_dasar" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium">
                                <option value="Kopi Kapal Api">Kopi Kapal Api</option>
                                <option value="Kopi Luwak Awaken">Kopi Luwak Awaken</option>
                                <option value="Excelso Gold Blend">Excelso Gold Blend</option>
                                <option value="Torabika Duo">Torabika Duo</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Varian / Opsi Karakter</label>
                            <select id="varian" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium">
                                <option value="Special Blend">Special Blend (Original)</option>
                                <option value="Gula Aren">Gula Aren Premium</option>
                                <option value="Less Sugar">Less Sugar (Low Calories)</option>
                                <option value="Robusta Signature">Robusta Signature</option>
                                <option value="Arabica Single Origin">Arabica Single Origin</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Dimensi Gramatur (Ukuran Terdaftar)</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="border border-slate-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                                <span class="text-sm font-semibold text-slate-900">165 Gram</span>
                                <input type="radio" name="gramatur" value="165gr" class="text-indigo-600 focus:ring-indigo-500">
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

                    <input type="hidden" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Kuantitas Stok Saat Ini</label>
                            <input type="number" name="stok" value="{{ $barang->stok }}" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Nilai Harga Jual Satuan (Rp)</label>
                            <input type="number" name="harga" value="{{ $barang->harga }}" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">Dialokasikan ke Vendor</label>
                        <select name="supplier_id" class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50/50 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $barang->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('barang.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                        <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-emerald-100 transition">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const hiddenInput = document.getElementById('nama_barang');
        const selectDasar = document.getElementById('nama_dasar');
        const selectVarian = document.getElementById('varian');

        // Fungsi Memecah Nama (Deconstructor)
        function deconstructNama() {
            const fullName = hiddenInput.value; // Misal: "Kopi Kapal Api - Gula Aren (380gr)"
            
            try {
                // Pecah berdasarkan " - "
                const parts = fullName.split(' - ');
                if (parts.length < 2) return;

                const namaDasar = parts[0].trim();
                const sisa = parts[1].trim(); // "Gula Aren (380gr)"

                // Pecah sisa untuk ambil varian dan gramatur
                const varianMatch = sisa.split(' (');
                const varian = varianMatch[0].trim();
                const gramatur = varianMatch[1].replace(')', '').trim();

                // Set nilai Dropdown
                selectDasar.value = namaDasar;
                selectVarian.value = varian;

                // Set nilai Radio
                const radio = document.querySelector(`input[name="gramatur"][value="${gramatur}"]`);
                if (radio) radio.checked = true;
            } catch (e) {
                console.log("Format nama tidak sesuai untuk dekonstruksi otomatis.");
            }
        }

        // Fungsi Menggabungkan Nama (Constructor)
        function constructNama() {
            const namaDasar = selectDasar.value;
            const varian = selectVarian.value;
            const radioGram = document.querySelector('input[name="gramatur"]:checked');
            const gramatur = radioGram ? radioGram.value : '165gr';
            
            hiddenInput.value = `${namaDasar} - ${varian} (${gramatur})`;
        }

        // Event Listeners
        selectDasar.addEventListener('change', constructNama);
        selectVarian.addEventListener('change', constructNama);
        document.querySelectorAll('input[name="gramatur"]').forEach(el => el.addEventListener('change', constructNama));
        
        // Jalankan pemecahan nama saat halaman dibuka
        window.onload = deconstructNama;
    </script>
</x-app-layout>