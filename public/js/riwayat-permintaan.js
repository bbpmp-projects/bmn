// File: /public/js/riwayat-permintaan.js
// Fungsi untuk halaman riwayat permintaan

let currentPage = 1;
let itemsPerPage = 10;
let totalItems = 0;
let currentFilter = {
    status: '',
    tanggal_dari: '',
    tanggal_sampai: ''
};
let csrfToken = null;

// Data dummy untuk simulasi - HANYA approved dan rejected
const dummyData = [
    {
        id: 1,
        kode_referensi: 'PR-202412-0001',
        tanggal: '2024-12-01',
        jumlah_barang: 3,
        total_item: 15,
        status: 'approved',
        catatan: 'Permintaan disetujui oleh admin. Barang akan dikirim sesuai jadwal.',
        nama_pemohon: 'John Doe',
        unit_kerja: 'IT Department',
        nip: '198701012023010001',
        email: 'john.doe@example.com',
        barang: [
            { kode: 'BRG001', nama: 'Laptop Dell XPS 13', jumlah: 5, satuan: 'Unit' },
            { kode: 'BRG002', nama: 'Mouse Wireless Logitech', jumlah: 8, satuan: 'Pcs' },
            { kode: 'BRG003', nama: 'Keyboard Mechanical', jumlah: 2, satuan: 'Unit' }
        ]
    },
    {
        id: 2,
        kode_referensi: 'PR-202412-0002',
        tanggal: '2024-12-02',
        jumlah_barang: 2,
        total_item: 10,
        status: 'rejected',
        catatan: 'Stok barang tidak tersedia. Silakan ajukan permintaan kembali bulan depan.',
        nama_pemohon: 'Jane Smith',
        unit_kerja: 'HR Department',
        nip: '199002152023010002',
        email: 'jane.smith@example.com',
        barang: [
            { kode: 'BRG004', nama: 'Printer HP LaserJet', jumlah: 3, satuan: 'Unit' },
            { kode: 'BRG005', nama: 'Kertas A4', jumlah: 7, satuan: 'Rim' }
        ]
    },
    {
        id: 3,
        kode_referensi: 'PR-202412-0005',
        tanggal: '2024-12-05',
        jumlah_barang: 4,
        total_item: 22,
        status: 'approved',
        catatan: 'Permintaan disetujui sebagian. Beberapa barang dikurangi jumlahnya.',
        nama_pemohon: 'Robert Johnson',
        unit_kerja: 'Finance Department',
        nip: '198511302023010003',
        email: 'robert.j@example.com',
        barang: [
            { kode: 'BRG006', nama: 'Monitor 24"', jumlah: 3, satuan: 'Unit' },
            { kode: 'BRG007', nama: 'Webcam Logitech', jumlah: 4, satuan: 'Unit' },
            { kode: 'BRG008', nama: 'Headset Gaming', jumlah: 6, satuan: 'Unit' },
            { kode: 'BRG009', nama: 'USB Flash Drive 64GB', jumlah: 9, satuan: 'Pcs' }
        ]
    },
    {
        id: 4,
        kode_referensi: 'PR-202412-0006',
        tanggal: '2024-12-06',
        jumlah_barang: 1,
        total_item: 50,
        status: 'rejected',
        catatan: 'Permintaan melebihi batas kuota per departemen.',
        nama_pemohon: 'Sarah Williams',
        unit_kerja: 'Marketing Department',
        nip: '199308212023010004',
        email: 'sarah.w@example.com',
        barang: [
            { kode: 'BRG010', nama: 'Bolpoin Standard', jumlah: 50, satuan: 'Pcs' }
        ]
    }
];

