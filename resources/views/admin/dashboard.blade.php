@extends('layouts.app')

@section('content')

<!-- Alpine -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div x-data="{ sidebarOpen: true }" class="flex min-h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <aside 
        class="bg-white shadow-xl border-r border-gray-200 transition-all duration-300"
        :class="sidebarOpen ? 'w-64' : 'w-20'">

        <!-- Logo & Toggle -->
        <div class="p-6 flex items-center justify-between border-b">

            <div class="flex items-center space-x-3" x-show="sidebarOpen" x-transition>
                <img src="{{ asset('images/icon.png') }}" class="w-10 h-10 object-contain">
                <span class="font-bold text-lg text-gray-800">Sistem BMN</span>
            </div>

            <button @click="sidebarOpen = !sidebarOpen"
                class="text-gray-600 hover:text-blue-600">
                <i class="fas" :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
            </button>
        </div>

        <!-- MENU -->
        <nav class="mt-4 space-y-1">

            <!-- ITEM -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-6 py-3 hover:bg-blue-50 text-gray-700 transition">
                <i class="fas fa-home w-6 text-center"></i>
                <span class="ml-3" x-show="sidebarOpen" x-transition>Dashboard</span>
            </a>

            <a href=""
                class="flex items-center px-6 py-3 hover:bg-blue-50 text-gray-700 transition">
                <i class="fas fa-box-open w-6 text-center"></i>
                <span class="ml-3" x-show="sidebarOpen" x-transition>Permintaan BMN</span>
            </a>

            <a href=""
                class="flex items-center px-6 py-3 hover:bg-blue-50 text-gray-700 transition">
                <i class="fas fa-database w-6 text-center"></i>
                <span class="ml-3" x-show="sidebarOpen" x-transition>Data Barang</span>
            </a>

            <!-- LOGOUT -->
            <a href="#" class="flex items-center px-6 py-3 mt-10 hover:bg-red-50 text-red-600 transition">
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span class="ml-3" x-show="sidebarOpen" x-transition>Logout</span>
            </a>

        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h3 class="text-gray-600 text-sm">Total Permintaan</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">124</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h3 class="text-gray-600 text-sm">Disetujui</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">87</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h3 class="text-gray-600 text-sm">Ditolak</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">14</p>
            </div>

        </div>

        <!-- CHART -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Permintaan BMN (Dummy Data)</h2>
            <canvas id="chartPermintaan"></canvas>
        </div>

    </main>
</div>



<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
            <div class="text-center text-gray-400 text-sm">
                <p>&copy; 2025 Sistem BMN BBPMP Jawa Barat. All rights reserved.</p>
            </div>
</footer>


<!-- CHART SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('chartPermintaan').getContext('2d');

    new Chart(ctx, {
        type: 'line', 
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Jumlah Permintaan',
                data: [5, 12, 9, 15, 22, 18], // Dummy data
                borderWidth: 3
            }]
        }
    });

});
</script>

@endsection
