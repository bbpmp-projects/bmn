@extends('layouts.auth')

@section('content')

<style>
.font-cinzel-decorative {
    font-family: 'Cinzel Decorative', cursive;
    font-weight: 700;
    letter-spacing: 2px;
}
</style>

<div class="min-h-screen lg:h-screen flex overflow-hidden">
    <!-- Left Side - Image/Content Section -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -left-20 -top-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform rotate-45 -right-20 -bottom-20 w-96 h-96 bg-white rounded-full"></div>
        </div>
        
        <!-- Back to Home Button - Top Left -->
        <div class="absolute top-6 left-6 z-20">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 text-white hover:text-blue-100 transition-colors duration-200 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg backdrop-blur-sm">
                <i class="fas fa-arrow-left"></i>
                <span class="font-medium">Kembali ke Beranda</span>
            </a>
        </div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-center items-center w-full px-12 text-white">
            <!-- Logo -->
            <div class="mb-8">
                <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center overflow-hidden shadow-2xl">
                    <img 
                        src="{{ asset('images/icon.png') }}" 
                        alt="Logo BMN BBPMP Jawa Barat" 
                        class="w-full h-full object-contain p-2"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >
                    <div class="w-full h-full items-center justify-center hidden">
                        <i class="fas fa-landmark text-blue-600 text-5xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl font-bold mb-4 text-center">
                <span class="font-cinzel-decorative">Sinambut</span> 
                <span class="font-sans">BMN</span>
            </h1>
            
            <p class="text-xl mb-8 text-center text-blue-100">
                BBPMP Provinsi Jawa Barat
            </p>
            
            <!-- Description -->
            <div class="max-w-md text-center">
                <p class="text-lg mb-6 text-blue-50">
                    Bergabung dengan Sistem BMN BBPMP Jawa Barat
                </p>
                
                <!-- Features List -->
                <div class="space-y-3 text-left">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Akses Sistem Pengajuan Barang</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Monitoring Status Real-time</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Riwayat Permintaan Terorganisir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Register Form Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 px-6 py-8 overflow-y-auto">
        <div class="w-full max-w-4xl">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-6">
                <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 overflow-hidden shadow-lg">
                    <img 
                        src="{{ asset('images/icon.png') }}" 
                        alt="Logo BMN BBPMP Jawa Barat" 
                        class="w-full h-full object-contain p-2"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >
                    <div class="w-full h-full items-center justify-center hidden">
                        <i class="fas fa-landmark text-white text-4xl"></i>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">
                    <span class="font-cinzel-decorative">Sinambut</span> 
                    <span class="font-sans">BMN</span>
                </h2>
                <p class="text-gray-600">BMN BBPMP Provinsi Jawa Barat</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun</h2>
                    <p class="text-gray-600">Isi data diri Anda untuk membuat akun</p>
                </div>

                <!-- Register Form -->
                <form id="registerForm" method="POST">
                    @csrf
                    
                    <!-- First Row - Two Columns -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        
                        <!-- Left Column -->
                        <div class="space-y-3">
                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-gray-700 text-sm font-medium mb-1">
                                    Username *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400 text-sm"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="username" 
                                        name="username" 
                                        class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                        placeholder="Masukkan username"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">
                                    Email *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                    </div>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                        placeholder="Masukkan email"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-3">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-gray-700 text-sm font-medium mb-1">
                                    Nama Lengkap *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user-circle text-gray-400 text-sm"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nama_lengkap" 
                                        name="nama_lengkap" 
                                        class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Unit Kerja -->
                            <div>
                                <label for="unit_kerja" class="block text-gray-700 text-sm font-medium mb-1">
                                    Unit Kerja *
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400 text-sm"></i>
                                    </div>
                                    <input 
                                        type="text"
                                        id="unit_kerja"
                                        name="unit_kerja"
                                        placeholder="Masukkan Unit Kerja"
                                        class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row - Two Columns -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-gray-700 text-sm font-medium mb-1">
                                NIP *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-fingerprint text-gray-400 text-sm"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="nip" 
                                    name="nip" 
                                    class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                    placeholder="Masukkan NIP"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-gray-700 text-sm font-medium mb-1">
                                Password *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                    placeholder="Masukkan password"
                                    required
                                    minlength="8"
                                >
                                <button 
                                    type="button" 
                                    id="toggle-password"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                >
                                    <i class="fas fa-eye text-sm" id="eye-icon"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                        </div>
                    </div>

                    <!-- Third Row - Confirm Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-1">
                                Konfirmasi Password *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm"
                                    placeholder="Konfirmasi password"
                                    required
                                >
                                <button 
                                    type="button" 
                                    id="toggle-password-confirmation"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                >
                                    <i class="fas fa-eye text-sm" id="eye-icon-confirmation"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Empty column for alignment -->
                        <div></div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="terms" 
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                required
                            >
                            <span class="ml-2 text-sm text-gray-600">
                                Saya menyetujui 
                                <a href="#" class="text-blue-600 hover:text-blue-700">syarat dan ketentuan</a>
                                yang berlaku
                            </span>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <div class="flex space-x-4">
                        <button 
                            type="submit"
                            id="submitBtn"
                            class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl"
                        >
                            <i class="fas fa-user-plus mr-2"></i>
                            <span id="submitText">Daftar Akun</span>
                            <span id="loadingSpinner" class="hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Mendaftarkan...
                            </span>
                        </button>
                    </div>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">atau</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Masuk Sekarang
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home - Mobile Only -->
            <div class="lg:hidden text-center mt-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 text-sm inline-flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Load SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endpush
@endsection