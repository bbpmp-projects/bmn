<style>
.font-cinzel-decorative {
    font-family: 'Cinzel Decorative', cursive;
    font-weight: 700;
    letter-spacing: 1px;
}
</style>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">

            <!-- About Section -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center overflow-hidden">
                        <img 
                            src="{{ asset('images/icon.png') }}" 
                            alt="Logo BMN BBPMP Jawa Barat" 
                            class="w-full h-full object-contain"
                            onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="bg-blue-600 w-10 h-10 rounded-lg items-center justify-center hidden">
                            <i class="fas fa-landmark text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">
                            <span class="font-cinzel-decorative">Sinambut</span> 
                            <span class="font-sans">BMN</span>
                        </h3>
                        <p class="text-sm text-gray-400">BBPMP Provinsi Jawa Barat</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm">
                    Sinambut adalah Sistem manajemen Barang Milik Negara BBPMP Provinsi Jawa Barat yang efisien dan terintegrasi untuk pengelolaan aset negara.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-lg mb-4">Menu Utama</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Home
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Tentang Kami
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Fitur
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Kontak
                    </a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="font-bold text-lg mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Data Barang
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Pengajuan BMN
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Laporan
                    </a></li>

                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs mr-2"></i>Bantuan
                    </a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="font-bold text-lg mb-4">Kontak Kami</h3>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-500"></i>
                        Jl. Raya Batujajar No.KM.2 No.90, Laksanamekar, Kec. Padalarang, Kabupaten Bandung Barat, Jawa Barat 40553
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-blue-500"></i>(022) 6866152
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-blue-500"></i>ult.bbpmpjabar@kemdikbud.go.id
                    </li>
                </ul>

                <div class="flex space-x-3 mt-4">
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

        </div>

        <!-- Bottom -->
        <div class="border-t border-gray-700 pt-6">
            <div class="text-center text-gray-400 text-sm">
                &copy; 2025 SINAMBUT BMN BBPMP Provinsi Jawa Barat. All rights reserved.
            </div>
        </div>
    </div>
</footer>
