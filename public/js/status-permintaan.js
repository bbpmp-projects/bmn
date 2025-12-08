// File: /public/js/status-permintaan.js
// Fungsi untuk modal detail permintaan

// Global variable untuk menyimpan token CSRF
let csrfToken = null;

// Fungsi untuk membuka modal detail
function bukaModalDetail(kodePermintaan, idPermintaan) {
    // Reset isi modal
    document.getElementById('modal-kode-permintaan').textContent = '-';
    document.getElementById('modal-tanggal-permintaan').textContent = '-';
    document.getElementById('modal-status-permintaan').textContent = '-';
    document.getElementById('modal-jumlah-barang').textContent = '-';
    document.getElementById('modal-nama-pemohon').textContent = '-';
    document.getElementById('modal-unit-kerja').textContent = '-';
    
    // Tampilkan loading di tabel
    document.getElementById('modal-daftar-barang').innerHTML = `
        <tr id="modal-loading">
            <td colspan="5" class="px-4 py-8 text-center">
                <div class="flex justify-center items-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    <span class="ml-3 text-gray-500">Memuat data...</span>
                </div>
            </td>
        </tr>
    `;
    
    // Tampilkan modal
    document.getElementById('modal-detail-permintaan').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Ambil data detail permintaan via AJAX
    fetchDetailPermintaan(idPermintaan, kodePermintaan);
}

// Fungsi untuk mengambil data detail permintaan
async function fetchDetailPermintaan(idPermintaan, kodePermintaan) {
    try {
        if (!csrfToken) {
            csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }
        
        const response = await fetch(`/permintaan/detail-data/${idPermintaan}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Isi data ke modal
            const permintaan = data.data;
            
            document.getElementById('modal-kode-permintaan').textContent = kodePermintaan;
            document.getElementById('modal-tanggal-permintaan').textContent = permintaan.tanggal_formatted;
            document.getElementById('modal-status-permintaan').textContent = permintaan.status.toUpperCase();
            document.getElementById('modal-jumlah-barang').textContent = permintaan.detail_permintaan.length + ' barang';
            document.getElementById('modal-nama-pemohon').textContent = permintaan.nama_pemohon;
            document.getElementById('modal-unit-kerja').textContent = permintaan.unit_kerja;
            
            // Update warna status
            const statusElement = document.getElementById('modal-status-permintaan');
            const statusColors = {
                'pending': 'bg-yellow-100 text-yellow-800',
                'approved': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
                'processed': 'bg-blue-100 text-blue-800'
            };
            statusElement.className = `px-3 py-1 rounded-full text-xs font-medium ${statusColors[permintaan.status] || 'bg-gray-100 text-gray-800'}`;
            
            // Isi daftar barang
            const tbody = document.getElementById('modal-daftar-barang');
            tbody.innerHTML = '';
            
            if (permintaan.detail_permintaan.length > 0) {
                permintaan.detail_permintaan.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = 'border-b border-gray-200 hover:bg-gray-50';
                    row.innerHTML = `
                        <td class="px-4 py-3 text-sm text-center text-gray-700">${index + 1}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">${item.kode_barang}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">${item.barang?.nama_barang || 'Tidak diketahui'}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-700">${item.jumlah}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-700">${item.barang?.satuan || '-'}</td>
                    `;
                    tbody.appendChild(row);
                });
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
        } else {
            throw new Error(data.message || 'Gagal memuat data');
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('modal-daftar-barang').innerHTML = `
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-red-500">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Gagal memuat data: ${error.message}</p>
                </td>
            </tr>
        `;
    }
}

// Fungsi untuk menutup modal detail
function tutupModalDetail() {
    document.getElementById('modal-detail-permintaan').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Ambil token CSRF
    csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Tambahkan event listener ke semua tombol detail
    document.querySelectorAll('.btn-detail-permintaan').forEach(button => {
        button.addEventListener('click', function() {
            const kodePermintaan = this.getAttribute('data-kode');
            const idPermintaan = this.getAttribute('data-id');
            bukaModalDetail(kodePermintaan, idPermintaan);
        });
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
});