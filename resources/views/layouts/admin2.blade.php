<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logos.svg') }}">
    <link rel="alternate icon" href="{{ asset('images/icon.png') }}">
    <title>@yield('title', 'Sinambut BMN - Admin Dashboard')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cinzel-decorative:400,700,900|inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        .font-cinzel-decorative {
            font-family: 'Cinzel Decorative', cursive;
            font-weight: 700;
            letter-spacing: 2px;
        }
        
        /* Custom Scrollbar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background-color: transparent;
            border-radius: 9999px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #93c5fd;
            border-radius: 9999px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #60a5fa;
        }
        
        /* Transition for sidebar */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Hide badge in collapsed mode */
        .sidebar-collapsed .badge,
        .sidebar-collapsed .menu-text,
        .sidebar-collapsed .section-header,
        .sidebar-collapsed .user-info,
        .sidebar-collapsed .version-info,
        .sidebar-collapsed .logo-text,
        .sidebar-collapsed .user-profile {
            display: none !important;
        }
        
        /* Active menu indicator for collapsed mode */
        .active-indicator {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background-color: #3b82f6;
            border-radius: 0 4px 4px 0;
            opacity: 0;
            transition: opacity 0.2s;
        }
        
        .active .active-indicator {
            opacity: 1;
        }
        
        /* Tooltip for collapsed mode */
        .tooltip {
            position: relative;
        }
        
        .tooltip-text {
            visibility: hidden;
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background-color: #1f2937;
            color: white;
            text-align: center;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            z-index: 100;
            opacity: 0;
            transition: opacity 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-left: 10px;
        }
        
        .tooltip-text::before {
            content: '';
            position: absolute;
            left: -5px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent #1f2937 transparent transparent;
        }
        
        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        /* Toggle button in sidebar */
        .sidebar-toggle {
            position: absolute;
            right: -12px;
            top: 20px;
            background-color: white;
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 40;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            background-color: #f3f4f6;
            transform: scale(1.1);
        }
        
        /* Mobile overlay */
        .mobile-overlay {
            display: none;
        }
        
        @media (max-width: 1023px) {
            .mobile-overlay {
                display: block;
            }
        }
    </style>
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen font-['Inter',sans-serif]">
    
    <div x-data="{ 
        sidebarOpen: window.innerWidth > 1024,
        activeMenu: 'dashboard',
        formMenuOpen: false
    }" class="flex min-h-screen">
        
        <!-- SIDEBAR - TOGGLE ONLY IN SIDEBAR -->
        <aside :class="sidebarOpen ? 'w-72' : 'w-20 sidebar-collapsed'"
               class="fixed h-full z-30 flex flex-col bg-white shadow-xl border-r border-gray-200 sidebar-transition"
               style="top: 0; left: 0; bottom: 0;">
            
            <!-- Toggle Button Positioned Absolutely -->
            <div class="sidebar-toggle" @click="sidebarOpen = !sidebarOpen">
                <i class="fas fa-chevron-left text-gray-600 text-xs" :class="sidebarOpen ? '' : 'rotate-180'"></i>
            </div>
            
            <!-- Logo Area -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-4 px-3">
                <div class="flex items-center justify-between">
                    <!-- Logo Section -->
                    <div class="flex items-center flex-1" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                        <!-- Expanded Mode: Full Logo -->
                        <div x-show="sidebarOpen" class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg overflow-hidden">
                                <img src="{{ asset('images/icon.png') }}" 
                                    alt="icon"
                                    class="w-7 h-7 object-contain">
                            </div>
                            <div class="logo-text">
                                <h1 class="text-white font-bold text-base">
                                    <span class="font-cinzel-decorative">Sinambut</span> 
                                    <span class="font-sans">BMN</span>
                                </h1>
                                <p class="text-blue-200 text-xs opacity-90">Admin Panel</p>
                            </div>
                        </div>
                        
                        <!-- Collapsed Mode: Icon Only -->
                        <div x-show="!sidebarOpen" class="flex justify-center w-full">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg overflow-hidden">
                                <img src="{{ asset('images/icon.png') }}" 
                                    alt="icon"
                                    class="w-7 h-7 object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-t border-blue-100 user-profile">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="fas fa-user-shield text-white text-base"></i>
                    </div>
                    <div class="user-info flex-1 min-w-0">
                        <p class="font-bold text-gray-800 truncate text-sm">{{ session('user_name') ?? 'Admin' }}</p>
                        <div class="flex items-center mt-1 space-x-2">
                            <span class="text-xs text-gray-700 bg-white px-2 py-0.5 rounded-full border border-blue-200 shadow-sm">
                                Admin
                            </span>
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                <span class="text-xs text-gray-500">Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-4">
                <!-- Main Menu Section -->
                <div class="section-header px-4 mb-2" x-show="sidebarOpen">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">MENU UTAMA</span>
                </div>
                
                <div class="space-y-1 px-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       @click="activeMenu = 'dashboard'"
                       :class="activeMenu === 'dashboard' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'dashboard' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Dashboard</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Dashboard</span>
                    </a>

                    <!-- Data Barang -->
                    <a href="#" 
                       @click="activeMenu = 'data-barang'"
                       :class="activeMenu === 'data-barang' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'data-barang' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Data Barang</span>
                        <span class="badge ml-auto bg-blue-100 text-blue-600 text-xs font-semibold px-2 py-1 rounded-full shadow-sm" 
                              x-show="sidebarOpen">1,234</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Data Barang</span>
                    </a>

                    <!-- Management Section Header -->
                    <div class="section-header px-4 mt-6 mb-2" x-show="sidebarOpen">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">MANAJEMEN</span>
                    </div>

                    <!-- Permintaan Barang -->
                    <a href="#" 
                       @click="activeMenu = 'permintaan'"
                       :class="activeMenu === 'permintaan' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'permintaan' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Permintaan</span>
                        <span class="badge ml-auto bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm min-w-6 h-6 flex items-center justify-center" 
                              x-show="sidebarOpen">3</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Permintaan Barang</span>
                    </a>

                    <!-- Riwayat Permintaan -->
                    <a href="#" 
                       @click="activeMenu = 'riwayat'"
                       :class="activeMenu === 'riwayat' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'riwayat' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-history"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Riwayat</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Riwayat Permintaan</span>
                    </a>

                    <!-- Rekap Laporan -->
                    <a href="#" 
                       @click="activeMenu = 'laporan'"
                       :class="activeMenu === 'laporan' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'laporan' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Laporan</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Rekap Laporan</span>
                    </a>

                    <!-- Settings Section Header -->
                    <div class="section-header px-4 mt-6 mb-2" x-show="sidebarOpen">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">PENGATURAN</span>
                    </div>

                    <!-- Pengguna -->
                    <a href="#" 
                       @click="activeMenu = 'pengguna'"
                       :class="activeMenu === 'pengguna' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'pengguna' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Pengguna</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Manajemen Pengguna</span>
                    </a>

                    <!-- Audit Log -->
                    <a href="#" 
                       @click="activeMenu = 'audit'"
                       :class="activeMenu === 'audit' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-l-4 border-blue-500 shadow-sm' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600'"
                       class="tooltip flex items-center px-3 py-3 rounded-lg transition-all duration-200 relative">
                        <span class="active-indicator"></span>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 flex-shrink-0"
                             :class="activeMenu === 'audit' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600'">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Log</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Log Aktivitas</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Area -->
            <div class="border-t border-gray-200 mt-auto pb-2">
                <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                            class="tooltip flex items-center px-3 py-3 mx-2 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-all duration-200 group w-full">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-red-50 text-red-500 transition-all duration-200 hover:bg-red-100 flex-shrink-0">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="menu-text ml-3 font-medium" x-show="sidebarOpen">Keluar</span>
                        <span class="tooltip-text" x-show="!sidebarOpen">Keluar Sistem</span>
                    </button>
                </form>
                
                <!-- Version Info -->
                <div class="version-info px-4 py-3 border-t border-gray-200" x-show="sidebarOpen">
                    <div class="text-center">
                        <p class="text-xs text-gray-600 font-medium">BMN v1.0.0</p>
                        <p class="text-xs text-gray-500 mt-1">BBPMP Jawa Barat</p>
                        <div class="flex items-center justify-center mt-2 space-x-1">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                            <span class="text-xs text-gray-500 ml-2">Aktif</span>
                        </div>
                    </div>
                </div>
                
                <!-- Mini Status for Collapsed Mode -->
                <div class="flex justify-center py-3" x-show="!sidebarOpen">
                    <div class="flex space-x-1">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen && window.innerWidth < 1024" 
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black bg-opacity-50 z-20 mobile-overlay"
             x-transition.opacity
             x-cloak>
        </div>

        <!-- MAIN CONTENT -->
        <main :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-20'" 
              class="flex-1 ml-0 lg:ml-0 transition-all duration-300">
              
            <!-- Clean Header - NO TOGGLE BUTTONS -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-800">
                            @yield('page-title', 'Dashboard Admin')
                        </h1>
                        <p class="text-gray-600 text-sm mt-1">
                            @yield('page-subtitle', 'Sistem Manajemen Barang Milik Negara')
                        </p>
                    </div>
                    
                    <div class="flex items-center space-x-3 w-full sm:w-auto">
                        <!-- Mobile Menu Toggle - HAMBURGER ONLY -->
                        <button @click="sidebarOpen = !sidebarOpen" 
                                class="lg:hidden p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full font-bold">2</span>
                        </button>
                        
                        <!-- Quick Actions -->
                        <div class="hidden md:flex space-x-2">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg transition-all duration-300 font-medium flex items-center shadow-md hover:shadow-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Barang
                            </button>
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg transition-all duration-300 font-medium flex items-center shadow-md hover:shadow-lg">
                                <i class="fas fa-download mr-2"></i>Export Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 lg:p-8">
                <!-- Breadcrumb -->
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2 text-sm">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    <i class="fas fa-home mr-2"></i>Dashboard
                                </a>
                            </li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="space-y-8">
                    @yield('main-content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-6 mt-8">
                <div class="px-4 lg:px-8">
                    <div class="text-center text-gray-400 text-sm">
                        <p>&copy; {{ date('Y') }} Sistem BMN BBPMP Provinsi Jawa Barat. All rights reserved.</p>
                        <p class="mt-1 text-xs">v1.0.0 | Login terakhir: {{ date('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </footer>
        </main>
    </div>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/adminbaru.js') }}"></script>
    
    @stack('scripts')
    @yield('chart-script')
</body>
</html>