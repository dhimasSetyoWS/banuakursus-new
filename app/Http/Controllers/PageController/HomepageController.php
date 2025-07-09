<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;

class HomepageController extends Controller
{
    public function welcome()
    {
        // Alert::success('Berhasil!' , 'Anda berhasil Login');
        return Inertia::render('Homepage/Welcome', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    public function catalog()
    {
        return Inertia::render('Homepage/Catalog', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    public function aboutus()
    {
        return Inertia::render('Homepage/AboutUs', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    public function contact()
    {
        return Inertia::render('Homepage/Contact', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
