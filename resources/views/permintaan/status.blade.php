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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Status Permintaan</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Status Permintaan Barang</h1>
                        <p class="text-gray-600">Lihat semua status permintaan barang</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('permintaan.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Permintaan Baru
                        </a>
                        <a href="{{ route('permintaan.riwayat') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                            <i class="fas fa-history mr-2"></i>
                            Riwayat Permintaan
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
                        <option value="pending">Pending</option>
                        <option value="processed">Diproses</option>
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

        <!-- Statistik Status -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-pending">0</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg mr-4">
                        <i class="fas fa-cogs text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Diproses</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-processed">0</p>
                    </div>
                </div>
            </div>
            
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

        <!-- Tabel Status Permintaan -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Permintaan</h3>
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
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemohon</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="status-table-body">
                        <!-- Data akan diisi oleh JavaScript -->
                        <tr id="loading-row">
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                                    <p class="text-gray-500">Memuat data permintaan...</p>
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

        <!-- Modal Detail -->
        @include('permintaan.partials.modal-detail')
        
    </div>
</div>

<!-- Include JavaScript untuk status permintaan -->
@push('scripts')
<script src="{{ asset('js/status-permintaan.js') }}"></script>
<script>
// JavaScript untuk pagination, filtering, dan statistik
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let totalPages = 1;
    let totalItems = 0;
    let perPage = 10;
    let filterStatus = '';
    let filterTanggalDari = '';
    let filterTanggalSampai = '';

    // Load data pertama kali
    loadData();

    // Event listener untuk filter
    document.getElementById('filter-status').addEventListener('change', function() {
        filterStatus = this.value;
    });

    document.getElementById('filter-tanggal-dari').addEventListener('change', function() {
        filterTanggalDari = this.value;
    });

    document.getElementById('filter-tanggal-sampai').addEventListener('change', function() {
        filterTanggalSampai = this.value;
    });

    // Tombol apply filter
    document.getElementById('btn-apply-filter').addEventListener('click', function() {
        currentPage = 1;
        loadData();
    });

    // Tombol reset filter
    document.getElementById('btn-reset-filter').addEventListener('click', function() {
        document.getElementById('filter-status').value = '';
        document.getElementById('filter-tanggal-dari').value = '';
        document.getElementById('filter-tanggal-sampai').value = '';
        
        filterStatus = '';
        filterTanggalDari = '';
        filterTanggalSampai = '';
        currentPage = 1;
        
        loadData();
    });

    // Tombol refresh
    document.getElementById('btn-refresh').addEventListener('click', function() {
        loadData();
    });

    // Pagination previous
    document.getElementById('btn-prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadData();
        }
    });

    // Pagination next
    document.getElementById('btn-next').addEventListener('click', function() {
        if (currentPage < totalPages) {
            currentPage++;
            loadData();
        }
    });

    // Fungsi untuk memuat data
    async function loadData() {
        const tableBody = document.getElementById('status-table-body');
        const loadingRow = document.getElementById('loading-row');
        
        // Tampilkan loading
        if (!loadingRow) {
            tableBody.innerHTML = `
                <tr id="loading-row">
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                            <p class="text-gray-500">Memuat data permintaan...</p>
                        </div>
                    </td>
                </tr>
            `;
        }

        try {
            // Build query parameters
            const params = new URLSearchParams({
                page: currentPage,
                filter_status: filterStatus,
                filter_tanggal_dari: filterTanggalDari,
                filter_tanggal_sampai: filterTanggalSampai
            });

            const response = await fetch(`/permintaan/status?${params.toString()}&ajax=1`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.success) {
                // Update pagination info
                totalPages = data.last_page;
                totalItems = data.total;
                perPage = data.per_page;
                
                // Update UI
                updatePaginationInfo(data);
                updateTableData(data.data);
                updateStatistics(data.data);
            }
        } catch (error) {
            console.error('Error loading data:', error);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-red-500">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p>Gagal memuat data. Silakan coba lagi.</p>
                    </td>
                </tr>
            `;
        }
    }

    // Fungsi untuk mengupdate tabel dengan data baru
    function updateTableData(items) {
        const tableBody = document.getElementById('status-table-body');
        
        if (items.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                        <p>Tidak ada data permintaan ditemukan</p>
                    </td>
                </tr>
            `;
            return;
        }

        let html = '';
        
        items.forEach(item => {
            // Generate kode referensi
            const date = new Date(item.tanggal);
            const kodeReferensi = `PR-${date.getFullYear()}${String(date.getMonth() + 1).padStart(2, '0')}-${String(item.kode_permintaan).padStart(4, '0')}`;
            
            // Status colors
            const statusColors = {
                'pending': 'bg-yellow-100 text-yellow-800',
                'approved': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
                'processed': 'bg-blue-100 text-blue-800'
            };
            const statusColor = statusColors[item.status] || 'bg-gray-100 text-gray-800';

            html += `
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-700">
                        ${kodeReferensi}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        ${new Date(item.tanggal).toLocaleDateString('id-ID')}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        ${item.user?.nama_lengkap || 'Tidak diketahui'}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        ${item.user?.unit_kerja || 'Tidak diketahui'}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        ${item.detail_permintaan?.length || 0} barang
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 rounded-full text-xs font-medium ${statusColor}">
                            ${item.status.toUpperCase()}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <button type="button" 
                                class="text-blue-600 hover:text-blue-800 mr-3 btn-detail-permintaan"
                                data-kode="${kodeReferensi}"
                                data-id="${item.kode_permintaan}">
                            <i class="fas fa-eye"></i> Detail
                        </button>
                    </td>
                </tr>
            `;
        });

        tableBody.innerHTML = html;

        // Re-attach event listeners untuk tombol detail
        document.querySelectorAll('.btn-detail-permintaan').forEach(button => {
            button.addEventListener('click', function() {
                const kodePermintaan = this.getAttribute('data-kode');
                const idPermintaan = this.getAttribute('data-id');
                bukaModalDetail(kodePermintaan, idPermintaan);
            });
        });
    }

    // Fungsi untuk mengupdate informasi pagination
    function updatePaginationInfo(data) {
        document.getElementById('pagination-start').textContent = data.from || 0;
        document.getElementById('pagination-end').textContent = data.to || 0;
        document.getElementById('pagination-total').textContent = data.total || 0;
        document.getElementById('total-data').textContent = `${data.total || 0} data ditemukan`;

        // Update tombol pagination
        document.getElementById('btn-prev').disabled = currentPage === 1;
        document.getElementById('btn-next').disabled = currentPage === totalPages;

        // Update nomor halaman
        const paginationNumbers = document.getElementById('pagination-numbers');
        paginationNumbers.innerHTML = '';

        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const button = document.createElement('button');
            button.className = `px-3 py-1 border rounded-md ${i === currentPage ? 'bg-blue-600 text-white border-blue-600' : 'border-gray-300 text-gray-700 hover:bg-gray-50'}`;
            button.textContent = i;
            button.addEventListener('click', () => {
                currentPage = i;
                loadData();
            });
            paginationNumbers.appendChild(button);
        }
    }

    // Fungsi untuk mengupdate statistik
    function updateStatistics(items) {
        const stats = {
            pending: 0,
            processed: 0,
            approved: 0,
            rejected: 0
        };

        items.forEach(item => {
            if (stats.hasOwnProperty(item.status)) {
                stats[item.status]++;
            }
        });

        document.getElementById('stat-pending').textContent = stats.pending;
        document.getElementById('stat-processed').textContent = stats.processed;
        document.getElementById('stat-approved').textContent = stats.approved;
        document.getElementById('stat-rejected').textContent = stats.rejected;
    }
});
</script>
@endpush

