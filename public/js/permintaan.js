document.addEventListener('DOMContentLoaded', function() {
    // Set tanggal hari ini
    document.getElementById('tanggal-permintaan').valueAsDate = new Date();

    // Data dummy barang (static data)
    const dataBarang = {
        atk: [
            { kode: 'ATK001', nama: 'Pulpen Standard', satuan: 'pcs', stok: 100 },
            { kode: 'ATK002', nama: 'Buku Tulis A4', satuan: 'buah', stok: 50 },
            { kode: 'ATK003', nama: 'Kertas HVS A4', satuan: 'rim', stok: 20 },
            { kode: 'ATK004', nama: 'Stapler Standard', satuan: 'pcs', stok: 15 },
            { kode: 'ATK005', nama: 'Penghapus Whiteboard', satuan: 'pcs', stok: 30 },
            { kode: 'ATK006', nama: 'Spidol Whiteboard', satuan: 'pcs', stok: 25 },
            { kode: 'ATK007', nama: 'Amplop Coklat', satuan: 'pak', stok: 40 },
            { kode: 'ATK008', nama: 'Clip Kertas', satuan: 'kotak', stok: 30 }
        ],
        elektronik: [
            { kode: 'ELK001', nama: 'Laptop Dell Latitude', satuan: 'unit', stok: 5 },
            { kode: 'ELK002', nama: 'Printer HP LaserJet', satuan: 'unit', stok: 3 },
            { kode: 'ELK003', nama: 'Proyektor Epson', satuan: 'unit', stok: 2 },
            { kode: 'ELK004', nama: 'Scanner Canon', satuan: 'unit', stok: 4 },
            { kode: 'ELK005', nama: 'Monitor 24 inch', satuan: 'unit', stok: 8 },
            { kode: 'ELK006', nama: 'Keyboard Wireless', satuan: 'unit', stok: 12 },
            { kode: 'ELK007', nama: 'Mouse Wireless', satuan: 'unit', stok: 15 }
        ],
        furniture: [
            { kode: 'FUR001', nama: 'Meja Kerja Kayu', satuan: 'unit', stok: 10 },
            { kode: 'FUR002', nama: 'Kursi Kantor Ergonomis', satuan: 'unit', stok: 8 },
            { kode: 'FUR003', nama: 'Lemari Arsip 2 Pintu', satuan: 'unit', stok: 5 },
            { kode: 'FUR004', nama: 'Filling Cabinet', satuan: 'unit', stok: 6 },
            { kode: 'FUR005', nama: 'Meja Rapat', satuan: 'unit', stok: 3 },
            { kode: 'FUR006', nama: 'Kursi Tamu', satuan: 'unit', stok: 4 }
        ],
        kendaraan: [
            { kode: 'KDR001', nama: 'Mobil Dinas Toyota', satuan: 'unit', stok: 2 },
            { kode: 'KDR002', nama: 'Motor Dinas Honda', satuan: 'unit', stok: 4 }
        ],
        lainnya: [
            { kode: 'LNY001', nama: 'AC Split 1 PK', satuan: 'unit', stok: 3 },
            { kode: 'LNY002', nama: 'Water Dispenser', satuan: 'unit', stok: 2 },
            { kode: 'LNY003', nama: 'Mesin Fax', satuan: 'unit', stok: 1 },
            { kode: 'LNY004', nama: 'Whiteboard 120x90', satuan: 'unit', stok: 4 }
        ]
    };

    let barangDipilih = null;
    let keranjangBarang = [];

    // Event listener untuk kategori barang
    document.getElementById('kategori-barang').addEventListener('change', function() {
        const searchInput = document.getElementById('search-barang');
        if (this.value) {
            searchInput.disabled = false;
            searchInput.focus();
        } else {
            searchInput.disabled = true;
            searchInput.value = '';
            hideDaftarBarang();
        }
    });

    // Event listener untuk pencarian barang
    document.getElementById('search-barang').addEventListener('input', function() {
        const kategori = document.getElementById('kategori-barang').value;
        const keyword = this.value.toLowerCase();
        
        if (kategori && keyword.length >= 2) {
            searchBarang(kategori, keyword);
        } else {
            hideDaftarBarang();
        }
    });

    // Fungsi pencarian barang
    function searchBarang(kategori, keyword) {
        const hasil = dataBarang[kategori].filter(barang => 
            barang.nama.toLowerCase().includes(keyword) || 
            barang.kode.toLowerCase().includes(keyword)
        );
        
        tampilkanHasilPencarian(hasil);
    }

    // Tampilkan hasil pencarian
    function tampilkanHasilPencarian(hasil) {
        const listBarang = document.getElementById('list-barang');
        const daftarBarang = document.getElementById('daftar-barang');
        
        if (hasil.length > 0) {
            listBarang.innerHTML = hasil.map(barang => `
                <div class="bg-white p-3 rounded-lg border border-gray-200 hover:border-blue-500 cursor-pointer transition duration-200 barang-item" 
                     data-kode="${barang.kode}" 
                     data-nama="${barang.nama}" 
                     data-satuan="${barang.satuan}"
                     data-stok="${barang.stok}">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-medium text-gray-900">${barang.nama}</div>
                            <div class="text-sm text-gray-600">Kode: ${barang.kode}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-600">Stok: ${barang.stok}</div>
                            <div class="text-sm text-gray-500">${barang.satuan}</div>
                        </div>
                    </div>
                </div>
            `).join('');
            
            daftarBarang.classList.remove('hidden');
            
            // Event listener untuk memilih barang
            document.querySelectorAll('.barang-item').forEach(item => {
                item.addEventListener('click', function() {
                    pilihBarang({
                        kode: this.dataset.kode,
                        nama: this.dataset.nama,
                        satuan: this.dataset.satuan,
                        stok: parseInt(this.dataset.stok)
                    });
                });
            });
        } else {
            listBarang.innerHTML = '<div class="text-center text-gray-500 py-4">Tidak ada barang ditemukan</div>';
            daftarBarang.classList.remove('hidden');
        }
    }

    // Sembunyikan daftar barang
    function hideDaftarBarang() {
        document.getElementById('daftar-barang').classList.add('hidden');
    }

    // Fungsi pilih barang
    function pilihBarang(barang) {
        barangDipilih = barang;
        document.getElementById('nama-barang-dipilih').textContent = barang.nama;
        document.getElementById('kode-barang-dipilih').textContent = `(${barang.kode})`;
        document.getElementById('stok-barang').textContent = `Stok tersedia: ${barang.stok}`;
        document.getElementById('satuan-barang').value = barang.satuan;
        document.getElementById('jumlah-barang').value = '';
        document.getElementById('jumlah-barang').max = barang.stok;
        document.getElementById('keterangan-barang').value = '';
        
        document.getElementById('form-jumlah').classList.remove('hidden');
        hideDaftarBarang();
    }

    // Event listener untuk batal pilih
    document.getElementById('batal-pilih').addEventListener('click', function() {
        barangDipilih = null;
        document.getElementById('form-jumlah').classList.add('hidden');
    });

    // Event listener untuk tambah ke keranjang
    document.getElementById('tambah-ke-keranjang').addEventListener('click', function() {
        const jumlah = parseInt(document.getElementById('jumlah-barang').value);
        const keterangan = document.getElementById('keterangan-barang').value;
        
        if (!jumlah || jumlah < 1) {
            alert('Masukkan jumlah yang valid');
            return;
        }
        
        if (jumlah > barangDipilih.stok) {
            alert('Jumlah melebihi stok yang tersedia');
            return;
        }
        
        // Tambah ke keranjang
        keranjangBarang.push({
            ...barangDipilih,
            jumlah: jumlah,
            keterangan: keterangan
        });
        
        // Update tabel
        updateTabelPermintaan();
        
        // Reset form
        barangDipilih = null;
        document.getElementById('form-jumlah').classList.add('hidden');
        document.getElementById('search-barang').value = '';
        document.getElementById('kategori-barang').value = '';
        document.getElementById('search-barang').disabled = true;
        
        // Enable submit button
        document.getElementById('submit-permintaan').disabled = false;
    });

    // Update tabel permintaan
    function updateTabelPermintaan() {
        const tbody = document.getElementById('tabel-permintaan');
        const emptyState = document.getElementById('empty-state');
        
        if (keranjangBarang.length > 0) {
            emptyState.style.display = 'none';
            
            tbody.innerHTML = keranjangBarang.map((barang, index) => `
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-700">${barang.kode}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${barang.nama}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${barang.jumlah}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${barang.satuan}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${barang.keterangan || '-'}</td>
                    <td class="px-6 py-4 text-sm">
                        <button class="text-red-600 hover:text-red-800 hapus-barang" data-index="${index}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
            
            // Event listener untuk hapus barang
            document.querySelectorAll('.hapus-barang').forEach(button => {
                button.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    keranjangBarang.splice(index, 1);
                    updateTabelPermintaan();
                    
                    if (keranjangBarang.length === 0) {
                        document.getElementById('submit-permintaan').disabled = true;
                    }
                });
            });
        } else {
            emptyState.style.display = '';
            tbody.innerHTML = '';
            tbody.appendChild(emptyState);
        }
    }

    // Event listener untuk submit permintaan
    document.getElementById('submit-permintaan').addEventListener('click', function() {
        const unitKerja = document.getElementById('unit-kerja').value;
        const tanggal = document.getElementById('tanggal-permintaan').value;
        const namaPemohon = document.getElementById('nama-pemohon').value;
        
        if (!unitKerja) {
            alert('Pilih unit kerja terlebih dahulu');
            return;
        }
        
        if (keranjangBarang.length === 0) {
            alert('Tambah minimal satu barang ke daftar permintaan');
            return;
        }
        
        // Simulasi submit data (native tanpa database)
        const dataPermintaan = {
            nomor_permintaan: 'PMN-' + Date.now(),
            nama_pemohon: namaPemohon,
            unit_kerja: unitKerja,
            tanggal_permintaan: tanggal,
            barang: keranjangBarang,
            status: 'pending',
            tanggal_dibuat: new Date().toLocaleString()
        };
        
        // Simpan ke localStorage (simulasi penyimpanan sementara)
        const existingData = JSON.parse(localStorage.getItem('permintaan_barang') || '[]');
        existingData.push(dataPermintaan);
        localStorage.setItem('permintaan_barang', JSON.stringify(existingData));
        
        // Tampilkan konfirmasi
        alert(`Permintaan berhasil dikirim!\n\nNomor Permintaan: ${dataPermintaan.nomor_permintaan}\nTotal Barang: ${keranjangBarang.length} item`);
        
        // Reset form
        resetForm();
    });

    // Reset form
    function resetForm() {
        document.getElementById('unit-kerja').value = '';
        document.getElementById('tanggal-permintaan').valueAsDate = new Date();
        keranjangBarang = [];
        updateTabelPermintaan();
        document.getElementById('submit-permintaan').disabled = true;
        document.getElementById('kategori-barang').value = '';
        document.getElementById('search-barang').value = '';
        document.getElementById('search-barang').disabled = true;
        hideDaftarBarang();
    }
});