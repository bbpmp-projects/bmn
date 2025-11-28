<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method untuk menampilkan dashboard admin
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
