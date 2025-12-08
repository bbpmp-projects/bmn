@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header dan Breadcrumb -->
        <div class="mb-8">
            <!-- Breadcrumb -->
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Riwayat Permintaan</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Riwayat Permintaan Barang</h1>
                        <p class="text-gray-600">Lihat riwayat permintaan barang yang telah diproses (diterima atau ditolak)</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('permintaan.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Permintaan Baru
                        </a>
                        <a href="{{ route('permintaan.status') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                            <i class="fas fa-clock mr-2"></i>
                            Status Permintaan
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filter Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                    <select id="filter-status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
                
                <!-- Filter Tanggal Dari -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                    <input type="date" id="filter-tanggal-dari" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Filter Tanggal Sampai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                    <input type="date" id="filter-tanggal-sampai" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Tombol Aksi Filter -->
                <div class="flex items-end">
                    <div class="flex space-x-2 w-full">
                        <button id="btn-apply-filter" 
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-filter mr-2"></i> Terapkan
                        </button>
                        <button id="btn-reset-filter" 
                                class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                            <i class="fas fa-redo mr-2"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Disetujui</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-approved">0</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg mr-4">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ditolak</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-rejected">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Permintaan -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Permintaan</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500" id="total-data">0 data ditemukan</span>
                    <button id="btn-refresh" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Permintaan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Item</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="riwayat-table-body">
                        <!-- Data akan diisi oleh JavaScript -->
                        <tr id="loading-row">
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                                    <p class="text-gray-500">Memuat data riwayat...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan <span id="pagination-start">0</span> - <span id="pagination-end">0</span> dari <span id="pagination-total">0</span> data
                </div>
                <div class="flex space-x-2">
                    <button id="btn-prev" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="flex space-x-1" id="pagination-numbers">
                        <!-- Pagination numbers will be inserted here by JavaScript -->
                    </div>
                    <button id="btn-next" class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Detail (sama seperti di status.blade.php) -->
        @include('permintaan.partials.modal-detail')
        
    </div>
</div>

<!-- Include JavaScript -->
@push('scripts')
<script src="{{ asset('js/riwayat-permintaan.js') }}"></script>
@endpush

@endsection