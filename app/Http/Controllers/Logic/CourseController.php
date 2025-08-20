<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'title_course' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'kategori_id' => ['required'],
            'period_id' => ['required'],
            'price' => ['required', 'numeric', 'gt:0'],
        ]);

        Course::create([
            'title_course' => $request->title_course,
            'slug' => Str::slug($request->title_course),
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'period_id' => $request->period_id,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('manage-course')->with('success', 'Kursus Berhasil di tambahkan!');
    }

    public function update(Request $request, $slug)
    {
        $judulLama = Course::firstWhere('slug', $slug)->title_course;
        $request->validate([
            'title_course' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
        ]);
        $course = Course::where('slug', $slug)->update([
            'title_course' => $request->title_course,
            'slug' => Str::slug($request->title_course),
            'description' => $request->description,
            'price' => $request->price,
            'period_id' => $request->period_id
        ]);
        if ($course) {
            return redirect()->route('manage-course')->with('success' , 'Kursus dengan judul ' . $judulLama . ' telah di update');
        } else {
            return redirect()->route('manage-course')->with('error' , 'Kursus dengan judul ' . $judulLama . ' gagal di update!');
        }
    }

    public function delete(Course $course) {
        $judulLama = $course->title_course;
        $deleted = $course->delete();
        if($deleted) {
            return redirect()->back()->with('success' , 'Kursus dengan judul ' . $judulLama . ' telah di hapus!');
        }
        return redirect()->back()->with('error' , 'Kursus dengan judul ' . $judulLama . ' gagal di hapus!');
    }
}
