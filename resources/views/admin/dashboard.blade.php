@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan Sistem Manajemen BMN')

@section('main-content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
    <!-- Total Barang -->
    <div class="card-stat">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-600 mb-1">Total Barang</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">1,234</h3>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                        <i class="fas fa-arrow-up mr-1"></i> +5.2%
                    </span>
                    <span class="text-xs text-gray-500 ml-2">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-blue-50 rounded-xl flex items-center justify-center ml-4">
                <i class="fas fa-boxes text-xl lg:text-2xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Permintaan Pending -->
    <div class="card-stat">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-600 mb-1">Permintaan Pending</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">23</h3>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
                        <i class="fas fa-clock mr-1"></i> Perlu diproses
                    </span>
                </div>
            </div>
            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-amber-50 rounded-xl flex items-center justify-center ml-4">
                <i class="fas fa-hourglass-half text-xl lg:text-2xl text-amber-600"></i>
            </div>
        </div>
    </div>

    <!-- Barang Dipinjam -->
    <div class="card-stat">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-600 mb-1">Barang Dipinjam</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">156</h3>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-purple-600 bg-purple-50 px-2 py-1 rounded-full">
                        <i class="fas fa-hand-holding mr-1"></i> Sedang digunakan
                    </span>
                </div>
            </div>
            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-purple-50 rounded-xl flex items-center justify-center ml-4">
                <i class="fas fa-handshake text-xl lg:text-2xl text-purple-600"></i>
            </div>
        </div>
    </div>

    <!-- Nilai Aset -->
    <div class="card-stat">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm text-gray-600 mb-1">Total Nilai Aset</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">Rp 2.5M</h3>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                        <i class="fas fa-money-bill-wave mr-1"></i> Dalam Rupiah
                    </span>
                </div>
            </div>
            <div class="w-12 h-12 lg:w-14 lg:h-14 bg-green-50 rounded-xl flex items-center justify-center ml-4">
                <i class="fas fa-chart-line text-xl lg:text-2xl text-green-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart 1: Statistik Peminjaman -->
    <div class="bg-white shadow-sm rounded-xl p-4 lg:p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                Statistik Peminjaman Bulanan
            </h3>
            <select class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>Tahun 2024</option>
                <option>Tahun 2023</option>
            </select>
        </div>
        <div class="h-[300px]">
            <canvas id="loanChart"></canvas>
        </div>
    </div>

    <!-- Chart 2: Kategori Barang -->
    <div class="bg-white shadow-sm rounded-xl p-4 lg:p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-chart-pie text-green-600 mr-3"></i>
                Distribusi Kategori Barang
            </h3>
        </div>
        <div class="h-[300px]">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activities & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="lg:col-span-2 bg-white shadow-sm rounded-xl p-4 lg:p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-history text-purple-600 mr-3"></i>
                Aktivitas Terbaru
            </h3>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
            </a>
        </div>
        
        <div class="space-y-4">
            <!-- Activity Item -->
            <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">Permintaan Disetujui</p>
                    <p class="text-xs text-gray-600 mt-0.5">Laptop Dell XPS 13 - Oleh Admin BMN</p>
                    <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                </div>
            </div>

            <!-- Activity Item -->
            <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-plus text-blue-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">Barang Baru Ditambahkan</p>
                    <p class="text-xs text-gray-600 mt-0.5">Proyektor Epson EB-X41 (5 unit)</p>
                    <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                </div>
            </div>

            <!-- Activity Item -->
            <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation text-amber-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">Permintaan Menunggu</p>
                    <p class="text-xs text-gray-600 mt-0.5">Kamera Canon EOS - Dari Dinas Pendidikan</p>
                    <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                </div>
            </div>

            <!-- Activity Item -->
            <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-undo text-red-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">Barang Dikembalikan</p>
                    <p class="text-xs text-gray-600 mt-0.5">Printer HP LaserJet - Oleh Bagian Keuangan</p>
                    <p class="text-xs text-gray-400 mt-1">2 hari yang lalu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow-sm rounded-xl p-4 lg:p-6 border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt text-yellow-500 mr-3"></i>
            Aksi Cepat
        </h3>
        
        <div class="space-y-3">
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg transition-all duration-300 font-medium flex items-center justify-between group">
                <span class="flex items-center">
                    <i class="fas fa-plus-circle mr-3"></i>
                    Tambah Barang Baru
                </span>
                <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </button>

            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-3 rounded-lg transition-all duration-300 font-medium flex items-center justify-between group">
                <span class="flex items-center">
                    <i class="fas fa-clipboard-check mr-3"></i>
                    Proses Permintaan
                </span>
                <span class="bg-white text-purple-600 text-xs px-2 py-1 rounded-full font-bold">3</span>
            </button>

            <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg transition-all duration-300 font-medium flex items-center justify-between group">
                <span class="flex items-center">
                    <i class="fas fa-file-export mr-3"></i>
                    Export Laporan
                </span>
                <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </button>

            <button class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-3 rounded-lg transition-all duration-300 font-medium flex items-center justify-between group">
                <span class="flex items-center">
                    <i class="fas fa-search mr-3"></i>
                    Cari Barang
                </span>
                <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </button>

            <button class="w-full bg-gray-700 hover:bg-gray-800 text-white px-4 py-3 rounded-lg transition-all duration-300 font-medium flex items-center justify-between group">
                <span class="flex items-center">
                    <i class="fas fa-cog mr-3"></i>
                    Pengaturan Sistem
                </span>
                <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
    </div>
</div>

@endsection

@section('chart-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart 1: Loan Statistics
    const loanCtx = document.getElementById('loanChart').getContext('2d');
    const loanChart = new Chart(loanCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Peminjaman',
                data: [65, 59, 80, 81, 56, 55, 70, 85, 90, 75, 82, 88],
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 4
            },
            {
                label: 'Pengembalian',
                data: [45, 49, 60, 71, 46, 45, 60, 75, 80, 65, 72, 78],
                backgroundColor: 'rgba(34, 197, 94, 0.8)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Chart 2: Category Distribution
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Elektronik', 'Furniture', 'Kendaraan', 'Peralatan Kantor', 'Lainnya'],
            datasets: [{
                data: [35, 25, 15, 20, 5],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(249, 115, 22, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(156, 163, 175, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(249, 115, 22, 1)',
                    'rgba(168, 85, 247, 1)',
                    'rgba(156, 163, 175, 1)'
                ],
                borderWidth: 2,
                spacing: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed}%`;
                        }
                    }
                }
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        loanChart.resize();
        categoryChart.resize();
    });
});
</script>
@endsection