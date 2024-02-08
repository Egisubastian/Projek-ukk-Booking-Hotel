<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogM;

class LoginC extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            $LogM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Login'
            ]);
        
            $redirectTo = '/'; 
        
            $user = Auth::user();
    
            // Set flash message here
            $request->session()->flash('success', 'Anda berhasil login!');
    
            if ($user) {
                switch ($user->role) {
                    case 'admin':
                        return redirect('/dashboard');
                        break;
                    case 'kasir':
                    case 'owner':
                        return redirect('/dashboard');
                        break;
                    default:
                        return redirect('/login');
                }
            }
        } else {
            return back()
                ->withErrors(['loginError' => 'Username atau password salah'])
                ->withInput($request->except('password'));
        }
    }
    

    public function logout(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Logout'
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
