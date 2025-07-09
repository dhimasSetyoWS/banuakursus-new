<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController\HomepageController;
use App\Http\Controllers\PageController\AuthViewController;
use App\Http\Controllers\PageController\DashPageController;
Route::get('/', [HomepageController::class, 'welcome'])->name('beranda');
Route::get('/catalog', [HomepageController::class, 'catalog'])->name('catalog');
Route::get('/aboutus', [HomepageController::class, 'aboutus'])->name('aboutus');
Route::get('/contact', [HomepageController::class, 'contact'])->name('contact');


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'enter'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['auth' , 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard', [DashPageController::class, 'main'])->name('dashboard');
    Route::get('/dashboard/manage-course', [DashPageController::class, 'manage_course'])->name('manage-course');
    Route::get('/dashboard/teacher', [DashPageController::class, 'teacher'])->name('teacher');
    Route::get('/dashboard/student', [DashPageController::class, 'student'])->name('student');
    Route::get('/dashboard/task', [DashPageController::class, 'task'])->name('task');
    Route::get('/dashboard/task/create', [DashPageController::class, 'task_create'])->name('task.create');
    Route::get('/dashboard/article', [DashPageController::class, 'article'])->name('article');
    Route::get('/dashboard/article/create', [DashPageController::class, 'article_create'])->name('article.create');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
