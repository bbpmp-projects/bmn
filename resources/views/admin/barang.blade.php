@extends('layouts.admin')

@section('title', 'Data Barang - Admin')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-angle-right text-gray-400"></i>
        <span class="ml-1 text-gray-700">Data Barang</span>
    </div>
</li>
@endsection

@section('main-content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Data Barang</h2>
        <button class="btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Barang
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-2">
            <div class="relative">
                <input type="text" placeholder="Cari barang..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            <option>Semua Kategori</option>
            <option>Elektronik</option>
            <option>Furniture</option>
            <option>Kendaraan</option>
        </select>
        <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            <option>Status: Semua</option>
            <option>Tersedia</option>
            <option>Dipinjam</option>
            <option>Rusak</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="table-header px-6 py-3 text-left">Kode Barang</th>
                    <th class="table-header px-6 py-3 text-left">Nama Barang</th>
                    <th class="table-header px-6 py-3 text-left">Kategori</th>
                    <th class="table-header px-6 py-3 text-left">Stok</th>
                    <th class="table-header px-6 py-3 text-left">Status</th>
                    <th class="table-header px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @for($i = 1; $i <= 5; $i++)
                <tr class="hover:bg-gray-50">
                    <td class="table-cell">BRG-00{{ $i }}</td>
                    <td class="table-cell">Laptop Dell Inspiron {{ $i }}5</td>
                    <td class="table-cell">Elektronik</td>
                    <td class="table-cell">
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $i % 3 == 0 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $i * 3 }} unit
                        </span>
                    </td>
                    <td class="table-cell">
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $i % 3 == 0 ? 'bg-green-100 text-green-800' : ($i % 3 == 1 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $i % 3 == 0 ? 'Tersedia' : ($i % 3 == 1 ? 'Dipinjam' : 'Rusak') }}
                        </span>
                    </td>
                    <td class="table-cell">
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-green-600 hover:text-green-800" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan 1-5 dari 124 barang
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
@endsection