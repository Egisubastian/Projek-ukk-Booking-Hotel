<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirech;

class UsersR extends Controller
{

    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman User'
        ]);
        $subtitle = "Daftar Pengguna";
        $UsersM = User::all();
        return view('user.users_index', compact('subtitle', 'UsersM'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah User'
        ]);
        $subtitle = "Tambah Produk";
        return view('user.users_create', compact('subtitle'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah User'
        ]);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required'
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $user->save();

        return redirect()->route('users.store')->with('success', 'Pengguna Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Berada Di Halaman Edit User'
    ]);

    $subtitle = "Edit Data Pengguna";
    $user = User::find($id); // Assuming $user is your user data
    $roles = "admin, kasir, owner";
    $rolesArray = explode(', ', $roles);

    return view('user.users_edit', compact('subtitle', 'user', 'roles'));
}

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit User'
        ]);
        $request->validate([
            'name' => 'required',
            // 'username' => 'required',
            'role' => 'required'
        ]);
   
        $data = request()->except(['_token', '_method', 'submit']);
   
        User::where('id', $id)->update($data);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbaharui');
    }

    public function destroy($id)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Menghapus User'
    ]);

    // Delete logs associated with the user
    LogM::where('id_user', $id)->delete();

    // Now, delete the user
    User::where('id', $id)->delete();

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
}


    public function changepassword($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Ganti Kata Sandi User'
        ]);
        $subtitle = "Edit Kata Sandi Pengguna";
        $data = User::find($id);
        return view('user.users_changepassword', compact('subtitle', 'data'));
    }

    public function change(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Ganti Kata Sandi User'
        ]);
        $request->validate([
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new',
        ]);
        $users = User::where("id", $id)->first();
        $users->update([
            'password' => Hash::make($request->password_new),
        ]);
        return redirect()->route('users.index')->with('success', 'Kata Sandi Pengguna Berhasil Diperbaharui');
    }

    public function pdf()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Produk'
        ]);

        $User = User::all();
        $pdf = PDF::loadview('user.users_pdf', ['User' => $User]); // Perhatikan penggunaan 'User'
        return $pdf->stream('users.pdf');
    }
}
