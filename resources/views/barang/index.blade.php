<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                    {{ __('Manajemen Data Barang') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Kelola portofolio komoditas, stok logistik, dan relasi vendor asal secara *real-time*.</p>
            </div>
            <div>
                <a href="{{ route('barang.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm shadow-indigo-100 hover:shadow-indigo-200 transition-all duration-200 gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Komoditas
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl flex items-center gap-3 shadow-sm">
                    <div class="p-1 bg-emerald-500 rounded-lg text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-bold tracking-wider uppercase">
                                <th class="p-4 pl-6">Deskripsi Barang</th>
                                <th class="p-4">Kuantitas Stok</th>
                                <th class="p-4">Nilai Satuan (Valuasi)</th>
                                <th class="p-4">Mitra Distribusi</th>
                                <th class="p-4 pr-6 text-center">Tindakan Eksekutif</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                            @forelse($barangs as $barang)
                            <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                                <td class="p-4 pl-6 font-semibold text-slate-900">{{ $barang->nama_barang }}</td>
                                
                                <td class="p-4">
                                    @if($barang->stok <= 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200 animate-bounce">
                                            ⚠️ Habis (0 Unit)
                                        </span>
                                    @elseif($barang->stok <= 10)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 shadow-sm animate-pulse">
                                            🚨 Kritis ({{ $barang->stok }} Unit)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                                            ✓ {{ $barang->stok }} Unit
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="p-4 font-medium text-slate-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                
                                <td class="p-4 text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                        {{ $barang->supplier?->nama_supplier ?? 'Internal Warehouse' }}
                                    </div>
                                </td>
                                
                                <td class="p-4 pr-6">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 rounded-lg transition-colors shadow-sm">
                                            Modifikasi
                                        </a>
                                        
                                        @if(Auth::user()->role == 'admin')
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-rose-600 hover:text-white hover:bg-rose-600 border border-transparent hover:border-rose-600 rounded-lg transition-all duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus arsip komoditas ini secara permanen?')">
                                                Eliminasi
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L12 14m0 0l-3.586-3.586a2 2 0 00-2.828 0L4 14"></path></svg>
                                    <span class="text-sm font-medium block">Basis data logistik kosong.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>