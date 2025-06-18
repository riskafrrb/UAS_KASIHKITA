<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;


class HomeController extends Controller
{
    public function index()
    {
        $donasis = Donasi::where('status', 'Disetujui')->get();
        return view('welcome', compact('donasis'));
    }
}