// Tambahkan lebih banyak data dummy - HANYA approved dan rejected
for (let i = 7; i <= 25; i++) {
    const statuses = ['approved', 'rejected']; // Hanya dua status
    const status = statuses[Math.floor(Math.random() * statuses.length)];
    
    dummyData.push({
        id: i,
        kode_referensi: `PR-202412-${String(i).padStart(4, '0')}`,
        tanggal: `2024-12-${String(Math.floor(Math.random() * 15) + 1).padStart(2, '0')}`,
        jumlah_barang: Math.floor(Math.random() * 5) + 1,
        total_item: Math.floor(Math.random() * 50) + 1,
        status: status,
        catatan: status === 'approved' ? 
            ['Permintaan disetujui sepenuhnya', 'Disetujui dengan catatan', 'Barang akan dikirim minggu depan'][Math.floor(Math.random() * 3)] : 
            ['Stok tidak mencukupi', 'Melebihi anggaran', 'Tidak sesuai dengan kebutuhan kerja'][Math.floor(Math.random() * 3)],
        nama_pemohon: `User ${i}`,
        unit_kerja: ['IT Department', 'HR Department', 'Finance Department', 'Marketing Department'][Math.floor(Math.random() * 4)],
        nip: `1990${String(Math.floor(Math.random() * 12) + 1).padStart(2, '0')}${String(Math.floor(Math.random() * 28) + 1).padStart(2, '0')}202301000${i}`,
        email: `user${i}@example.com`,
        barang: Array.from({length: Math.floor(Math.random() * 5) + 1}, (_, idx) => ({
            kode: `BRG${String(i).padStart(3, '0')}${idx + 1}`,
            nama: `Barang ${i}-${idx + 1}`,
            jumlah: Math.floor(Math.random() * 20) + 1,
            satuan: ['Unit', 'Pcs', 'Rim', 'Pack'][Math.floor(Math.random() * 4)]
        }))
    });
}

