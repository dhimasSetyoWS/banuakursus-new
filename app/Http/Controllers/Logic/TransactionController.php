<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Carbon;
class TransactionController extends Controller
{
    //
    public function register_course(string $slug) {
        $course = Course::where('slug' , $slug)->firstOrFail();
        $user = auth()->user();
        if ($user->registeredCourses->contains($course->id)) {
            return back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        $user->registeredCourses()->attach($course->id);

        return back()->with('success', 'Anda berhasil mendaftar ke kursus ' . $course->title_course . '!');
    }
}
