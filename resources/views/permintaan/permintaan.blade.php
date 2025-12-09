@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Form Permintaan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Three Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Riwayat Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer"
            onclick="window.location.href='{{ route('permintaan.riwayat') }}'">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-archive text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Permintaan</h3>
                </div>
            </div>

            <!-- Status Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer" 
                onclick="window.location.href='{{ route('permintaan.status') }}'">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-desktop text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Status Permintaan</h3>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer"
                onclick="window.location.href='{{ route('barang.daftar') }}'">
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
                    name="nama_pemohon"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Masukkan nama pemohon"
                    value="{{ $user->nama_lengkap ?? $user->username ?? '' }}"
                    readonly
                    required
                >
                </div>

                <!-- Unit Kerja -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Unit Kerja</label>
                    <input 
                        type="text" 
                        id="unit-kerja"
                        name="unit_kerja"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Masukkan unit kerja"
                        value="{{ $user->unit_kerja ?? '' }}"
                        readonly
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
                        @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
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
                            placeholder="Ketik nama barang atau kode..."
                            disabled
                        >
                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-3 flex items-center hidden">
                            <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600"></div>
                        </div>
                    </div>
                </div>

                <!-- Di bagian hasil pencarian barang -->
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
        
        <!-- Modal Verifikasi 1: Ringkasan Permintaan -->
<div id="modal-verifikasi1" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header - PERBAIKAN: Hapus onclick inline -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-clipboard-check text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Ringkasan Permintaan</h3>
                </div>
                <button id="close-modal-verifikasi1" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Content -->
            <div class="border-t border-b border-gray-200 py-4 my-4 max-h-96 overflow-y-auto">
                <div class="space-y-4">
                    <!-- Informasi Permintaan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-600">Tanggal Permintaan</div>
                            <div class="font-medium" id="modal-tanggal"></div>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="text-sm text-gray-600">Jumlah Barang</div>
                            <div class="font-medium" id="modal-jumlah-barang"></div>
                        </div>
                    </div>
                    
                    <!-- Data Pemohon -->
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-sm font-medium text-gray-700 mb-2">Data Pemohon</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div>
                                <div class="text-xs text-gray-500">Nama Pemohon</div>
                                <div class="font-medium" id="modal-nama-pemohon"></div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Unit Kerja</div>
                                <div class="font-medium" id="modal-unit-kerja"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Daftar Barang -->
                    <div>
                        <div class="text-sm font-medium text-gray-700 mb-2">Daftar Barang yang Diminta</div>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">No</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Kode Barang</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Nama Barang</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Jumlah</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-daftar-barang" class="divide-y divide-gray-200">
                                    <!-- Data akan diisi via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer - PERBAIKAN: Hapus onclick inline -->
            <div class="flex justify-end items-center pt-4">
                <button id="lanjut-verifikasi2" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    Lanjut ke Verifikasi Final <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi 2: Konfirmasi Final -->
<div id="modal-verifikasi2" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-60">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header - PERBAIKAN: Hapus onclick inline -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Konfirmasi Final</h3>
                </div>
                <button id="close-modal-verifikasi2" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Content -->
            <div class="border-t border-b border-gray-200 py-6 my-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-question text-yellow-600 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Pengiriman</h4>
                    <p class="text-gray-600 mb-4">
                        Anda akan mengirim permintaan untuk 
                        <span id="modal2-jumlah-barang" class="font-bold text-blue-600"></span> 
                        atas nama 
                        <span id="modal2-nama-pemohon" class="font-bold text-blue-600"></span>.
                    </p>
                    <p class="text-sm text-gray-500">
                        Pastikan data sudah benar. Permintaan tidak dapat dibatalkan setelah dikirim.
                    </p>
                </div>
            </div>
            
            <!-- Footer - PERBAIKAN: Hapus onclick inline -->
            <div class="flex justify-between items-center pt-4">
                <button id="kembali-verifikasi1" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </button>
                <button id="submit-final-permintaan" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i>Kirim Permintaan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Loading -->
<div id="modal-loading" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-70">
    <div class="relative top-20 mx-auto p-5 w-64">
        <div class="bg-white rounded-lg shadow-xl p-6">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-700 font-medium">Mengirim permintaan...</p>
                <p class="text-sm text-gray-500 mt-1">Harap tunggu sebentar</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="modal-sukses" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-70">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Permintaan Berhasil!</h3>
                </div>
            </div>
            
            <!-- Content -->
            <div class="border-t border-b border-gray-200 py-6 my-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <div class="text-sm text-gray-500">Kode Permintaan</div>
                            <div id="modal-sukses-kode" class="text-2xl font-bold text-gray-900"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-left">
                                <div class="text-gray-500">Tanggal</div>
                                <div id="modal-sukses-tanggal" class="font-medium"></div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-500">Pemohon</div>
                                <div id="modal-sukses-pemohon" class="font-medium"></div>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200">
                            <div class="text-sm text-gray-500">Total Barang</div>
                            <div id="modal-sukses-jumlah" class="font-medium text-blue-600"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex justify-center pt-4">
                <button onclick="tutupModalSuksesDanRedirect()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    Lihat Status Permintaan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div id="modal-error" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-70">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Terjadi Kesalahan</h3>
                </div>
                <button onclick="tutupModalError()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Content -->
            <div class="border-t border-b border-gray-200 py-6 my-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-times text-red-600 text-2xl"></i>
                    </div>
                    <p id="modal-error-pesan" class="text-gray-700"></p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex justify-center pt-4">
                <button onclick="tutupModalError()" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

@push('scripts')
<script>
    // CSRF Token untuk AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
<script src="{{ asset('js/permintaan.js') }}"></script>
@endpush
@endsection