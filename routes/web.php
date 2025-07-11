<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Logic\AdminController;
use App\Http\Controllers\Logic\CourseController;
use App\Http\Controllers\Logic\SessionController;
use App\Http\Controllers\PageController\HomepageController;
use App\Http\Controllers\PageController\AuthViewController;
use App\Http\Controllers\PageController\DashPageController;
use App\Http\Controllers\Logic\TransactionController;


Route::get('/', [HomepageController::class, 'welcome'])->name('beranda');
Route::get('/catalog', [HomepageController::class, 'catalog'])->name('catalog');
Route::get('/aboutus', [HomepageController::class, 'aboutus'])->name('aboutus');
Route::get('/contact', [HomepageController::class, 'contact'])->name('contact');
Route::get('/course/{slug}', [HomepageController::class, 'course'])->name('course');


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
    Route::get('/dashboard/article', [DashPageController::class, 'article'])->name('article');
    Route::get('/dashboard/article/create', [DashPageController::class, 'article_create'])->name('article.create');
    Route::get('/dashboard/teacher', [DashPageController::class, 'teacher'])->name('teacher');
    Route::post('/dashboard/teacher', [AdminController::class, 'store_teacher'])->name('teacher.store');
    Route::get('/dashboard/student', [DashPageController::class, 'student'])->name('student');
    Route::post('/dashboard/student', [AdminController::class, 'store_student'])->name('student.store');
});
// Teacher and admin Route
Route::middleware(['auth', 'role:admin,superadmin,teacher'])->group(function () {
    Route::get('/dashboard', [DashPageController::class, 'main'])->name('dashboard');
    Route::get('/dashboard/manage-course', [DashPageController::class, 'manage_course'])->name('manage-course');
    Route::post('/dashboard/manage-course/create', [CourseController::class, 'store'])->name('manage-course.store');
    Route::get('/dashboard/manage-course/{slug}', [DashPageController::class, 'manage_course_edit'])->name('manage-course.edit');
    Route::match(['patch', 'put'], '/dashboard/update-course/{slug}', [CourseController::class, 'update'])->name('manage-course.update');
    Route::delete('/dashboard/manage-course/{slug}/delete', [CourseController::class, 'delete'])->name('manage-course.delete');
    Route::get('/dashboard/session/{slug}/create', [DashPageController::class, 'session_create'])->name('session.create');
    Route::post('/dashboard/session/{id}/store', [SessionController::class, 'store'])->name('session.store');
    Route::get('/dashboard/session/{id}/edit', [DashPageController::class, 'session_edit'])->name('session.edit');
    Route::post('/dashboard/session/{id}/update/{sessionId}', [SessionController::class, 'update'])->name('session.update');
});

Route::middleware(['auth' , 'role:student'])->group(function () {
    Route::get('/register_course/{slug}' , [TransactionController::class, 'register_course'])->name('register.course');
    Route::get('/dashboard/mycourse', [DashPageController::class , 'mycourse'])->name('mycourse');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function () {
    return view('error.404');
});
