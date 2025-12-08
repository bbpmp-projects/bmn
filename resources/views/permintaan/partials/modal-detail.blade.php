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
                    <div>
                        <p class="text-sm text-gray-500">NIP</p>
                        <p class="font-medium text-gray-900" id="modal-nip">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900" id="modal-email">-</p>
                    </div>
                </div>
            </div>
            
            <!-- Catatan (jika ada) -->
            <div id="modal-catatan-container" class="mb-6 hidden">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Catatan</h4>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-sm text-gray-700" id="modal-catatan">-</p>
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