<!-- Modal Detail Permintaan -->
<div id="modal-detail-permintaan" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Detail Permintaan</h3>
            <button type="button" 
                    class="text-gray-400 hover:text-gray-500 text-2xl font-semibold leading-none"
                    onclick="tutupModalDetail()">
                &times;
            </button>
        </div>
        
        <!-- Modal Content -->
        <div class="mt-4">
            <!-- Informasi Permintaan -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Kode Permintaan</p>
                        <p class="font-medium text-gray-900" id="modal-kode-permintaan">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="font-medium text-gray-900" id="modal-tanggal-permintaan">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="px-3 py-1 rounded-full text-xs font-medium" id="modal-status-permintaan">-</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Barang</p>
                        <p class="font-medium text-gray-900" id="modal-jumlah-barang">-</p>
                    </div>
                </div>
            </div>
            
            <!-- Informasi Pemohon -->
            <div class="mb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Informasi Pemohon</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pemohon</p>
                        <p class="font-medium text-gray-900" id="modal-nama-pemohon">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Unit Kerja</p>
                        <p class="font-medium text-gray-900" id="modal-unit-kerja">-</p>
                    </div>
                </div>
            </div>
            
            <!-- Daftar Barang -->
            <div>
                <h4 class="text-md font-semibold text-gray-900 mb-3">Daftar Barang</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Barang</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="modal-daftar-barang">
                            <!-- Data akan diisi oleh JavaScript -->
                            <tr id="modal-loading">
                                <td colspan="5" class="px-4 py-8 text-center">
                                    <div class="flex justify-center items-center">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                        <span class="ml-3 text-gray-500">Memuat data...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t flex justify-end">
            <button type="button" 
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-200"
                    onclick="tutupModalDetail()">
                Tutup
            </button>
        </div>
    </div>
</div>

@endsection