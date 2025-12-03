<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        // me-return view resources/views/permintaan/permintaan.blade.php
        return view('permintaan.permintaan');
    }
}
