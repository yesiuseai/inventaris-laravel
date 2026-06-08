<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                    {{ __('Manajemen Mitra Supplier') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Kelola direktori vendor, kontrak kemitraan distribusi, dan transparansi rantai pasok perusahaan.</p>
            </div>
            <div>
                <a href="{{ route('supplier.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl shadow-sm shadow-sky-100 hover:shadow-sky-200 transition-all duration-200 gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Mitra Vendor
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
                                <th class="p-4 pl-6">Nama Entitas Perusahaan</th>
                                <th class="p-4">Saluran Kontak Telepon</th>
                                <th class="p-4">Alamat Kantor Pusat / Gudang</th>
                                <th class="p-4 pr-6 text-center">Tindakan Eksekutif</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                            @forelse($suppliers as $supplier)
                            <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-xs shadow-inner">
                                            {{ strtoupper(substr($supplier->nama_supplier, 0, 2)) }}
                                        </div>
                                        <span class="font-semibold text-slate-900">{{ $supplier->nama_supplier }}</span>
                                    </div>
                                </td>
                                
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        {{ $supplier->telepon }}
                                    </span>
                                </td>
                                
                                <td class="p-4 text-slate-500 max-w-xs truncate" title="{{ $supplier->alamat }}">
                                    {{ $supplier->alamat }}
                                </td>
                                
                                <td class="p-4 pr-6">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 rounded-lg transition-colors shadow-sm">
                                            Modifikasi
                                        </a>
                                        
                                        @if(Auth::user()->role == 'admin')
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-rose-600 hover:text-white hover:bg-rose-600 border border-transparent hover:border-rose-600 rounded-lg transition-all duration-150" onclick="return confirm('Apakah Anda yakin ingin memutus kontrak dan menghapus data mitra supplier ini secara permanen?')">
                                                Putuskan Mitra
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-slate-400">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <span class="text-sm font-medium block">Belum ada mitra bisnis terdaftar.</span>
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