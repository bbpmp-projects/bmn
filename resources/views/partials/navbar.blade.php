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
                                
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                    <i class="fas fa-tasks mr-3 text-green-500"></i>
                                    <div>
                                        <div class="font-medium">Status Permintaan</div>
                                        <div class="text-xs text-gray-500">Pantau status pengajuan</div>
                                    </div>
                                </a>
                                
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
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
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0 z-50">
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
                    <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-tasks mr-3 text-green-500 text-xs"></i>
                        Status Permintaan
                    </a>
                    <a href="#" class="flex items-center text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-boxes mr-3 text-purple-500 text-xs"></i>
                        Daftar Barang
                    </a>
                </div>
            </div>

            <!-- Mobile User Authentication Links -->
            @if(session('logged_in'))
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
                
                // Close profile submenu if open
                if (mobileProfileSubmenu && !mobileProfileSubmenu.classList.contains('hidden')) {
                    mobileProfileSubmenu.classList.add('hidden');
                    mobileProfileChevron.classList.remove('rotate-180');
                }
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
                
                // Close feature submenu if open
                if (mobileFeatureSubmenu && !mobileFeatureSubmenu.classList.contains('hidden')) {
                    mobileFeatureSubmenu.classList.add('hidden');
                    mobileFeatureChevron.classList.remove('rotate-180');
                }
            });
        }

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
                if (mobileFeatureSubmenu && !mobileFeatureSubmenu.classList.contains('hidden')) {
                    mobileFeatureSubmenu.classList.add('hidden');
                    if (mobileFeatureChevron) mobileFeatureChevron.classList.remove('rotate-180');
                }
                if (mobileProfileSubmenu && !mobileProfileSubmenu.classList.contains('hidden')) {
                    mobileProfileSubmenu.classList.add('hidden');
                    if (mobileProfileChevron) mobileProfileChevron.classList.remove('rotate-180');
                }
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