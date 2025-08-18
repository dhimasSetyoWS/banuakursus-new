<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\CourseSessions;
use Illuminate\Http\Request;
use App\Models\Course;

class SessionController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $request->validate([
            'session_name' => ['required', 'string', 'max:120'],
            'start_session' => ['required', 'date'],
            'end_session' => ['required', 'date']
        ]);

        $courseSession = CourseSessions::create([
            'session_name' => $request->session_name,
            'start_session' => $request->start_session,
            'end_session' => $request->end_session,
            'course_id' => $id
        ]);

        $slug = Course::findOrFail($id)->slug;
        return redirect()->route('manage-course.edit', $slug)->with('success', 'Session baru telah ditambahkan!');
    }
    public function update(Request $request, $id, $sessionId)
    {
        $session = Course::findOrFail($id)->course_sessions()->find($sessionId);
        $request->validate([
            'session_name' => ['required', 'string', 'max:120'],
            'start_session' => ['required', 'date'],
            'end_session' => ['required', 'date']
        ]);

        $courseSession = $session->update([
            'session_name' => $request->session_name,
            'start_session' => $request->start_session,
            'end_session' => $request->end_session,
        ]);
        $slug = Course::findOrFail($id)->slug;
        return redirect()->route('manage-course.edit', $slug)->with('success', 'Session telah ter-update!');
    }
    public function delete($id)
    {
        $session = CourseSessions::find($id);
        $a = $session->delete();
        if ($a) {
            return redirect()->back()->with('success', 'Session telah dihapus!');
        }
        return redirect()->back()->with('error', 'Session gagal dihapus!');
    }
}
