@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center space-x-3">
                    <!-- Logo Icon -->
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center overflow-hidden">
                        <img 
                            src="{{ asset('images/icon.png') }}" 
                            alt="Logo BMN BBPMP Jawa Barat" 
                            class="w-full h-full object-contain"
                            onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="bg-blue-600 w-12 h-12 rounded-lg items-center justify-center hidden">
                            <i class="fas fa-landmark text-white text-xl"></i>
                        </div>
                    </div>
                    
                    <!-- Text Logo -->
                    <div class="flex flex-col">
                        <span class="text-gray-900 font-bold text-lg leading-tight">
                            SISTEM BMN
                        </span>
                        <span class="text-gray-600 text-sm leading-tight">
                            BBPMP Provinsi Jawa Barat
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-2">
                    <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-cogs mr-1"></i>Feature
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-sign-in-alt mr-1"></i>Login
                    </a>
                    <a href="#" class="bg-blue-600 text-white hover:bg-blue-700 px-5 py-2 rounded-lg text-sm font-medium transition duration-300 ml-2">
                        <i class="fas fa-user-plus mr-1"></i>Register
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="bg-blue-600 inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-blue-700 focus:outline-none transition duration-300" id="mobile-menu-button">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-4 pt-2 pb-3 space-y-1 border-t border-gray-200 bg-white">
            <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                <i class="fas fa-home mr-2"></i>Home
            </a>
            <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                <i class="fas fa-cogs mr-2"></i>Feature
            </a>
            <a href="#" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </a>
            <a href="#" class="bg-blue-600 text-white hover:bg-blue-700 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                <i class="fas fa-user-plus mr-2"></i>Register
            </a>
        </div>
    </div>
</nav>

<!-- Banner Section -->
<section class="relative h-[500px] md:h-[600px] overflow-hidden">
    <!-- Slides Container -->
    <div id="slides-container" class="flex transition-transform duration-700 ease-in-out h-full">
        <!-- Slide 1 -->
        <div class="min-w-full h-full flex-shrink-0 relative">
            <img 
                src="{{ asset('images/banner1.jpg') }}" 
                alt="Banner 1" 
                class="w-full h-full object-cover"
                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-r from-blue-400 to-blue-600\'></div>';"
            >
        </div>
        <!-- Slide 2 -->
        <div class="min-w-full h-full flex-shrink-0 relative">
            <img 
                src="{{ asset('images/banner2.png') }}" 
                alt="Banner 2" 
                class="w-full h-full object-cover"
                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-r from-green-400 to-green-600\'></div>';"
            >
        </div>
        <!-- Slide 3 -->
        <div class="min-w-full h-full flex-shrink-0 relative">
            <img 
                src="{{ asset('images/banner3.jpg') }}" 
                alt="Banner 3" 
                class="w-full h-full object-cover"
                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-r from-blue-400 to-blue-600\'></div>';"
            >
        </div>
    </div>

    <!-- Blue Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-blue-900/60 via-blue-800/50 to-blue-900/70"></div>

    <!-- Content -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                Sistem Manajemen BMN BBPMP Provinsi Jawa Barat
            </h1>
            <p class="text-xl md:text-2xl text-white mb-8 drop-shadow-lg">
                Pengelolaan Barang Milik Negara yang Efisien dan Terintegrasi
            </p>
            <button id="scroll-to-features" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-8 py-3 rounded-full font-medium transition duration-300 flex items-center space-x-2 mx-auto shadow-lg">
                <span>Lihat Fitur</span>
                <i class="fas fa-chevron-down animate-bounce"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button id="prev-slide" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full p-3 shadow-lg transition duration-300 z-10">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button id="next-slide" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full p-3 shadow-lg transition duration-300 z-10">
        <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-10">
        <button class="dot w-3 h-3 rounded-full bg-white/80 hover:bg-white transition duration-300 shadow-md" data-slide="0"></button>
        <button class="dot w-3 h-3 rounded-full bg-white/40 hover:bg-white transition duration-300 shadow-md" data-slide="1"></button>
        <button class="dot w-3 h-3 rounded-full bg-white/40 hover:bg-white transition duration-300 shadow-md" data-slide="2"></button>
    </div>
</section>

