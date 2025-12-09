<style>
.font-cinzel-decorative {
    font-family: 'Cinzel Decorative', cursive;
    font-weight: 700;
    letter-spacing: 1px;
}
</style>

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
                        <span class="font-bold text-lg leading-tight">
                            <span class="font-cinzel-decorative">Sinambut</span> 
                            <span class="font-sans">BMN</span>
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
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>
                    
                    <!-- Feature Dropdown -->
                    <div class="relative group" id="feature-dropdown">
                        <button class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center">
                            <i class="fas fa-cogs mr-1"></i>Feature
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0 z-50">
                            <div class="py-2">
                                <a href="{{ route('permintaan.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                    <i class="fas fa-cart-plus mr-3 text-blue-500"></i>
                                    <div>
                                        <div class="font-medium">Permintaan Barang</div>
                                        <div class="text-xs text-gray-500">Buat pengajuan barang baru</div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('permintaan.status') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                    <i class="fas fa-tasks mr-3 text-green-500"></i>
                                    <div>
                                        <div class="font-medium">Status Permintaan</div>
                                        <div class="text-xs text-gray-500">Pantau status pengajuan</div>
                                    </div>
                                </a>

                                <a href="{{ route('permintaan.riwayat') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                    <i class="fas fa-history mr-3 text-blue-500"></i>
                                    <div>
                                        <div class="font-medium">Riwayat Permintaan</div>
                                        <div class="text-xs text-gray-500">Lihat Riwayat Permintaan</div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('barang.daftar') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                    <i class="fas fa-boxes mr-3 text-purple-500"></i>
                                    <div>
                                        <div class="font-medium">Daftar Barang</div>
                                        <div class="text-xs text-gray-500">Lihat inventaris barang</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Authentication Links -->
                    @if(session('logged_in'))
                        <!-- Notifications Dropdown -->
                        <div class="relative group" id="notifications-dropdown">
                            <button class="relative text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center">
                                <i class="fas fa-bell text-lg"></i>
                                <!-- Notification Badge -->
                                <span id="notification-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center hidden">
                                    0
                                </span>
                            </button>
                            
                            <!-- Notifications Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0 z-50">
                                <div class="py-2">
                                    <!-- Header -->
                                    <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                        <h3 class="font-medium text-gray-900">Notifikasi</h3>
                                        <button id="mark-all-read" class="text-xs text-blue-600 hover:text-blue-800 transition duration-200">
                                            Tandai semua telah dibaca
                                        </button>
                                    </div>
                                    
                                    <!-- Notifications List -->
                                    <div id="notifications-list" class="max-h-96 overflow-y-auto">
                                        <!-- Dummy Data - nanti diganti dengan data real dari backend -->
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition duration-200 notification-item" data-id="1">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Permintaan Disetujui</p>
                                                    <p class="text-xs text-gray-500 mt-1">Permintaan barang "Laptop Dell XPS 13" telah disetujui oleh admin.</p>
                                                    <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                                                </div>
                                                <button class="ml-2 text-gray-400 hover:text-gray-600 mark-read-btn" data-id="1">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition duration-200 notification-item" data-id="2">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <i class="fas fa-times text-red-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Permintaan Ditolak</p>
                                                    <p class="text-xs text-gray-500 mt-1">Permintaan barang "Printer Epson L3150" ditolak karena stok habis.</p>
                                                    <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                                                </div>
                                                <button class="ml-2 text-gray-400 hover:text-gray-600 mark-read-btn" data-id="2">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition duration-200 notification-item" data-id="3">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                        <i class="fas fa-check text-green-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Permintaan Disetujui</p>
                                                    <p class="text-xs text-gray-500 mt-1">Permintaan barang "Meja Kerja" telah disetujui dan sedang diproses.</p>
                                                    <p class="text-xs text-gray-400 mt-1">3 hari yang lalu</p>
                                                </div>
                                                <button class="ml-2 text-gray-400 hover:text-gray-600 mark-read-btn" data-id="3">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Empty State -->
                                        <div id="empty-notifications" class="hidden px-4 py-8 text-center">
                                            <div class="w-12 h-12 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-bell-slash text-gray-400 text-lg"></i>
                                            </div>
                                            <p class="text-gray-500 text-sm">Tidak ada notifikasi</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Footer -->
                                    <div class="px-4 py-3 border-t border-gray-100">
                                        <a href="{{ route('permintaan.status') }}" class="text-sm text-blue-600 hover:text-blue-800 transition duration-200 flex items-center justify-center">
                                            <span>Lihat semua notifikasi</span>
                                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative group" id="profile-dropdown">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <span>{{ session('user_name') }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0 z-40">
                                <div class="py-2">
                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p class="font-medium text-gray-900">{{ session('user_name') }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ session('user_email') }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ session('user_unit_kerja') }}</p>
                                    </div>
                                    
                                    <!-- Menu Items -->
                                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                        <i class="fas fa-user-circle mr-3 text-blue-500"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                    
                                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                        <i class="fas fa-cog mr-3 text-gray-500"></i>
                                        <span>Pengaturan</span>
                                    </a>
                                    
                                    <!-- Logout Form -->
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="border-t border-gray-100">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Login & Register Buttons -->
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-5 py-2 rounded-lg text-sm font-medium transition duration-300 ml-2">
                            <i class="fas fa-user-plus mr-1"></i>Register
                        </a>
                    @endif
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
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                <i class="fas fa-home mr-2"></i>Home
            </a>
            
            <!-- Mobile Feature Accordion -->
            <div class="border-b border-gray-100">
                <button class="flex items-center justify-between w-full text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-lg text-base font-medium transition duration-300" id="mobile-feature-button">
                    <div class="flex items-center">
                        <i class="fas fa-cogs mr-2"></i>Feature
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-300" id="mobile-feature-chevron"></i>
                </button>
                
                <div class="hidden pl-8 space-y-1" id="mobile-feature-submenu">
                    <a href="{{ route('permintaan.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-cart-plus mr-3 text-blue-500 text-xs"></i>
                        Permintaan Barang
                    </a>
                    <a href="{{ route('permintaan.status') }}" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-tasks mr-3 text-green-500 text-xs"></i>
                        Status Permintaan
                    </a>
                    <a href="{{ route('permintaan.riwayat') }}" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-history mr-3 text-blue-500 text-xs"></i>
                        Riwayat Permintaan
                    </a>
                    <a href="{{ route('barang.daftar') }}" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-boxes mr-3 text-purple-500 text-xs"></i>
                        Daftar Barang
                    </a>
                </div>
            </div>

            <!-- Mobile User Authentication Links -->
            @if(session('logged_in'))
                <!-- Mobile Notifications -->
                <div class="border-b border-gray-100">
                    <button class="flex items-center justify-between w-full text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-lg text-base font-medium transition duration-300" id="mobile-notifications-button">
                        <div class="flex items-center">
                            <i class="fas fa-bell mr-2"></i>
                            <span>Notifikasi</span>
                            <!-- Notification Badge Mobile -->
                            <span id="mobile-notification-badge" class="ml-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center hidden">
                                0
                            </span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300" id="mobile-notifications-chevron"></i>
                    </button>
                    
                    <div class="hidden pl-8 space-y-1" id="mobile-notifications-submenu">
                        <!-- Dummy Notifications Mobile -->
                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-xs"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">Permintaan Disetujui</p>
                                    <p class="text-xs text-gray-500 mt-1">Permintaan barang "Laptop Dell XPS 13" telah disetujui.</p>
                                    <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-times text-red-600 text-xs"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">Permintaan Ditolak</p>
                                    <p class="text-xs text-gray-500 mt-1">Permintaan barang "Printer Epson L3150" ditolak.</p>
                                    <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Empty State Mobile -->
                        <div id="mobile-empty-notifications" class="hidden px-4 py-4 text-center">
                            <div class="w-10 h-10 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-bell-slash text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 text-xs">Tidak ada notifikasi</p>
                        </div>
                        
                        <!-- View All Mobile -->
                        <a href="{{ route('permintaan.status') }}" class="block px-4 py-2 text-center text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>

                <!-- User Profile Accordion Mobile -->
                <div class="border-b border-gray-100">
                    <button class="flex items-center justify-between w-full text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-lg text-base font-medium transition duration-300" id="mobile-profile-button">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600 text-xs"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-medium text-gray-900 text-sm">{{ session('user_name') }}</p>
                                <p class="text-xs text-gray-500">{{ session('user_email') }}</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300" id="mobile-profile-chevron"></i>
                    </button>
                    
                    <div class="hidden pl-14 space-y-1" id="mobile-profile-submenu">
                        <!-- User Info -->
                        <div class="px-4 py-2">
                            <p class="text-xs font-medium text-gray-900">{{ session('user_name') }}</p>
                            <p class="text-xs text-gray-500">{{ session('user_email') }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ session('user_unit_kerja') }}</p>
                        </div>
                        
                        <!-- Menu Items -->
                        <a href="{{ route('profile.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                            <i class="fas fa-user-circle mr-3 text-blue-500 text-xs"></i>
                            Profil Saya
                        </a>
                        <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                            <i class="fas fa-cog mr-3 text-gray-500 text-xs"></i>
                            Pengaturan
                        </a>
                        
                        <!-- Logout Mobile -->
                        <form action="{{ route('logout') }}" method="POST" id="mobile-logout-form">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-red-600 hover:text-red-700 hover:bg-red-50 px-4 py-2 rounded-lg text-sm transition duration-300 text-left">
                                <i class="fas fa-sign-out-alt mr-3 text-xs"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Login & Register Mobile -->
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 block px-4 py-3 rounded-lg text-base font-medium transition duration-300">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
            @endif
        </div>
    </div>
