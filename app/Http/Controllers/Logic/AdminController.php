<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Teacher
    public function store_teacher(Request $request)
    {
        $a = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        // dd($a);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);
        Session::flash('success', 'Guru berhasil dibuat !');
        return redirect()->route('teacher');
    }
    // Student
    public function store_student(Request $request)
    {
        $a = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        // dd($a);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 4,
        ]);
        Session::flash('success', 'Murid berhasil dibuat !');
        return redirect()->route('student');
    }
    // Update and delete
    public function update_user(Request $request, User $user)
    {
        // unique format = unique:table,column,except,idColumn
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $user->id
        ]);
        switch ($user->role_id) {
            case 3:
                $role_name = "Guru";
                break;
            case 4:
                $role_name = "Siswa";
                break;

            default:
                $role_name = "User";
                break;
        }
        if ($user->update($request->only('name' , 'username' , 'email'))) {
            return redirect()->back()->with('success', "Data $role_name berhasil di update");
        }
        return redirect()->back()->with('Error', "Data $role_name gagal di update");
    }

    public function delete_user(User $user)
    {
        switch ($user->role_id) {
            case 3:
                $role_name = "Guru";
                break;
            case 4:
                $role_name = "Siswa";
                break;

            default:
                $role_name = "User";
                break;
        }
        if ($user->delete()) {
            return redirect()->back()->with('success', "Data $role_name berhasil di hapus");
        }
        return redirect()->back()->with('error', "Data $role_name gagal di hapus");
    }
}
