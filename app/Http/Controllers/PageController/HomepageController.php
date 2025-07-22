<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Kategori;
use App\Models\User;

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
    public function catalog(Request $request)
    {
        // Mulai satu instance query builder
        $coursesQuery = Course::query();

        // Kondisi 1: Filter berdasarkan Nama/Judul Kursus
        // Jika $request->search ada, tambahkan kondisi ke $coursesQuery
        $coursesQuery->when($request->search, function ($query) use ($request) {
            $query->where('title_course', 'like', '%' . $request->search . '%');
        });

        // Kondisi 2: Filter berdasarkan Kategori (slug)
        // Jika $request->category ada, tambahkan kondisi ke $coursesQuery yang SAMA
        $coursesQuery->when($request->category, function ($query) use ($request) {
            // Pastikan relasi di model Course Anda bernama 'kategori' (huruf kecil)
            $query->whereRelation('kategori', 'slug', $request->category);
        });

        // Sekarang, terapkan eager loading, pengurutan, dan pagination pada $coursesQuery yang sudah dibangun
        $course = $coursesQuery->with('kategori') // Eager load relasi kategori
                                ->orderBy('created_at', 'desc')
                                ->paginate(8, ['id', 'kategori_id', 'price', 'slug', 'title_course', 'user_id'])
                                ->withQueryString();
        $kategori = Kategori::all();
        return Inertia::render('Homepage/Catalog', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'courses' => $course,
            'search' => $request->search,
            'kategori' => $kategori,
            'c_search' => $request->category
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
    public function course(string $slug)
    {
        $course = Course::firstWhere('slug', $slug);
        $creator = User::find($course->user_id)->name;
        $sessions = $course->course_sessions()->get();
        return Inertia::render('Homepage/SingleCourse/Course', [
            'namaAplikasi' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'course' => $course,
            'sessions' => $sessions,
            'creator' => $creator
        ]);
    }
}
