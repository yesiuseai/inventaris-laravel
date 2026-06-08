<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nomor Telepon</label>
                        <input type="text" name="telepon" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Alamat</label>
                        <textarea name="alamat" class="w-full border p-2 rounded" rows="3" required></textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Data</button>
                        <a href="{{ route('supplier.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>