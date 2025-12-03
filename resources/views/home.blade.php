@extends('layouts.app')

@section('content')

<style>
.font-cinzel-decorative {
    font-family: 'Cinzel Decorative', cursive;
    font-weight: 700;
    letter-spacing: 2px;
}
</style>

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
                src="{{ asset('images/banner4.png') }}" 
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
                <span class="font-cinzel-decorative">Sinambut</span> 
                <span class="font-sans">BMN</span>
            </h1>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                <span class="font-sans">BBPMP Provinsi Jawa Barat</span>
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
    <button id="prev-slide" 
        class="hidden md:flex absolute left-4 md:left-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full p-3 shadow-lg transition duration-300 z-10">
        <i class="fas fa-chevron-left"></i>
    </button>

    <button id="next-slide" 
        class="hidden md:flex absolute right-4 md:right-8 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full p-3 shadow-lg transition duration-300 z-10">
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
<section id="features-section" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                <span class="font-sans">Fitur Utama</span>
                <span class="font-cinzel-decorative">Sinambut</span> 
                <span class="font-sans">BMN</span></h2>
            <p class="text-lg text-gray-600">Kelola permintaan barang dengan sistem yang terintegrasi</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1: Permintaan Barang -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-blue-100">
                <div class="text-center">
                    <div class="bg-blue-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-200">
                        <i class="fas fa-hand-holding-usd text-blue-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Permintaan Barang</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Buat pengajuan permintaan barang baru dengan formulir yang mudah diisi. 
                        Lengkapi dengan spesifikasi dan dokumen yang diperlukan.
                    </p>
                    <div class="bg-blue-50 rounded-lg p-3 mb-4">
                        <p class="text-blue-700 text-xs font-medium">Fitur Unggulan:</p>
                    </div>
                    <ul class="text-left text-gray-600 space-y-2 mb-6 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-play text-blue-500 mr-2 text-xs"></i>
                            Form pengajuan terstruktur
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-play text-blue-500 mr-2 text-xs"></i>
                            Katalog barang tersedia
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-play text-blue-500 mr-2 text-xs"></i>
                            Validasi otomatis
                        </li>
                    </ul>
                    <a href="{{ route('permintaan.index') }}"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 w-full font-medium flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>Buat Permintaan
                    </a>
                </div>
            </div>

            <!-- Feature 2: Status -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-green-100">
                <div class="text-center">
                    <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-200">
                        <i class="fas fa-clipboard-check text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Status Permintaan</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Pantau perkembangan permintaan barang Anda secara real-time. 
                        Dapatkan notifikasi setiap ada update status.
                    </p>
                    <div class="bg-green-50 rounded-lg p-3 mb-4">
                        <p class="text-green-700 text-xs font-medium">Status Tracking:</p>
                    </div>
                    <ul class="text-left text-gray-600 space-y-2 mb-6 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-sync-alt text-green-500 mr-2 text-xs"></i>
                            Progres real-time
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-bell text-green-500 mr-2 text-xs"></i>
                            Notifikasi otomatis
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-green-500 mr-2 text-xs"></i>
                            Timeline proses
                        </li>
                    </ul>
                    <button class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 w-full font-medium">
                        <i class="fas fa-search mr-2"></i>Cek Status
                    </button>
                </div>
            </div>

            <!-- Feature 3: Riwayat -->
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 border border-purple-100">
                <div class="text-center">
                    <div class="bg-purple-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-purple-200">
                        <i class="fas fa-archive text-purple-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Riwayat Permintaan</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Akses arsip lengkap semua permintaan barang yang pernah diajukan. 
                        Berguna untuk evaluasi dan pelaporan.
                    </p>
                    <div class="bg-purple-50 rounded-lg p-3 mb-4">
                        <p class="text-purple-700 text-xs font-medium">Fitur Arsip:</p>
                    </div>
                    <ul class="text-left text-gray-600 space-y-2 mb-6 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-database text-purple-500 mr-2 text-xs"></i>
                            Arsip lengkap
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-filter text-purple-500 mr-2 text-xs"></i>
                            Filter advanced
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-download text-purple-500 mr-2 text-xs"></i>
                            Export data
                        </li>
                    </ul>
                    <button class="bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition duration-300 w-full font-medium">
                        <i class="fas fa-history mr-2"></i>Lihat Riwayat
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endpush
@endsection
