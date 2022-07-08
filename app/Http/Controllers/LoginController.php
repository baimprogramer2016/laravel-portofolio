<?php

namespace App\Http\Controllers;

use App\Helpers\BaseFunctions as HelpersBaseFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Facade\FlareClient\Http\Exceptions\InvalidData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if(auth::check())
        {
            if(auth()->user()->role == 'LEAD')
            {
                return redirect('/home');
            }
            else
            {
                return redirect('/developer');
            }
        }
        else
        {
        return view("auth.login",[
            "title_bar" => config('constants.titlebar.login'),
        ]);
        }
    }




    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => 'required|email:dns',
            "password" => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if(auth()->user()->role == 'LEAD')
            {
                return redirect('/home');
            }
            else
            {
                return redirect('/developer');
            }

        }else{
            return redirect('/login')->with('failed','Username Or Password is Wrong');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function register(Request $request)
    {
        HelpersBaseFunctions::checklogin($request);
        return view("auth.register",[
            "title_bar" => config('constants.titlebar.register'),
        ]);
    }

    public function saveregister(Request $request)
    {
        $verifyrequest = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:Users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $verifyrequest['password'] = Hash::make($verifyrequest['password']);
        $verifyrequest['created_at'] = now();
        $verifyrequest['updated_at'] = now();

        $result = DB::table('users')->insert(
            $verifyrequest
        );

        if($result)
        {
            return redirect('login')->with('success','Register successfully, Please Login');
        }
        else
        {
            return redirect('register')->with('failed','Failed to Register');
        }
    }
}


