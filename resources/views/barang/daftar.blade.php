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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Daftar Barang</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Barang</h1>
                        <p class="text-gray-600">Lihat daftar barang yang tersedia untuk permintaan</p>
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
                <!-- Filter Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                    <select id="filter-kategori" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <!--  Filter Status Ketersediaan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status Ketersediaan
                    </label>
                    <select id="filter-status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                                focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="tidak_tersedia">Tidak Tersedia</option>
                    </select>
                </div>
                
                <!-- Pencarian -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang</label>
                    <div class="relative">
                        <input type="text" 
                               id="search-barang" 
                               placeholder="Cari berdasarkan nama atau kode barang..."
                               class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute left-3 top-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg mr-4">
                        <i class="fas fa-boxes text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Barang</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-total">{{ $totalBarang ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tersedia</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-tersedia">{{ $barangTersedia ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg mr-4">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tidak Tersedia</p>
                        <p class="text-2xl font-bold text-gray-900" id="stat-tidak-tersedia">{{ $barangTidakTersedia ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Barang -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Barang</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500" id="total-data">0 barang ditemukan</span>
                    <button id="btn-refresh" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            
            <!-- Loading State -->
            <div id="loading-container" class="p-8">
                <div class="flex flex-col items-center justify-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                    <p class="text-gray-500">Memuat data barang...</p>
                </div>
            </div>
            
            <!-- Grid Barang -->
            <div id="barang-container" class="hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="barang-grid">
                    <!-- Barang akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <!-- Empty State -->
            <div id="empty-container" class="hidden p-8 text-center">
                <i class="fas fa-box-open text-4xl mb-4 text-gray-300"></i>
                <p class="text-gray-500">Tidak ada barang ditemukan</p>
                <p class="text-sm text-gray-400 mt-1">Coba ubah filter atau kata pencarian</p>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 hidden" id="pagination-container">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="text-sm text-gray-500 mb-4 md:mb-0">
                        Menampilkan <span id="pagination-start">0</span> - <span id="pagination-end">0</span> dari <span id="pagination-total">0</span> barang
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
        </div>
        
    </div>
</div>

<!-- Modal Detail Barang -->
<div id="modal-detail-barang" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Detail Barang</h3>
            <button type="button" 
                    class="text-gray-400 hover:text-gray-500 text-2xl font-semibold leading-none"
                    onclick="tutupModalDetailBarang()">
                &times;
            </button>
        </div>
        
        <!-- Modal Content -->
        <div class="mt-4">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Kode Barang</p>
                    <p class="font-medium text-gray-900" id="modal-kode-barang">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nama Barang</p>
                    <p class="font-medium text-gray-900" id="modal-nama-barang">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-medium text-gray-900" id="modal-kategori">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Satuan</p>
                    <p class="font-medium text-gray-900" id="modal-satuan">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Ketersediaan</p>
                    <span class="px-3 py-1 rounded-full text-xs font-medium" id="modal-status">-</span>
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t flex justify-end">
            <button type="button" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 mr-2"
                    onclick="tambahKePermintaan()">
                <i class="fas fa-plus mr-2"></i> Tambah ke Permintaan
            </button>
            <button type="button" 
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-200"
                    onclick="tutupModalDetailBarang()">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let totalPages = 1;
    let totalItems = 0;
    let perPage = 12;
    let filterKategori = '';
    let searchQuery = '';
    let filterStatus = '';
    let currentBarangDetail = null;

    // Load data pertama kali
    loadData();

    // Event listener untuk filter kategori
    const filterKategoriEl = document.getElementById('filter-kategori');
    if (filterKategoriEl) {
        filterKategoriEl.addEventListener('change', function() {
            filterKategori = this.value;
            currentPage = 1;
            loadData();
        });
    }

    // Event listener untuk filter status
    const filterStatusEl = document.getElementById('filter-status');
    if (filterStatusEl) {
        filterStatusEl.addEventListener('change', function() {
            filterStatus = this.value;   // '' | 'tersedia' | 'tidak_tersedia'
            currentPage = 1;
            loadData();
        });
    }

    // Event listener search (enter)
    const searchBarangEl = document.getElementById('search-barang');
    if (searchBarangEl) {
        searchBarangEl.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                searchQuery = this.value;
                currentPage = 1;
                loadData();
            }
        });
    }

    // Tombol apply filter
    const btnApplyFilter = document.getElementById('btn-apply-filter');
    if (btnApplyFilter) {
        btnApplyFilter.addEventListener('click', function() {
            searchQuery = searchBarangEl ? searchBarangEl.value : '';
            currentPage = 1;
            loadData();
        });
    }

    // Tombol reset filter
    const btnResetFilter = document.getElementById('btn-reset-filter');
    if (btnResetFilter) {
        btnResetFilter.addEventListener('click', function() {
            if (filterKategoriEl) filterKategoriEl.value = '';
            if (searchBarangEl) searchBarangEl.value = '';

            filterKategori = '';
            searchQuery = '';
            filterStatus = '';
            currentPage = 1;

            loadData();
        });
    }

    // Tombol refresh
    const btnRefresh = document.getElementById('btn-refresh');
    if (btnRefresh) {
        btnRefresh.addEventListener('click', function() {
            loadData();
        });
    }

    // Pagination previous
    const btnPrev = document.getElementById('btn-prev');
    if (btnPrev) {
        btnPrev.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadData();
            }
        });
    }

    // Pagination next
    const btnNext = document.getElementById('btn-next');
    if (btnNext) {
        btnNext.addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                loadData();
            }
        });
    }

    // Fungsi untuk memuat data dari server
    async function loadData() {
        const loadingContainer = document.getElementById('loading-container');
        const barangContainer = document.getElementById('barang-container');
        const emptyContainer = document.getElementById('empty-container');
        const paginationContainer = document.getElementById('pagination-container');

        if (loadingContainer) loadingContainer.classList.remove('hidden');
        if (barangContainer) barangContainer.classList.add('hidden');
        if (emptyContainer) emptyContainer.classList.add('hidden');
        if (paginationContainer) paginationContainer.classList.add('hidden');

        try {
            const params = new URLSearchParams({
                page: currentPage,
                kategori: filterKategori,
                search: searchQuery,
                status: filterStatus
            });

            const response = await fetch(`/barang/daftar?${params.toString()}&ajax=1`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!data || !data.success) {
                throw new Error('Response tidak valid');
            }

            // Update pagination info global
            totalPages = data.last_page || 1;
            totalItems = data.total || 0;
            perPage = data.per_page || 12;

            if (loadingContainer) loadingContainer.classList.add('hidden');

            if (!data.data || data.data.length === 0) {
                if (emptyContainer) emptyContainer.classList.remove('hidden');
                if (barangContainer) barangContainer.classList.add('hidden');
                if (paginationContainer) paginationContainer.classList.add('hidden');
            } else {
                if (emptyContainer) emptyContainer.classList.add('hidden');
                if (barangContainer) barangContainer.classList.remove('hidden');
                if (paginationContainer) paginationContainer.classList.remove('hidden');

                updatePaginationInfo(data);
                updateBarangGrid(data.data);
                updateStatistics(data.statistics); // <<< PENTING: kirim objek statistik
            }
        } catch (error) {
            console.error('Error loading data:', error);

            if (loadingContainer) loadingContainer.classList.add('hidden');
            if (emptyContainer) {
                emptyContainer.classList.remove('hidden');
                emptyContainer.innerHTML = `
                    <i class="fas fa-exclamation-triangle text-4xl mb-4 text-red-300"></i>
                    <p class="text-red-500">Gagal memuat data. Silakan coba lagi.</p>
                `;
            }
        }
    }

    // Fungsi untuk mengupdate tulisan info pagination
    function updatePaginationInfo(data) {
        const totalDataEl = document.getElementById('total-data');
        const pageInfoEl = document.getElementById('page-info');

        if (totalDataEl) {
            totalDataEl.textContent = `${data.total || 0} barang ditemukan`;
        }

        if (pageInfoEl) {
            pageInfoEl.textContent = `Halaman ${data.current_page || 1} dari ${data.last_page || 1}`;
        }

        // Render tombol angka halaman
        const paginationNumbers = document.getElementById('pagination-numbers');
        if (!paginationNumbers) return;

        paginationNumbers.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.className =
                'px-3 py-1 text-sm rounded-md border ' +
                (i === currentPage
                    ? 'bg-blue-600 text-white border-blue-600'
                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50');

            button.addEventListener('click', function() {
                if (currentPage !== i) {
                    currentPage = i;
                    loadData();
                }
            });

            paginationNumbers.appendChild(button);
        }
    }

    // Fungsi untuk mengupdate grid barang
    function updateBarangGrid(items) {
        const barangGrid = document.getElementById('barang-grid');
        if (!barangGrid) return;

        let html = '';

        items.forEach(function(item) {
            const stock = item.stock || 0;
            const status = stock > 0 ? 'Tersedia' : 'Tidak Tersedia';
            const statusColor = stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
            const statusIcon = stock > 0 ? 'fa-check-circle' : 'fa-times-circle';
            const cardBorder = stock > 0 ? 'border-green-200' : 'border-red-200';

            const kategoriNama = item.kategori ? (item.kategori.nama_kategori || '-') : '-';
            const satuan = item.satuan || '-';

            html += `
                <div class="bg-white border ${cardBorder} rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium ${statusColor}">
                                    <i class="fas ${statusIcon} mr-1"></i> ${status}
                                </span>
                            </div>
                            <button
                                class="text-gray-400 hover:text-gray-600 btn-detail-barang"
                                data-kode="${item.kode_barang}"
                                data-nama="${item.nama_barang}"
                                data-kategori="${kategoriNama}"
                                data-satuan="${satuan}"
                                data-status="${status}">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 mb-1">Kode Barang</p>
                        <p class="font-semibold text-gray-900 mb-4">${item.kode_barang}</p>

                        <p class="text-xs text-gray-500 mb-1">Nama Barang</p>
                        <p class="font-medium text-gray-900 mb-4">${item.nama_barang}</p>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-gray-500">Kategori</p>
                                <p class="font-medium text-gray-900">${kategoriNama}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Satuan</p>
                                <p class="font-medium text-gray-900">${satuan}</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <button
                                class="w-full px-4 py-2 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 transition duration-200 btn-detail-barang"
                                data-kode="${item.kode_barang}"
                                data-nama="${item.nama_barang}"
                                data-kategori="${kategoriNama}"
                                data-satuan="${satuan}"
                                data-status="${status}">
                                <i class="fas fa-info-circle mr-2"></i> Detail Barang
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        barangGrid.innerHTML = html;

        // Re-attach event listener tombol detail
        document.querySelectorAll('.btn-detail-barang').forEach(function(button) {
            button.addEventListener('click', function() {
                const kodeBarang = this.getAttribute('data-kode');
                const namaBarang = this.getAttribute('data-nama');
                const kategori = this.getAttribute('data-kategori');
                const satuan = this.getAttribute('data-satuan');
                const status = this.getAttribute('data-status');

                currentBarangDetail = {
                    kode_barang: kodeBarang,
                    nama_barang: namaBarang,
                    kategori: kategori,
                    satuan: satuan,
                    status: status
                };

                bukaModalDetailBarang(
                    kodeBarang,
                    namaBarang,
                    kategori,
                    satuan,
                    status
                );
            });
        });
    }

    // Fungsi untuk mengupdate statistik
    function updateStatistics(statistics) {
        if (!statistics) return;

        const statTotal = document.getElementById('stat-total');
        const statTersedia = document.getElementById('stat-tersedia');
        const statTidakTersedia = document.getElementById('stat-tidak-tersedia');

        if (statTotal) statTotal.textContent = statistics.total || 0;
        if (statTersedia) statTersedia.textContent = statistics.tersedia || 0;
        if (statTidakTersedia) statTidakTersedia.textContent = statistics.tidak_tersedia || 0;
    }

    // Modal detail barang
    window.bukaModalDetailBarang = function(kodeBarang, namaBarang, kategori, satuan, status) {
        document.getElementById('modal-kode-barang').textContent = kodeBarang;
        document.getElementById('modal-nama-barang').textContent = namaBarang;
        document.getElementById('modal-kategori').textContent = kategori;
        document.getElementById('modal-satuan').textContent = satuan;

        const statusElement = document.getElementById('modal-status');
        statusElement.textContent = status;

        if (status === 'Tersedia') {
            statusElement.className = 'px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
        } else {
            statusElement.className = 'px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
        }

        document.getElementById('modal-detail-barang').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    window.tutupModalDetailBarang = function() {
        document.getElementById('modal-detail-barang').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    window.tambahKePermintaan = function() {
        tutupModalDetailBarang();
        window.location.href = "{{ route('permintaan.index') }}";
    };

    const modalBarang = document.getElementById('modal-detail-barang');
    if (modalBarang) {
        modalBarang.addEventListener('click', function(event) {
            if (event.target === this) {
                tutupModalDetailBarang();
            }
        });
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            tutupModalDetailBarang();
        }
    });
});
</script>
@endpush

@endsection