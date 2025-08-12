<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Logic\AdminController;
use App\Http\Controllers\Logic\ArtikelController;
use App\Http\Controllers\Logic\CourseController;
use App\Http\Controllers\Logic\SessionController;
use App\Http\Controllers\PageController\HomepageController;
use App\Http\Controllers\PageController\AuthViewController;
use App\Http\Controllers\PageController\DashPageController;
use App\Http\Controllers\Logic\TransactionController;
use App\Http\Controllers\Logic\KategoriController;
use App\Http\Controllers\Logic\TaskController;
use Illuminate\Contracts\Session\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [HomepageController::class, 'welcome'])->name('beranda');
Route::get('/catalog', [HomepageController::class, 'catalog'])->name('catalog');
Route::get('/aboutus', [HomepageController::class, 'aboutus'])->name('aboutus');
Route::get('/contact', [HomepageController::class, 'contact'])->name('contact');
Route::get('/course/{slug}', [HomepageController::class, 'course'])->name('course');
Route::get('/profile/edit', [HomepageController::class, 'course'])->name('profile.edit');


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'enter'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

});
// Admin Route
Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/dashboard/task', [DashPageController::class, 'task'])->name('task');
    Route::get('/dashboard/task/create', [DashPageController::class, 'task_create'])->name('task.create');
    Route::post('/dashboard/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/dashboard/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::match(['put' , 'patch'], '/dashboard/task/update/{tugas}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/dashboard/task/delete/{tugas}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/dashboard/article', [DashPageController::class, 'article'])->name('article');
    Route::get('/dashboard/article/create', [DashPageController::class, 'article_create'])->name('article.create');
    Route::post('/dashboard/article/store', [ArtikelController::class, 'store'])->name('article.store');
    Route::get('/dashboard/article/edit/{artikel}', [ArtikelController::class, 'edit'])->name('article.edit');
    Route::match(['put' , 'patch'],'/dashboard/article/update/{artikel}', [ArtikelController::class, 'update'])->name('article.update');
    Route::delete('/dashboard/article/delete/{artikel}', [ArtikelController::class, 'delete'])->name('article.delete');
    Route::get('/dashboard/teacher', [DashPageController::class, 'teacher'])->name('teacher');
    Route::post('/dashboard/teacher', [AdminController::class, 'store_teacher'])->name('teacher.store');
    Route::match(['patch', 'put'], '/dashboard/teacher/{user}', [AdminController::class, 'update_user'])->name('teacher.update');
    Route::delete('/dashboard/teacher/{user}', [AdminController::class, 'delete_user'])->name('teacher.delete');
    Route::get('/dashboard/student', [DashPageController::class, 'student'])->name('student');
    Route::post('/dashboard/student', [AdminController::class, 'store_student'])->name('student.store');
    Route::match(['patch' , 'put'],'/dashboard/student/{user}', [AdminController::class, 'update_user'])->name('student.update');
    Route::delete('/dashboard/student/{user}', [AdminController::class, 'delete_user'])->name('student.delete');
    Route::get('/dashboard/kategori' , [DashPageController::class , 'kategori'])->name('kategori');
    Route::post('/dashboard/kategori' , [KategoriController::class , 'store'])->name('kategori.store');
    Route::delete('/dashboard/kategori/delete/{kategori}', [KategoriController::class , 'delete'])->name('kategori.delete');
    Route::patch('/dashboard/kategori/update/{kategori}', [KategoriController::class , 'update'])->name('kategori.update');
});
// Teacher and admin Route
Route::middleware(['auth', 'role:admin,superadmin,teacher'])->group(function () {
    Route::get('/dashboard', [DashPageController::class, 'main'])->name('dashboard');
    // Course
    Route::get('/dashboard/manage-course', [DashPageController::class, 'manage_course'])->name('manage-course');
    Route::get('/dashboard/manage-course/create' , [DashPageController::class, 'create_course'])->name('manage-course.create');
    Route::post('/dashboard/manage-course/store', [CourseController::class, 'store'])->name('manage-course.store');
    Route::get('/dashboard/manage-course/{slug}', [DashPageController::class, 'manage_course_edit'])->name('manage-course.edit');
    Route::match(['patch', 'put'], '/dashboard/update-course/{slug}', [CourseController::class, 'update'])->name('manage-course.update');
    Route::delete('/dashboard/manage-course/{slug}/delete', [CourseController::class, 'delete'])->name('manage-course.delete');
    // Session
    Route::get('/dashboard/session/{slug}/create', [DashPageController::class, 'session_create'])->name('session.create');
    Route::post('/dashboard/session/{id}/store', [SessionController::class, 'store'])->name('session.store');
    Route::get('/dashboard/session/{id}/edit', [DashPageController::class, 'session_edit'])->name('session.edit');
    Route::post('/dashboard/session/{id}/update/{sessionId}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/dashboard/session/delete/{id}', [SessionController::class, 'delete'])->name('session.delete');
    // Material
    Route::get('/dashboard/session/{id}/create_material', [DashPageController::class, 'material_create'])->name('material.create');
});

Route::middleware(['auth' , 'role:student'])->group(function () {
    Route::get('/register_course/{slug}' , [TransactionController::class, 'register_course'])->name('register.course');
    Route::get('/dashboard/mycourse', [DashPageController::class , 'mycourse'])->name('mycourse');
    Route::get('/study/{slug}', [DashPageController::class , 'study'])->name('study');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function () {
    return view('error.404');
});
