<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\CourseSessions;
class MaterialController extends Controller
{
    public function store(Request $request, CourseSessions $session) {
        $request->validate([
            'material' => ['required','string'],
            'title' => ['required' , 'string']
        ]);
        $created = $session->material()->create([
            'title' => $request->title,
            'content' => $request->material,
        ]);

        if ($created) {
            return redirect()->route('session.edit' , $session->id)->with('success' , 'Berhasil menambahkan material');
        }
        return redirect()->route('material.create' , $session->id)->with('error' , 'Gagal menambahkan material');
    }

    public function update(Request $request,CourseSessions $session, Material $material) {
        $request->validate([
            'title' => ['required','string'],
            'material' => ['required','string']
        ]);
        $updated = $material->update([
            'title' => $request->title,
            'content' => $request->material
        ]);

        if($updated) {
            return redirect()->route('session.edit' , $session->id)->with('success' , 'Berhasil mengupdate material');
        }
        return redirect()->route('material.create' , $session->id)->with('error' , 'Gagal mengupdate material');

    }

    public function delete(CourseSessions $session, Material $material) {
        $deleted = $material->delete();
        if ($deleted) {
            return redirect()->route('session.edit' , $session->id)->with('success' , 'Berhasil menghapus material');
        }
    }
}
