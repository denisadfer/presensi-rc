<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Shift;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

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
        function convertDate($date, $format = 'Y-m-d')
        {
            $tz1 = 'GMT';
            $tz2 = 'Asia/Jakarta'; // UTC +7

            $d = new DateTime($date, new DateTimeZone($tz1));
            $d->setTimeZone(new DateTimeZone($tz2));

            return $d->format($format);
        }
        $currentDate = convertDate(Date("Y-m-d"));
        return view('user.home', [
            'title' => 'Home',
            'user' => Auth::user()->id,
            'name' => User::where('id', Auth::user()->id)->get(),
            'shift' => Shift::where('work_date', $currentDate)->get(),
        ]);
    }

    public function admin()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $firstDay = date('Y-m-d', strtotime("+0 day", strtotime($weekStartDate)));
        $seventhDay = date('Y-m-d', strtotime("+6 day", strtotime($weekStartDate)));
        return view('admin.home', [
            'title' => "Dashboard",
            'shifts' => Shift::all()->whereBetween('work_date', [$firstDay, $seventhDay])
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
            'username' => $request->username,
            'position' => $request->position
        ]);
        
        return redirect('/admin/users');
    }
}