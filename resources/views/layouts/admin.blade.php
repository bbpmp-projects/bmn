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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* SIDEBAR STYLING - FIXED */
        .sidebar {
            background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
        }
        
        /* Logo Area */
        .logo-container {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        
        /* Menu Items - FIXED STRUCTURE */
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #374151;
            transition: all 0.2s ease;
            border-radius: 0.75rem;
            margin: 0.25rem 0.75rem;
            text-decoration: none;
            position: relative;
        }
        
        .menu-item:hover {
            background-color: #eff6ff;
            color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        
        .menu-item.active {
            background: linear-gradient(to right, #eff6ff 0%, #dbeafe 100%);
            color: #1d4ed8;
            font-weight: 600;
            border-left: 4px solid #2563eb;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        /* Icon Container - FIXED */
        .menu-icon {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            flex-shrink: 0;
        }
        
        .menu-item.active .menu-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }
        
        .menu-item:hover .menu-icon {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        }
        
        /* Menu Text */
        .menu-text {
            margin-left: 1rem;
            font-weight: 500;
            white-space: nowrap;
        }
        
        /* Badge for counts */
        .menu-badge {
            margin-left: auto;
            background: linear-gradient(to right, #dbeafe 0%, #bfdbfe 100%);
            color: #2563eb;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 600;
        }
        
        .menu-item.active .menu-badge {
            background: linear-gradient(to right, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        /* Badge for notifications */
        .notification-badge {
            margin-left: auto;
            background: linear-gradient(to right, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            min-width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
        }
        
        /* User Profile */
        .user-profile {
            background: linear-gradient(to right, #eff6ff 0%, #e0e7ff 100%);
            border-top: 1px solid #dbeafe;
        }
        
        .user-avatar {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
            flex-shrink: 0;
        }
        
        /* Section Headers */
        .section-header {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.5rem 1.25rem;
            margin-top: 1rem;
        }
        
        /* Submenu - FIXED */
        .submenu-container {
            margin-left: 3rem;
            margin-top: 0.5rem;
            margin-bottom: 0.75rem;
            border-left: 2px solid #dbeafe;
            padding-left: 1rem;
        }
        
        .submenu-item {
            display: flex;
            align-items: center;
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            color: #4b5563;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            margin: 0.25rem 0;
            text-decoration: none;
        }
        
        .submenu-item:hover {
            color: #2563eb;
            background-color: #eff6ff;
        }
        
        .submenu-item.active {
            color: #2563eb;
            background-color: #eff6ff;
            font-weight: 500;
        }
        
        /* Logout Button */
        .logout-btn {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #dc2626;
            border-radius: 0.75rem;
            margin: 0.25rem 0.75rem;
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            width: calc(100% - 1.5rem);
            cursor: pointer;
        }
        
        .logout-btn:hover {
            background-color: #fef2f2;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
        }
        
        .logout-btn .menu-icon {
            background: #fef2f2;
        }
        
        .logout-btn:hover .menu-icon {
            background: #fee2e2;
        }
        
        /* Collapse Arrow */
        .collapse-arrow {
            margin-left: auto;
            color: #9ca3af;
            transition: transform 0.3s ease;
            font-size: 0.75rem;
        }
        
        .collapse-arrow.rotated {
            transform: rotate(180deg);
        }
        
        /* Custom Scrollbar */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #93c5fd #f1f5f9;
        }
        
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background-color: #f1f5f9;
            border-radius: 9999px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #93c5fd;
            border-radius: 9999px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #60a5fa;
        }
        
        /* Main Content Spacing */
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        /* Collapsed Sidebar */
        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .menu-badge,
        .sidebar.collapsed .notification-badge,
        .sidebar.collapsed .collapse-arrow {
            display: none;
        }
        
        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 0.875rem;
        }
        
        .sidebar.collapsed .menu-icon {
            margin: 0;
        }

        .font-cinzel-decorative {
            font-family: 'Cinzel Decorative', cursive;
            font-weight: 700;
            letter-spacing: 2px;
        }
    </style>
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <div x-data="{ 
        sidebarOpen: window.innerWidth > 1024,
        formMenuOpen: false,
        activeMenu: 'dashboard'
    }" class="flex min-h-screen">
        
        <!-- SIDEBAR - IMPROVED DESIGN -->
        <aside class="sidebar fixed h-full z-30 flex flex-col"
               :class="sidebarOpen ? 'w-80' : 'w-24'"
               style="top: 0; left: 0; bottom: 0;">
            
            <!-- Logo Area -->
            <div class="logo-container py-5 px-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3" x-show="sidebarOpen" x-transition>
                       <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg overflow-hidden">
                            <img src="{{ asset('images/icon.png') }}" 
                                alt="icon"
                                class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <h1 class="text-white font-bold text-lg">
                                <span class="font-cinzel-decorative">Sinambut</span> 
                                <span class="font-sans">BMN</span>
                            </h1>
                            <p class="text-blue-100 text-xs opacity-90">Admin Panel</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="p-2 text-white hover:bg-blue-700 rounded-lg transition-colors duration-200">
                        <i class="fas fa-chevron-left text-sm" :class="sidebarOpen ? '' : 'rotate-180'"></i>
                    </button>
                </div>
            </div>

            <!-- User Profile -->
            <div class="user-profile p-5" x-show="sidebarOpen" x-transition>
                <div class="flex items-center space-x-4">
                    <div class="user-avatar">
                        <i class="fas fa-user-shield text-white text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-800 truncate">{{ session('user_name') ?? 'Administrator' }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-gray-600 bg-white px-2 py-1 rounded-full border border-blue-200">
                                Admin Sistem
                            </span>
                            <div class="ml-2 flex items-center">
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
                <div class="section-header" x-show="sidebarOpen" x-transition>
                    <span>MENU UTAMA</span>
                </div>
                
                <div class="space-y-1 px-3">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       @click="activeMenu = 'dashboard'"
                       :class="activeMenu === 'dashboard' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-tachometer-alt text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Dashboard</span>
                    </a>

                    <!-- Data Barang -->
                    <a href="#" 
                       @click="activeMenu = 'data-barang'"
                       :class="activeMenu === 'data-barang' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-box-open text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Data Barang</span>
                        <span class="ml-auto bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-medium" 
                              x-show="sidebarOpen">1,234</span>
                    </a>

                    <!-- Management Section -->
                    <div class="section-header" x-show="sidebarOpen" x-transition>
                        <span>MANAJEMEN</span>
                    </div>

                    <!-- Form Management -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open; activeMenu = 'form-management'"
                                :class="activeMenu === 'form-management' ? 'active' : ''"
                                class="menu-item w-full text-left flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="menu-icon">
                                    <i class="fas fa-file-contract text-lg"></i>
                                </div>
                                <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Form Management</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs collapse-arrow ml-2" 
                               :class="open ? 'rotate-180' : ''" 
                               x-show="sidebarOpen"></i>
                        </button>
                        
                        <!-- Submenu -->
                        <div x-show="open && sidebarOpen" x-collapse class="submenu-container">
                            <a href="#" class="submenu-item">
                                <i class="fas fa-plus-circle text-blue-400 text-xs mr-3"></i>
                                Buat Form Baru
                            </a>
                            <a href="#" class="submenu-item">
                                <i class="fas fa-copy text-blue-400 text-xs mr-3"></i>
                                Template Form
                            </a>
                            <a href="#" class="submenu-item">
                                <i class="fas fa-archive text-blue-400 text-xs mr-3"></i>
                                Arsip Form
                            </a>
                        </div>
                    </div>

                    <!-- Permintaan Barang -->
                    <a href="#" 
                       @click="activeMenu = 'permintaan'"
                       :class="activeMenu === 'permintaan' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-shopping-cart text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Permintaan Barang</span>
                        <span class="notification-badge" x-show="sidebarOpen">3</span>
                    </a>

                    <!-- Riwayat Permintaan -->
                    <a href="#" 
                       @click="activeMenu = 'riwayat'"
                       :class="activeMenu === 'riwayat' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Riwayat Permintaan</span>
                    </a>

                    <!-- Rekap Laporan -->
                    <a href="#" 
                       @click="activeMenu = 'laporan'"
                       :class="activeMenu === 'laporan' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-chart-pie text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Rekap Laporan</span>
                    </a>

                    <!-- Settings Section -->
                    <div class="section-header" x-show="sidebarOpen" x-transition>
                        <span>PENGATURAN</span>
                    </div>

                    <!-- Pengguna -->
                    <a href="#" 
                       @click="activeMenu = 'pengguna'"
                       :class="activeMenu === 'pengguna' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-users-cog text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Manajemen Pengguna</span>
                    </a>

                    <!-- Audit Log -->
                    <a href="#" 
                       @click="activeMenu = 'audit'"
                       :class="activeMenu === 'audit' ? 'active' : ''"
                       class="menu-item">
                        <div class="menu-icon">
                            <i class="fas fa-clipboard-check text-lg"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Log Aktivitas</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Area -->
            <div class="border-t border-gray-200 mt-auto">
                <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                            class="logout-btn">
                        <div class="menu-icon bg-red-50">
                            <i class="fas fa-sign-out-alt text-lg text-red-500"></i>
                        </div>
                        <span class="ml-4 font-medium" x-show="sidebarOpen" x-transition>Keluar Sistem</span>
                    </button>
                </form>
                
                <!-- Version Info -->
                <div x-show="sidebarOpen" x-transition class="px-6 py-4 border-t border-gray-200">
                    <div class="text-center">
                        <p class="text-xs text-gray-500 font-medium">Sistem BMN v1.0.0</p>
                        <p class="text-xs text-gray-400 mt-1">BBPMP Provinsi Jawa Barat © 2025</p>
                        <div class="flex items-center justify-center mt-2 space-x-1">
                            <span class="w-1 h-1 bg-blue-400 rounded-full"></span>
                            <span class="w-1 h-1 bg-green-400 rounded-full"></span>
                            <span class="w-1 h-1 bg-yellow-400 rounded-full"></span>
                            <span class="text-xs text-gray-400 ml-2">Status: Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main :class="sidebarOpen ? 'lg:ml-80' : 'lg:ml-24'" 
              class="main-content flex-1 ml-0 lg:ml-0">
              
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-20">
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
                        <!-- Mobile Sidebar Toggle -->
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
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
    @yield('chart-script')
</body>
</html>