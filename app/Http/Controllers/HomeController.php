<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

Route::get('/', function () {
    $donasiDisetujui = Donasi::where('status', 'Disetujui')->get();
    return view('welcome', compact('donasiDisetujui'));
});
class HomeController extends Controller
{
    public function index()
    {
        $donasis = Donasi::where('status', 'Disetujui')->get();
        return view('welcome', compact('donasis'));
    }
}
