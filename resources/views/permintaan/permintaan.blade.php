@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Home
            </a>
        </div>

        <!-- Three Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Riwayat Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-archive text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Permintaan</h3>
                </div>
            </div>

            <!-- Status Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-desktop text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Status Permintaan</h3>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-folder text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Barang</h3>
                </div>
            </div>
        </div>

        <!-- Form Header Data -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Form Permintaan Barang</h2>
                <p class="text-red-600 text-sm">Isi sesuai data permintaan</p>
            </div>

            <!-- Grid untuk Nama, Unit Kerja, dan Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Nama Pemohon -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Pemohon</label>
                    <input 
                        type="text" 
                        id="nama-pemohon"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Masukkan nama pemohon"
                        required
                    >
                </div>

                <!-- Unit Kerja -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Unit Kerja</label>
                    <input 
                        type="text" 
                        id="unit-kerja"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Masukkan unit kerja"
                        required
                    >
                </div>

                <!-- Tanggal Permintaan -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Permintaan</label>
                    <input 
                        type="date" 
                        id="tanggal-permintaan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        min="{{ date('Y-m-d') }}"
                    >
                </div>
            </div>

            <!-- Form Pencarian Barang -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Barang</h3>
                
                <!-- Kategori Barang -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kategori Barang</label>
                    <select id="kategori-barang" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">Pilih Kategori Barang</option>
                        <option value="atk">Alat Tulis Kantor (ATK)</option>
                        <option value="elektronik">Perangkat Elektronik</option>
                        <option value="furniture">Furniture</option>
                        <option value="kendaraan">Kendaraan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Search Barang -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Cari Barang</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            id="search-barang"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Ketik nama barang..."
                            disabled
                        >
                    </div>
                </div>

                <!-- Daftar Barang Hasil Pencarian -->
                <div id="daftar-barang" class="hidden mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-3">Hasil Pencarian</h4>
                    <div class="bg-gray-50 rounded-lg p-4 max-h-60 overflow-y-auto">
                        <div id="list-barang" class="space-y-2">
                            <!-- Hasil pencarian akan muncul di sini -->
                        </div>
                    </div>
                </div>

                <!-- Form Jumlah Barang yang Dipilih -->
                <div id="form-jumlah" class="hidden mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-3">Barang yang Dipilih</h4>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span id="nama-barang-dipilih" class="font-medium text-gray-900"></span>
                                <span id="kode-barang-dipilih" class="text-sm text-gray-600 ml-2"></span>
                            </div>
                            <span id="stok-barang" class="text-sm text-gray-600"></span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Jumlah</label>
                                <input 
                                    type="number" 
                                    id="jumlah-barang"
                                    min="1"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Masukkan jumlah"
                                >
                            </div>
                            <div class="flex-1">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Satuan</label>
                                <input 
                                    type="text" 
                                    id="satuan-barang"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Satuan"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Keterangan (Opsional)</label>
                            <textarea 
                                id="keterangan-barang"
                                rows="2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
                                placeholder="Masukkan keterangan tambahan"
                            ></textarea>
                        </div>
                        <div class="mt-4 flex justify-end space-x-3">
                            <button 
                                type="button" 
                                id="batal-pilih"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300"
                            >
                                Batal
                            </button>
                            <button 
                                type="button" 
                                id="tambah-ke-keranjang"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300"
                            >
                                Tambah ke Daftar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Barang yang Diminta -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Barang yang Diminta</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Kode Barang</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Jumlah</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Satuan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Keterangan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-permintaan">
                        <!-- Data akan diisi via JavaScript -->
                        <tr id="empty-state">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-shopping-cart text-4xl mb-2 text-gray-300"></i>
                                <p>Belum ada barang yang ditambahkan</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button 
                id="submit-permintaan"
                class="bg-blue-600 text-white px-12 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                disabled
            >
                Submit Permintaan
            </button>
        </div>
        
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/permintaan.js') }}"></script>
@endpush
@endsection