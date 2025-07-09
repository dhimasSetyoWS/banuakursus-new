<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Role;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class DashPageController extends Controller
{
    //
    public function main() {
        $totalCourse = Auth::user()->course()->count(); // intelpehense anggap error di course(), kocak
        // dd($totalCourse);
        return Inertia::render('Dashboard/Main', [
            'totalCourse' => $totalCourse
        ]);
    }

    public function manage_course() {
        $course = Auth::user()->course()->orderBy('id' , 'desc')->paginate(10); // intelpehense anggap error di course(), kocak
        $period = Period::all();
        return Inertia::render('Dashboard/ManageCourse', [
            'courses' => $course,
            'periods' => $period
        ]);
    }
    public function manage_course_edit(string $slug) {
        $course = Course::firstWhere('slug' , $slug);
        $period = Period::all();
        return Inertia::render('Dashboard/Edit/EditCourse', [
            'course' => $course,
            'periods' => $period
        ]);
    }

    public function teacher() {
        $teacher = Role::find(3)->user()->get(); // intelpehense anggap error di course(), kocak
        // dd($teacher);
        return Inertia::render('Dashboard/Guru', [
            'teachers' => $teacher
        ]);
    }

    public function student() {
        $student = Role::find(4)->user()->get(); // intelpehense anggap error di course(), kocak
        // dd($siswa);
        return Inertia::render('Dashboard/Siswa', [
            'students' => $student
        ]);
    }
    public function task() {
        return Inertia::render('Dashboard/Tugas');
    }
    public function article() {
        return Inertia::render('Dashboard/Artikel');
    }
    public function article_create() {
        return Inertia::render('Dashboard/Create/CreateArtikel');
    }
    public function task_create() {
        return Inertia::render('Dashboard/Create/CreateTugas');
    }
}
