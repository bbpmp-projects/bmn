@extends('layouts.auth')

@section('content')

<style>
.font-cinzel-decorative {
    font-family: 'Cinzel Decorative', cursive;
    font-weight: 700;
    letter-spacing: 2px;
}
</style>

<div class="min-h-screen flex">
    <!-- Left Side - Image/Content Section -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -left-20 -top-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform rotate-45 -right-20 -bottom-20 w-96 h-96 bg-white rounded-full"></div>
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
                    Pengelolaan Barang Milik Negara yang Efisien dan Terintegrasi
                </p>
                
                <!-- Features List -->
                <div class="space-y-3 text-left">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Manajemen Data Barang Terintegrasi</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Sistem Pengajuan Digital</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="text-blue-50">Monitoring Real-time</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 px-6 py-12">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
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
                <p class="text-gray-600">BBPMP Provinsi Jawa Barat</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
                    <p class="text-gray-600">Silakan login untuk melanjutkan</p>
                </div>

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email/Username Input -->
                    <div class="mb-6">
                        <label for="login" class="block text-gray-700 text-sm font-medium mb-2">
                            Email / Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="login" 
                                name="login" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Masukkan email atau username"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Masukkan password"
                                required
                            >
                            <button 
                                type="button" 
                                id="toggle-password"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                            >
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit"
                        id="submitBtn"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span id="submitText">Masuk</span>
                        <span id="loadingSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">atau</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 text-sm flex items-center justify-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('login_alert'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tunggu sedikit agar halaman selesai load
        setTimeout(function() {
            Swal.fire({
                icon: '{{ session('login_alert')['type'] }}',
                title: '{{ session('login_alert')['title'] }}',
                text: '{{ session('login_alert')['message'] }}',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'OK',
                timer: 5000, // Auto close setelah 5 detik
                timerProgressBar: true
            });
        }, 300);
    });
</script>
@endif

<!-- Inline JavaScript untuk memastikan ter-load -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Login script loaded - INLINE VERSION');
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const loginForm = document.getElementById('loginForm');
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    // Toggle Password
    if (togglePassword && passwordInput && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    }

    // Form submission
    if (loginForm) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingSpinner = document.getElementById('loadingSpinner');
        
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('Form submitted - INLINE');
            
            // Show loading
            if (submitBtn && submitText && loadingSpinner) {
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
            }
            
            try {
                const formData = new FormData(this);
                const response = await fetch('{{ route("login") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                console.log('Response status:', response.status);
                
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Response bukan JSON');
                }
                
                const data = await response.json();
                console.log('Response data:', data);
                
                if (data.success === true) {
                    console.log('SUCCESS - Redirecting to:', data.redirect);
                    
                    // TAMPILKAN POPUP SUCCESS
                    await Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: data.message || 'Selamat datang kembali',
                        confirmButtonColor: '#3b82f6',
                        confirmButtonText: 'Lanjutkan',
                        timer: 2000,
                        timerProgressBar: true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                    
                    // REDIRECT SETELAH POPUP
                    window.location.href = data.redirect || '/';
                    
                } else {
                    console.log('FAILED:', data.message);
                    
                    // Reset button state sebelum menampilkan error
                    if (submitBtn && submitText && loadingSpinner) {
                        submitBtn.disabled = false;
                        submitText.classList.remove('hidden');
                        loadingSpinner.classList.add('hidden');
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Login!',
                        text: data.message || 'Username/Email atau password salah!',
                        confirmButtonColor: '#ef4444'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                
                // Reset button state
                if (submitBtn && submitText && loadingSpinner) {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    confirmButtonColor: '#ef4444'
                });
            }
        });
    }
});
</script>

<!-- Tambahkan animasi CSS untuk SweetAlert -->
<style>
@import 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
</style>

@if(session('auth_alert'))
<div id="auth-alert-data" style="display: none;">
    @json(session('auth_alert'))
</div>
@endif

@endsection