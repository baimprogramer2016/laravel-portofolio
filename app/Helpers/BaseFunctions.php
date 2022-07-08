<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class BaseFunctions
{
    public static function checklogin($request)
    {
        if($request->session()->get('email') !="")
        {
            $checkuser = DB::table('users')->where('email', $request->session()->get('email'));
            if($checkuser != ""){
                return redirect('/dashboard');
            }else{
                return redirect('/login');
            }
        }
    }
}
