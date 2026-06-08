<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Enterprise Dashboard') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}. Monitor metrik inventaris Anda hari ini.</p>
            </div>
            <div class="text-sm text-slate-500 bg-slate-100 px-4 py-2 rounded-lg border border-slate-200 self-start md:self-auto">
                <span class="font-medium text-slate-800">Role Akses:</span> 
                <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ Auth::user()->role == 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-emerald-100 text-emerald-700' }}">
                    {{ strtoupper(Auth::user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group col-span-1 md:col-span-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 tracking-wide uppercase">Valuasi Total Aset (Capital)</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2 tracking-tight group-hover:text-indigo-600 transition-colors">
                                Rp {{ number_format($totalValuasi, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 8c2.196 0 4.072 1.34 4.908 3.237m-13.68c1.353-2.553 4.156-4.237 7.319-4.237 3.162 0 5.966 1.684 7.319 4.237M12 21c4.97 0 9-4.03 9-9s-4.03-9-9-9-9 4.03-9 9 4.03 9 9 9z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-400">
                        Akumulasi total nilai jual dari seluruh stok barang yang mengendap.
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 tracking-wide uppercase">Jenis Komoditas</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2 tracking-tight group-hover:text-sky-600 transition-colors">
                                {{ $totalBarang }} SKU
                            </h3>
                        </div>
                        <div class="p-3 bg-sky-50 rounded-xl text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('barang.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-800 inline-flex items-center gap-1">
                            Buka Logistik &rarr;
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 tracking-wide uppercase">Stok Menipis (&le; 10)</p>
                            <h3 class="text-3xl font-bold mt-2 tracking-tight {{ $stokKritis > 0 ? 'text-rose-600 animate-pulse' : 'text-slate-900' }}">
                                {{ $stokKritis }} Produk
                            </h3>
                        </div>
                        <div class="p-3 rounded-xl transition-all duration-300 {{ $stokKritis > 0 ? 'bg-rose-50 text-rose-600 group-hover:bg-rose-600 group-hover:text-white' : 'bg-slate-50 text-slate-400' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <span class="text-xs text-slate-400">Sinyal re-stock pergudangan.</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-200">
                <div class="p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6 bg-gradient-to-r from-slate-900 to-indigo-950 text-white">
                    <div class="space-y-2 max-w-xl text-center md:text-left">
                        <h4 class="text-xl font-bold tracking-tight">Sistem ERP & Inventaris Multinasional v1.0</h4>
                        <p class="text-slate-300 text-sm leading-relaxed">Aplikasi ini dirancang dengan arsitektur modern berkeamanan tinggi untuk melacak data internal perusahaan secara efisien di wilayah regional perdagangan bebas.</p>
                    </div>
                    <div class="shrink-0">
                        <span class="px-5 py-3 bg-white/10 backdrop-blur text-white text-sm font-semibold rounded-xl border border-white/15 shadow-inner">
                            Sistem Siap Digunakan
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>