// Fungsi untuk format tanggal
function formatTanggal(tanggal) {
    const date = new Date(tanggal);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Fungsi untuk mendapatkan warna status
function getStatusColor(status) {
    const colors = {
        'approved': 'bg-green-100 text-green-800',
        'rejected': 'bg-red-100 text-red-800'
    };
    return colors[status] || 'bg-gray-100 text-gray-800';
}

// Fungsi untuk filter data - HANYA tampilkan approved dan rejected
function filterData(data) {
    // Filter utama: hanya tampilkan approved dan rejected
    let filtered = data.filter(item => 
        item.status === 'approved' || item.status === 'rejected'
    );
    
    // Filter tambahan berdasarkan input user
    return filtered.filter(item => {
        // Filter status (jika dipilih)
        if (currentFilter.status && item.status !== currentFilter.status) {
            return false;
        }
        
        // Filter tanggal
        if (currentFilter.tanggal_dari) {
            const tanggalItem = new Date(item.tanggal);
            const tanggalDari = new Date(currentFilter.tanggal_dari);
            if (tanggalItem < tanggalDari) return false;
        }
        
        if (currentFilter.tanggal_sampai) {
            const tanggalItem = new Date(item.tanggal);
            const tanggalSampai = new Date(currentFilter.tanggal_sampai);
            if (tanggalItem > tanggalSampai) return false;
        }
        
        return true;
    });
}

// Fungsi untuk update statistik - HANYA approved dan rejected
function updateStatistics(data) {
    const stats = {
        approved: 0,
        rejected: 0
    };
    
    data.forEach(item => {
        if (stats[item.status] !== undefined) {
            stats[item.status]++;
        }
    });
    
    document.getElementById('stat-approved').textContent = stats.approved;
    document.getElementById('stat-rejected').textContent = stats.rejected;
}

// Fungsi untuk render tabel
function renderTable(data) {
    const tbody = document.getElementById('riwayat-table-body');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, data.length);
    const pageData = data.slice(startIndex, endIndex);
    
    // Update total data
    totalItems = data.length;
    document.getElementById('total-data').textContent = `${totalItems} data ditemukan`;
    
    // Jika tidak ada data
    if (pageData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                    <p class="text-lg mb-2">Tidak ada data riwayat ditemukan</p>
                    <p class="text-sm">Belum ada permintaan yang telah diproses (diterima/ditolak)</p>
                </td>
            </tr>
        `;
        return;
    }
    
    // Render data
    tbody.innerHTML = pageData.map(item => `
        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
            <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">${item.kode_referensi}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-700">${formatTanggal(item.tanggal)}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-700">${item.jumlah_barang} jenis</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-700">${item.total_item} item</div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium ${getStatusColor(item.status)}">
                    ${item.status === 'approved' ? 'DITERIMA' : 'DITOLAK'}
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-700 max-w-xs truncate" title="${item.catatan || 'Tidak ada catatan'}">
                    ${item.catatan || '-'}
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="flex space-x-2">
                    <button type="button" 
                            class="text-blue-600 hover:text-blue-800 btn-detail-riwayat"
                            data-id="${item.id}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" 
                            class="text-green-600 hover:text-green-800 btn-print-riwayat"
                            data-id="${item.id}">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
    
    // Update pagination
    updatePagination(data.length);
    
    // Tambahkan event listener ke tombol detail
    document.querySelectorAll('.btn-detail-riwayat').forEach(button => {
        button.addEventListener('click', function() {
            const id = parseInt(this.getAttribute('data-id'));
            const item = data.find(d => d.id === id);
            if (item) {
                bukaModalDetail(item);
            }
        });
    });
    
    // Tambahkan event listener ke tombol print
    document.querySelectorAll('.btn-print-riwayat').forEach(button => {
        button.addEventListener('click', function() {
            const id = parseInt(this.getAttribute('data-id'));
            printPermintaan(id);
        });
    });
}

// Fungsi untuk update pagination
function updatePagination(totalData) {
    const totalPages = Math.ceil(totalData / itemsPerPage);
    
    // Update info pagination
    const start = Math.min((currentPage - 1) * itemsPerPage + 1, totalData);
    const end = Math.min(currentPage * itemsPerPage, totalData);
    
    document.getElementById('pagination-start').textContent = start;
    document.getElementById('pagination-end').textContent = end;
    document.getElementById('pagination-total').textContent = totalData;
    
    // Update tombol prev/next
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

// Fungsi untuk memuat data
async function loadData() {
    try {
        // Tampilkan loading
        document.getElementById('riwayat-table-body').innerHTML = `
            <tr id="loading-row">
                <td colspan="7" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                        <p class="text-gray-500">Memuat data riwayat...</p>
                    </div>
                </td>
            </tr>
        `;
        
        // Simulasi delay API
        await new Promise(resolve => setTimeout(resolve, 500));
        
        // Filter data dummy (nanti diganti dengan API call)
        let filteredData = filterData(dummyData);
        
        // Update statistik
        updateStatistics(filteredData);
        
        // Render tabel
        renderTable(filteredData);
        
    } catch (error) {
        console.error('Error loading data:', error);
        document.getElementById('riwayat-table-body').innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-red-500">
                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                    <p class="text-lg mb-2">Gagal memuat data</p>
                    <p class="text-sm">${error.message}</p>
                    <button onclick="loadData()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-redo mr-2"></i> Coba Lagi
                    </button>
                </td>
            </tr>
        `;
    }
}

// Fungsi untuk membuka modal detail
function bukaModalDetail(item) {
    // Isi data ke modal
    document.getElementById('modal-kode-permintaan').textContent = item.kode_referensi;
    document.getElementById('modal-tanggal-permintaan').textContent = formatTanggal(item.tanggal);
    document.getElementById('modal-status-permintaan').textContent = item.status === 'approved' ? 'DITERIMA' : 'DITOLAK';
    document.getElementById('modal-jumlah-barang').textContent = item.jumlah_barang + ' jenis';
    document.getElementById('modal-nama-pemohon').textContent = item.nama_pemohon;
    document.getElementById('modal-unit-kerja').textContent = item.unit_kerja;
    document.getElementById('modal-nip').textContent = item.nip;
    document.getElementById('modal-email').textContent = item.email;
    
    // Update warna status
    const statusElement = document.getElementById('modal-status-permintaan');
    statusElement.className = `px-3 py-1 rounded-full text-xs font-medium ${getStatusColor(item.status)}`;
    
    // Isi catatan jika ada
    const catatanContainer = document.getElementById('modal-catatan-container');
    const catatanElement = document.getElementById('modal-catatan');
    if (item.catatan) {
        catatanElement.textContent = item.catatan;
        catatanContainer.classList.remove('hidden');
    } else {
        catatanContainer.classList.add('hidden');
    }
    
    // Isi daftar barang
    const tbody = document.getElementById('modal-daftar-barang');
    if (item.barang && item.barang.length > 0) {
        tbody.innerHTML = item.barang.map((barang, index) => `
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-4 py-3 text-sm text-center text-gray-700">${index + 1}</td>
                <td class="px-4 py-3 text-sm text-gray-700">${barang.kode}</td>
                <td class="px-4 py-3 text-sm text-gray-700">${barang.nama}</td>
                <td class="px-4 py-3 text-sm text-center text-gray-700">${barang.jumlah}</td>
                <td class="px-4 py-3 text-sm text-center text-gray-700">${barang.satuan}</td>
            </tr>
        `).join('');
    } else {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                    <i class="fas fa-box-open text-2xl mb-2"></i>
                    <p>Tidak ada data barang</p>
                </td>
            </tr>
        `;
    }
    
    // Tampilkan modal
    document.getElementById('modal-detail-permintaan').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

// Fungsi untuk menutup modal detail
function tutupModalDetail() {
    document.getElementById('modal-detail-permintaan').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Fungsi untuk print permintaan
function printPermintaan(id) {
    const item = dummyData.find(d => d.id === id);
    if (item) {
        // Simulasi print - buka new window dengan data permintaan
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Cetak Permintaan ${item.kode_referensi}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .header h1 { color: #333; }
                    .info { margin-bottom: 20px; }
                    .info table { width: 100%; border-collapse: collapse; }
                    .info td { padding: 8px; border: 1px solid #ddd; }
                    .info td:first-child { font-weight: bold; width: 200px; }
                    .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    .table th { background-color: #f5f5f5; padding: 10px; border: 1px solid #ddd; text-align: left; }
                    .table td { padding: 10px; border: 1px solid #ddd; }
                    .status { padding: 5px 10px; border-radius: 3px; font-weight: bold; }
                    .approved { background-color: #d4edda; color: #155724; }
                    .rejected { background-color: #f8d7da; color: #721c24; }
                    @media print {
                        body { margin: 0; }
                        .no-print { display: none; }
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>DETAIL PERMINTAAN BARANG</h1>
                    <p>${item.kode_referensi}</p>
                </div>
                
                <div class="info">
                    <table>
                        <tr>
                            <td>Kode Permintaan</td>
                            <td>${item.kode_referensi}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Permintaan</td>
                            <td>${formatTanggal(item.tanggal)}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="status ${item.status === 'approved' ? 'approved' : 'rejected'}">
                                    ${item.status === 'approved' ? 'DITERIMA' : 'DITOLAK'}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pemohon</td>
                            <td>${item.nama_pemohon}</td>
                        </tr>
                        <tr>
                            <td>Unit Kerja</td>
                            <td>${item.unit_kerja}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>${item.nip}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>${item.catatan || '-'}</td>
                        </tr>
                    </table>
                </div>
                
                <h3>Daftar Barang</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${item.barang.map((barang, index) => `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${barang.kode}</td>
                                <td>${barang.nama}</td>
                                <td>${barang.jumlah}</td>
                                <td>${barang.satuan}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                
                <div style="margin-top: 50px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%;">
                                <p>Pemohon,</p>
                                <br><br><br>
                                <p><strong>${item.nama_pemohon}</strong></p>
                                <p>${item.nip}</p>
                            </td>
                            <td style="width: 50%; text-align: right;">
                                <p>Mengetahui,</p>
                                <br><br><br>
                                <p><strong>Admin Gudang</strong></p>
                                <p>_________________________</p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="no-print" style="margin-top: 30px; text-align: center;">
                    <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Cetak Dokumen
                    </button>
                    <button onclick="window.close()" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                        Tutup
                    </button>
                </div>
                
                <script>
                    window.onload = function() {
                        // Auto print jika diinginkan
                        // window.print();
                    }
                </script>
            </body>
            </html>
        `);
        printWindow.document.close();
    } else {
        alert(`Data permintaan tidak ditemukan`);
    }
}

// Fungsi untuk terapkan filter
function applyFilter() {
    currentFilter.status = document.getElementById('filter-status').value;
    currentFilter.tanggal_dari = document.getElementById('filter-tanggal-dari').value;
    currentFilter.tanggal_sampai = document.getElementById('filter-tanggal-sampai').value;
    
    currentPage = 1; // Reset ke halaman pertama
    loadData();
}

// Fungsi untuk reset filter
function resetFilter() {
    document.getElementById('filter-status').value = '';
    document.getElementById('filter-tanggal-dari').value = '';
    document.getElementById('filter-tanggal-sampai').value = '';
    
    currentFilter = {
        status: '',
        tanggal_dari: '',
        tanggal_sampai: ''
    };
    
    currentPage = 1;
    loadData();
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Ambil token CSRF
    csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Set tanggal default (90 hari terakhir)
    const today = new Date();
    const ninetyDaysAgo = new Date();
    ninetyDaysAgo.setDate(today.getDate() - 90);
    
    document.getElementById('filter-tanggal-dari').valueAsDate = ninetyDaysAgo;
    document.getElementById('filter-tanggal-sampai').valueAsDate = today;
    
    // Event listeners
    document.getElementById('btn-apply-filter').addEventListener('click', applyFilter);
    document.getElementById('btn-reset-filter').addEventListener('click', resetFilter);
    document.getElementById('btn-refresh').addEventListener('click', loadData);
    document.getElementById('btn-prev').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            loadData();
        }
    });
    document.getElementById('btn-next').addEventListener('click', () => {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadData();
        }
    });
    
    // Event listener untuk klik di luar modal
    const modal = document.getElementById('modal-detail-permintaan');
    if (modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === this) {
                tutupModalDetail();
            }
        });
    }
    
    // Event listener untuk tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            tutupModalDetail();
        }
    });
    
    // Muat data pertama kali
    loadData();
});