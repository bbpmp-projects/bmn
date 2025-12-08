@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Home
            </a>
        </div>

        <!-- Three Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Informasi Profile -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer" onclick="showSection('profile-info')">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-user text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
                    <p class="text-sm text-gray-600 mt-2">Lihat dan edit data pribadi Anda</p>
                </div>
            </div>

            <!-- Ubah Password -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer" onclick="showSection('change-password')">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-lock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                    <p class="text-sm text-gray-600 mt-2">Perbarui password akun Anda</p>
                </div>
            </div>

            <!-- Inisial Nama -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer" onclick="showSection('profile-initial')">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                        <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            {{ $user->initial }}
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Profile</h3>
                    <p class="text-xs text-purple-600 font-medium mt-1">{{ $user->nama_lengkap }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Profile Section -->
        <div id="profile-info-section" class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Profile</h2>
                <p class="text-gray-600 text-sm">Kelola informasi profile Anda</p>
            </div>

            <form id="profile-form" data-update-url="{{ route('profile.update') }}">
                @csrf
                
                <!-- Grid untuk Form Data -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nama_lengkap"
                            value="{{ $user->nama_lengkap ?? '' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                        <div class="text-red-500 text-sm mt-1 error-nama_lengkap"></div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="username"
                            value="{{ $user->username ?? '' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan username"
                            required
                        >
                        <div class="text-red-500 text-sm mt-1 error-username"></div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email"
                            value="{{ $user->email ?? '' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan email"
                            required
                        >
                        <div class="text-red-500 text-sm mt-1 error-email"></div>
                    </div>

                    <!-- NIP -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            NIP
                        </label>
                        <input 
                            type="text" 
                            name="nip"
                            value="{{ $user->nip ?? '' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan NIP"
                        >
                        <div class="text-red-500 text-sm mt-1 error-nip"></div>
                    </div>

                    <!-- Unit Kerja (Full Width) -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            Unit Kerja <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="unit_kerja"
                            value="{{ $user->unit_kerja ?? '' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Masukkan unit kerja"
                            required
                        >
                        <div class="text-red-500 text-sm mt-1 error-unit_kerja"></div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button 
                        type="submit"
                        id="update-profile-btn"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="submit-text">Simpan Perubahan</span>
                        <span id="loading-spinner" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Ubah Password Section (Hidden by Default) -->
        <div id="change-password-section" class="bg-white rounded-lg shadow-md p-8 mb-8 hidden">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Ubah Password</h2>
                <p class="text-gray-600 text-sm">Perbarui password akun Anda</p>
            </div>

            <form id="password-form" data-update-url="{{ route('profile.update-password') }}">
                @csrf
                
                <!-- Password Saat Ini -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="current_password"
                            id="current_password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition pr-10"
                            placeholder="Masukkan password saat ini"
                            required
                        >
                        <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 toggle-password" data-target="current_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="text-red-500 text-sm mt-1 error-current_password"></div>
                </div>

                <!-- Password Baru -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="new_password"
                            id="new_password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition pr-10"
                            placeholder="Masukkan password baru (minimal 8 karakter)"
                            required
                        >
                        <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 toggle-password" data-target="new_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="text-red-500 text-sm mt-1 error-new_password"></div>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="new_password_confirmation"
                            id="new_password_confirmation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition pr-10"
                            placeholder="Masukkan konfirmasi password baru"
                            required
                        >
                        <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 toggle-password" data-target="new_password_confirmation">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="text-red-500 text-sm mt-1 error-new_password_confirmation"></div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button 
                        type="submit"
                        id="update-password-btn"
                        class="bg-green-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-green-700 transition duration-300 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="password-submit-text">Ubah Password</span>
                        <span id="password-loading-spinner" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i> Mengubah...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Inisial Nama Section (Hidden by Default) -->
        <div id="profile-initial-section" class="bg-white rounded-lg shadow-md p-8 mb-8 hidden">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Informasi Profile</h2>
            </div>

            <div class="flex flex-col items-center">
                <!-- Display Current User Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 w-full max-w-md">
                    <div class="flex items-center">
                        <!-- Inisial Circle -->
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg mr-6">
                            {{ $user->initial }}
                        </div>
                        
                        <!-- User Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->nama_lengkap }}</h3>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-user-circle mr-2"></i>Username: {{ $user->username }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-envelope mr-2"></i>Email: {{ $user->email }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-briefcase mr-2"></i>Unit Kerja: {{ $user->unit_kerja }}
                                </p>
                                @if($user->nip)
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-id-card mr-2"></i>NIP: {{ $user->nip }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-8 w-full max-w-md">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700 mb-3">
                            <i class="fas fa-lightbulb text-blue-500 mr-2"></i>
                            Ingin mengubah informasi profile Anda? Ubah disini
                            <span class="font-medium text-blue-600 cursor-pointer hover:text-blue-800" onclick="showSection('profile-info')">
                                Informasi Profile
                            </span>
                        </p>
                        <button 
                            onclick="showSection('profile-info')"
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-300 flex items-center justify-center"
                        >
                            <i class="fas fa-edit mr-2"></i>
                            Edit Informasi Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Three Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Riwayat Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer"
            onclick="window.location.href='{{ route('permintaan.riwayat') }}'">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-archive text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Permintaan</h3>
                </div>
            </div>

            <!-- Status Permintaan -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer" 
                onclick="window.location.href='{{ route('permintaan.status') }}'">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-desktop text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Status Permintaan</h3>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 cursor-pointer"
                onclick="window.location.href='{{ route('barang.daftar') }}'">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-folder text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Barang</h3>
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush
@endsection