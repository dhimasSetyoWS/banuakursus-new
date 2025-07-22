<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Period;
use App\Models\Role;
use App\Models\Course;
use App\Models\CourseSessions;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashPageController extends Controller
{
    //
    public function main()
    {
        $totalCourse = Auth::user()->course()->count(); // intelpehense anggap error di course(), kocak
        // dd($totalCourse);
        return Inertia::render('Dashboard/Main', [
            'totalCourse' => $totalCourse
        ]);
    }

    public function manage_course(Request $request)
    {
        // intelpehense anggap error di course(), kocak
        $course = Auth::user()->course()->when($request->search, function ($query) use ($request) {
            $query->where('title_course', 'like', '%' . $request->search . '%');
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $period = Period::all();
        return Inertia::render('Dashboard/ManageCourse', [
            'courses' => $course,
            'periods' => $period,
            'search' => $request->search
        ]);
    }
    public function manage_course_edit(string $slug)
    {
        $course = Course::firstWhere('slug', $slug);
        $period = Period::all();
        $sessions = CourseSessions::where('course_id', $course->id)->get();
        return Inertia::render('Dashboard/Edit/EditCourse', [
            'course' => $course,
            'periods' => $period,
            'sessions' => $sessions
        ]);
    }

    public function session_create(string $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail(['id', 'title_course', 'slug']);
        return Inertia::render('Dashboard/Create/CreateSession', [
            'course' => $course,
        ]);
    }
    public function session_edit($sessionId)
    {
        $courseSession = CourseSessions::where('id', $sessionId)->firstOrFail();
        $course = $courseSession->course;
        if ($courseSession->kategori == 'artikel') {
            $artikel = $courseSession->artikel;
        } elseif ($courseSession->kategori == 'tugas') {
            $tugas = $courseSession->tugas;
        }
        return Inertia::render('Dashboard/Edit/EditSession', [
            'course' => $course,
            'session' => $courseSession,
            'artikel' => isset($artikel) ? $artikel : [],
            'tugas' => isset($tugas) ? $tugas : []
        ]);
    }

    public function teacher()
    {
        $teacher = Role::find(3)->user()->get(); // intelpehense anggap error di course(), kocak
        // dd($teacher);
        return Inertia::render('Dashboard/Guru', [
            'teachers' => $teacher
        ]);
    }

    public function student()
    {
        $student = Role::find(4)->user()->get(); // intelpehense anggap error di course(), kocak
        // dd($siswa);
        return Inertia::render('Dashboard/Siswa', [
            'students' => $student
        ]);
    }
    public function task()
    {
        return Inertia::render('Dashboard/Tugas');
    }
    public function article()
    {
        // $artikel = Artikel::all();
        $artikel = Artikel::with('course_sessions.course')->get();
        return Inertia::render('Dashboard/Artikel', [
            'artikel' => $artikel
        ]);
    }
    public function article_create()
    {
        return Inertia::render('Dashboard/Create/CreateArtikel');
    }
    public function task_create()
    {
        return Inertia::render('Dashboard/Create/CreateTugas');
    }

    public function kategori()
    {
        $kategori =  Kategori::all();
        return Inertia::render('Dashboard/Kategori', [
            'kategori' => $kategori
        ]);
    }

    // Student Previlege
    public function mycourse()
    {
        $user = auth()->user();

        if ($user) {
            $registerData = $user->registeredCourses;
        }
        return Inertia::render('Dashboard/Student/MyCourse', [
            'courses' => $registerData,
        ]);
    }
    public function study($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(
                [
                    'course_sessions' => function ($query) { // di dalam course_sessions ambil query, kemudian ambil query artikel dan tugas, jadi query relation ke artikel dan tugas juga terinclude ke dalam $course
                        $query->with('artikel', 'tugas');
                    },
                    'kategori'
                ]
            )->firstOrFail();
        return Inertia::render('Study/Study', [
            'course' => $course->only(['id' , 'title_course' , 'slug' , 'kategori', 'course_sessions']),
        ]);
    }
}