</nav>

@push('scripts')
<script src="{{ asset('js/navbar.js') }}"></script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Mobile feature accordion
        const mobileFeatureButton = document.getElementById('mobile-feature-button');
        const mobileFeatureSubmenu = document.getElementById('mobile-feature-submenu');
        const mobileFeatureChevron = document.getElementById('mobile-feature-chevron');
        
        if (mobileFeatureButton && mobileFeatureSubmenu && mobileFeatureChevron) {
            mobileFeatureButton.addEventListener('click', function() {
                // Toggle submenu visibility
                mobileFeatureSubmenu.classList.toggle('hidden');
                
                // Toggle chevron rotation
                mobileFeatureChevron.classList.toggle('rotate-180');
                
                // Close other submenus if open
                closeOtherMobileSubmenus('feature');
            });
        }

        // Mobile notifications accordion
        const mobileNotificationsButton = document.getElementById('mobile-notifications-button');
        const mobileNotificationsSubmenu = document.getElementById('mobile-notifications-submenu');
        const mobileNotificationsChevron = document.getElementById('mobile-notifications-chevron');
        
        if (mobileNotificationsButton && mobileNotificationsSubmenu && mobileNotificationsChevron) {
            mobileNotificationsButton.addEventListener('click', function() {
                // Toggle submenu visibility
                mobileNotificationsSubmenu.classList.toggle('hidden');
                
                // Toggle chevron rotation
                mobileNotificationsChevron.classList.toggle('rotate-180');
                
                // Close other submenus if open
                closeOtherMobileSubmenus('notifications');
            });
        }

        // Mobile profile accordion
        const mobileProfileButton = document.getElementById('mobile-profile-button');
        const mobileProfileSubmenu = document.getElementById('mobile-profile-submenu');
        const mobileProfileChevron = document.getElementById('mobile-profile-chevron');
        
        if (mobileProfileButton && mobileProfileSubmenu && mobileProfileChevron) {
            mobileProfileButton.addEventListener('click', function() {
                // Toggle submenu visibility
                mobileProfileSubmenu.classList.toggle('hidden');
                
                // Toggle chevron rotation
                mobileProfileChevron.classList.toggle('rotate-180');
                
                // Close other submenus if open
                closeOtherMobileSubmenus('profile');
            });
        }

        // Function to close other mobile submenus
        function closeOtherMobileSubmenus(current) {
            const submenus = {
                feature: { submenu: mobileFeatureSubmenu, chevron: mobileFeatureChevron },
                notifications: { submenu: mobileNotificationsSubmenu, chevron: mobileNotificationsChevron },
                profile: { submenu: mobileProfileSubmenu, chevron: mobileProfileChevron }
            };
            
            for (const [key, value] of Object.entries(submenus)) {
                if (key !== current && value.submenu && !value.submenu.classList.contains('hidden')) {
                    value.submenu.classList.add('hidden');
                    if (value.chevron) value.chevron.classList.remove('rotate-180');
                }
            }
        }

        // Notification badge counter (dummy data)
        function updateNotificationBadge() {
            const notificationBadge = document.getElementById('notification-badge');
            const mobileNotificationBadge = document.getElementById('mobile-notification-badge');
            const notificationItems = document.querySelectorAll('.notification-item:not(.read)');
            const count = notificationItems.length;
            
            if (notificationBadge) {
                if (count > 0) {
                    notificationBadge.textContent = count;
                    notificationBadge.classList.remove('hidden');
                } else {
                    notificationBadge.classList.add('hidden');
                }
            }
            
            if (mobileNotificationBadge) {
                if (count > 0) {
                    mobileNotificationBadge.textContent = count;
                    mobileNotificationBadge.classList.remove('hidden');
                } else {
                    mobileNotificationBadge.classList.add('hidden');
                }
            }
            
            // Show/hide empty states
            const emptyState = document.getElementById('empty-notifications');
            const mobileEmptyState = document.getElementById('mobile-empty-notifications');
            
            if (count === 0) {
                if (emptyState) emptyState.classList.remove('hidden');
                if (mobileEmptyState) mobileEmptyState.classList.remove('hidden');
            } else {
                if (emptyState) emptyState.classList.add('hidden');
                if (mobileEmptyState) mobileEmptyState.classList.add('hidden');
            }
        }

        // Mark single notification as read
        document.querySelectorAll('.mark-read-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const notificationId = this.getAttribute('data-id');
                const notificationItem = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
                
                if (notificationItem) {
                    notificationItem.classList.add('read');
                    notificationItem.style.opacity = '0.6';
                    updateNotificationBadge();
                }
            });
        });

        // Mark all notifications as read
        const markAllReadBtn = document.getElementById('mark-all-read');
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function() {
                document.querySelectorAll('.notification-item').forEach(item => {
                    item.classList.add('read');
                    item.style.opacity = '0.6';
                });
                updateNotificationBadge();
            });
        }

        // Close notifications when clicking on notification items
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                // Mark as read when clicked
                this.classList.add('read');
                this.style.opacity = '0.6';
                updateNotificationBadge();
            });
        });

        // Initialize notification badge
        updateNotificationBadge();

        // Logout confirmation for desktop
        const logoutForm = document.getElementById('logout-form');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }

        // Logout confirmation for mobile
        const mobileLogoutForm = document.getElementById('mobile-logout-form');
        if (mobileLogoutForm) {
            mobileLogoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenu && !mobileMenu.classList.contains('hidden') && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                
                // Close all submenus when closing mobile menu
                const mobileSubmenus = [
                    { submenu: mobileFeatureSubmenu, chevron: mobileFeatureChevron },
                    { submenu: mobileNotificationsSubmenu, chevron: mobileNotificationsChevron },
                    { submenu: mobileProfileSubmenu, chevron: mobileProfileChevron }
                ];
                
                mobileSubmenus.forEach(({ submenu, chevron }) => {
                    if (submenu && !submenu.classList.contains('hidden')) {
                        submenu.classList.add('hidden');
                        if (chevron) chevron.classList.remove('rotate-180');
                    }
                });
            }
        });

        // Close submenus when clicking on other links
        document.addEventListener('click', function(event) {
            // Close feature submenu when clicking outside
            if (mobileFeatureButton && mobileFeatureSubmenu && 
                !mobileFeatureButton.contains(event.target) && 
                !mobileFeatureSubmenu.contains(event.target) &&
                !mobileFeatureSubmenu.classList.contains('hidden')) {
                mobileFeatureSubmenu.classList.add('hidden');
                if (mobileFeatureChevron) mobileFeatureChevron.classList.remove('rotate-180');
            }
            
            // Close notifications submenu when clicking outside
            if (mobileNotificationsButton && mobileNotificationsSubmenu && 
                !mobileNotificationsButton.contains(event.target) && 
                !mobileNotificationsSubmenu.contains(event.target) &&
                !mobileNotificationsSubmenu.classList.contains('hidden')) {
                mobileNotificationsSubmenu.classList.add('hidden');
                if (mobileNotificationsChevron) mobileNotificationsChevron.classList.remove('rotate-180');
            }
            
            // Close profile submenu when clicking outside
            if (mobileProfileButton && mobileProfileSubmenu && 
                !mobileProfileButton.contains(event.target) && 
                !mobileProfileSubmenu.contains(event.target) &&
                !mobileProfileSubmenu.classList.contains('hidden')) {
                mobileProfileSubmenu.classList.add('hidden');
                if (mobileProfileChevron) mobileProfileChevron.classList.remove('rotate-180');
            }
        });
    });
</script>