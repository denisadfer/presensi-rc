<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->roles == 'USER') {
                return redirect('/home');
            } elseif (Auth::user()->roles == 'ADMIN') {
                return redirect('/admin/dashboard');
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function add_user()
    {
        return view('admin.register', [
            "title" => "Register",
            "positions" => Position::all()
        ]);
    }

    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'position' => $request->position
        ]);

		return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function home()
    {
        return view('user.home', [
            'title' => 'Home',
            'user' => Auth::user()->id,
            'name' => User::where('id', Auth::user()->id)->get('name')
        ]);
    }

    public function admin()
    {
        return view('admin.home', [
            'title' => "Dashboard",
        ]);
    }

    public function list_user()
    {
        return view('admin.employee', [
            "title" => "Employee",
            "users" => User::all()->where('roles', 'USER'),
        ]);
    }
    
    public function profile()
    {
        return view('user.profile', [
            "title" => "Profile",
            "user" => User::all()->where('id', Auth::user()->id),
            "positions" => Position::all()
        ]);
    }
    
    public function edit_profile(Request $request)
    {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'username' => $request->username
        ]);
        
        return redirect('/home');
    }

    public function admin_profile($id)
    {
        return view('admin.profile', [
            "title" => "Employee",
            "user" => User::all()->where('id', $id),
            "positions" => Position::all()
        ]);
    }

    public function admin_edit_profile(Request $request)
    {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'username' => $request->username
        ]);
        
        return redirect('/admin/users');
    }
}