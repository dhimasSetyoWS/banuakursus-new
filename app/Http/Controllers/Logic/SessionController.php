<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\CourseSessions;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Tugas;

class SessionController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $request->validate([
            'session_name' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string'],
            'kategori' => ['required', 'string', 'in:artikel,tugas'],
        ]);

        $courseSession = CourseSessions::create([
            'session_name' => $request->session_name,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'course_id' => $id
        ]);

        if ($request->kategori == 'artikel') {
            // Validasi untuk Artikel

            $request->validate([
                'artikel_konten' => ['required', 'string'],
            ]);
            $artikel = Artikel::create([
                'judul' => $request->session_name,
                'konten' => $request->artikel_konten,
                'course_sessions_id' => $courseSession->id
            ]);
        } elseif ($request->kategori == 'tugas') {
            // Validasi untuk Tugas

            $request->validate([
                'isi_tugas' => ['required', 'string'],
                'tenggat_waktu' => ['nullable', 'date'],
            ]);
            $tugas = Tugas::create([
                'nama_tugas' => $request->session_name,
                'isi_tugas' => $request->isi_tugas,
                'tenggat_waktu' => $request->tenggat_waktu,
                'course_sessions_id' => $courseSession->id
            ]);
        }
        $slug = Course::findOrFail($id)->slug;
        return redirect()->route('manage-course.edit', $slug)->with('success', 'Session baru telah ditambahkan!');
    }
    public function update(Request $request, $id, $sessionId)
    {
        $session = Course::findOrFail($id)->course_sessions()->find($sessionId);
        $request->validate([
            'session_name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'kategori' => ['required', 'string'],
        ]);

        $courseSession = $session->update([
            'session_name' => $request->session_name,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'course_id' => $id
        ]);
        if ($courseSession) {
            if ($request->kategori == 'artikel') {
                // Validasi untuk Artikel
                $request->validate([
                    'artikel_konten' => ['required', 'string'],
                ]);
                $artikel = $session->artikel->update([
                    'judul' => $request->session_name,
                    'konten' => $request->artikel_konten,
                    'course_sessions_id' => $session->id
                ]);
            } elseif ($request->kategori == 'tugas') {
                // Validasi untuk Tugas
                $request->validate([
                    'isi_tugas' => ['required', 'string'],
                    'tenggat_waktu' => ['nullable', 'date'],
                ]);
                $tugas = $session->artikel->update([
                    'nama_tugas' => $request->session_name,
                    'isi_tugas' => $request->isi_tugas,
                    'tenggat_waktu' => $request->tenggat_waktu,
                    'course_sessions_id' => $session->id
                ]);
            }
        } else {
            return redirect()->back()->with('error', 'Session gagal di update!');
        }
        $slug = Course::findOrFail($id)->slug;
        return redirect()->route('manage-course.edit', $slug)->with('success', 'Session telah ter-update!');
    }
    public function delete($id) {
        $session = CourseSessions::find($id);
        $a = $session->delete();
        if ($a) {
            return redirect()->back()->with('success', 'Session telah dihapus!');
        }
        return redirect()->back()->with('error', 'Session gagal dihapus!');
    }
}