<!-- Features Section -->
<section id='features-section' class="py-16 bg-white" >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Utama Sistem BMN</h2>
            <p class="text-lg text-gray-600">Kelola aset negara dengan mudah dan efisien</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1: Data Barang -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-boxes text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Data Barang</h3>
                    <p class="text-gray-600 mb-4">
                        Kelola data barang milik negara secara lengkap dan terstruktur. 
                        Mulai dari inventarisasi hingga monitoring kondisi barang.
                    </p>
                    <ul class="text-left text-gray-600 space-y-2 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Inventarisasi Barang
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Ketersediaan Barang
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Monitoring Kondisi
                        </li>
                    </ul>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Akses Data Barang
                    </button>
                </div>
            </div>

            <!-- Feature 2: Pengajuan -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pengajuan</h3>
                    <p class="text-gray-600 mb-4">
                        Sistem pengajuan yang terintegrasi untuk permintaan barang, 
                        pemeliharaan, dan berbagai kebutuhan operasional lainnya.
                    </p>
                    <ul class="text-left text-gray-600 space-y-2 mb-6">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Pengajuan Barang Baru
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Permintaan Perbaikan
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Tracking Status
                        </li>
                    </ul>
                    <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        Buat Pengajuan
                    </button>
                </div>
            </div>

            <!-- Feature 3: Kosong (Placeholder) -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-gray-100">
                <div class="text-center">
                    <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-plus text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fitur Tambahan</h3>
                    <p class="text-gray-600 mb-4">
                        Area untuk fitur tambahan yang akan dikembangkan sesuai kebutuhan 
                        pengelolaan BMN BBPMP Jawa Barat.
                    </p>
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <p class="text-gray-500 text-sm">
                            Fitur ini sedang dalam pengembangan dan akan segera hadir
                        </p>
                    </div>
                    <button class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed" disabled>
                        Coming Soon
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Permintaan Barang Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Form Permintaan Barang</h2>
                <p class="text-red-600 text-sm">Silakan ajukan permintaan sesuai kebutuhan unit kerja Anda</p>
            </div>

            <!-- Unit/Tim Kerja -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Unit Tim Kerja</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Value</option>
                    <option value="unit1">Unit 1</option>
                    <option value="unit2">Unit 2</option>
                    <option value="unit3">Unit 3</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Daftar Barang -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 text-center">Daftar Barang</h3>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Kategori Barang</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            <option value="">Value</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="furniture">Furniture</option>
                            <option value="atk">Alat Tulis Kantor</option>
                        </select>
                    </div>
                </div>

                <!-- Daftar Permintaan -->
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Daftar Permintaan</h3>
                        <span class="bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Keterangan</label>
                        <div class="h-24 border border-gray-300 rounded-lg"></div>
                    </div>

                    <div class="text-center">
                        <button class="bg-blue-900 text-white px-8 py-2 rounded-lg hover:bg-blue-800 transition duration-300 font-medium">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                        <h3 class="font-bold text-lg">SISTEM BMN</h3>
                        <p class="text-sm text-gray-400">BBPMP Jawa Barat</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm">
                    Sistem manajemen Barang Milik Negara yang efisien dan terintegrasi untuk pengelolaan aset negara.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-lg mb-4">Menu Utama</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Fitur
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="font-bold text-lg mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Data Barang
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Pengajuan BMN
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Laporan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Bantuan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="font-bold text-lg mb-4">Kontak Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-start text-gray-400">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-500"></i>
                        <span class="text-sm">Jl. Raya Batujajar No.KM.2 No.90, Laksanamekar, Kec. Padalarang, Kabupaten Bandung Barat, Jawa Barat 40553</span>
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-phone mt-1 mr-3 text-blue-500"></i>
                        <span class="text-sm">(022) 6866152</span>
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-envelope mt-1 mr-3 text-blue-500"></i>
                        <span class="text-sm">ult.bbpmpjabar@kemdikbud.go.id </span>
                    </li>
                </ul>
                <div class="flex space-x-3 mt-4">
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center transition duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center transition duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-gray-700 hover:bg-blue-600 w-9 h-9 rounded-full flex items-center justify-center transition duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-700 pt-6">
            <div class="text-center text-gray-400 text-sm">
                <p>&copy; 2025 Sistem BMN BBPMP Jawa Barat. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Banner Carousel
    let currentSlide = 0;
    const slidesContainer = document.getElementById('slides-container');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = 3;

    function updateSlide(index) {
        currentSlide = index;
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, i) => {
            if (i === currentSlide) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-white/80');
            } else {
                dot.classList.remove('bg-white/80');
                dot.classList.add('bg-white/50');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide(currentSlide);
    }

    // Auto slide every 5 seconds
    let autoSlide = setInterval(nextSlide, 5000);

    // Navigation buttons
    document.getElementById('next-slide').addEventListener('click', function() {
        clearInterval(autoSlide);
        nextSlide();
        autoSlide = setInterval(nextSlide, 5000);
    });

    document.getElementById('prev-slide').addEventListener('click', function() {
        clearInterval(autoSlide);
        prevSlide();
        autoSlide = setInterval(nextSlide, 5000);
    });

    // Dots navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            clearInterval(autoSlide);
            updateSlide(index);
            autoSlide = setInterval(nextSlide, 5000);
        });
    });

    // Scroll halus ke fitur
    const scrollToFeaturesBtn = document.getElementById('scroll-to-features');
    const featuresSection = document.getElementById('features-section');

    if (scrollToFeaturesBtn && featuresSection) {
        scrollToFeaturesBtn.addEventListener('click', function () {
            featuresSection.scrollIntoView({
                behavior: 'smooth'
            });
        });
    }
</script>
@endsection
