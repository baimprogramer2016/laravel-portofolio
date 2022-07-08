<?php

namespace App\Http\Controllers;
use App\Helpers\BaseFunctions as HelpersBaseFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Job;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        return view('home',[
            'session_email' => $request->session()->get('email'),
            'session_name' => $request->session()->get('name'),
            'session_role' => $request->session()->get('role'),
        ]);
    }

    public function createjob(Request $request)
    {
        if(auth()->user()->role != 'LEAD')
        {
            return redirect('/home')->with('noaccess',"Access is Denied");
        }
        else
        {
        return view('dashboard.createjob',[
            // 'session_email' => $request->session()->get('email'),
            // 'session_name' => $request->session()->get('name'),
            // 'session_role' => $request->session()->get('role'),
        ]);
    }
    }

    public function register(Request $request)
    {
        if(auth()->user()->role != 'LEAD')
        {
            return redirect('/home')->with('noaccess',"Access is Denied");
        }
        else
        {
            return view("dashboard.register",[
                "title_bar" => "Register User"
            ]);
        }
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
        $verifyrequest['user_id'] = auth()->user()->id;
        $verifyrequest['created_at'] = now();
        $verifyrequest['updated_at'] = now();

        $result = DB::table('users')->insert(
            $verifyrequest
        );

        if($result)
        {
            return redirect('register-user')->with('success','Register successfully');
        }
        else
        {
            return redirect('register-user')->with('failed','Failed to Register');
        }
    }

    public function storejob(Request $request)
    {
        $credential = $request->validate([
            'alias' => 'required|max:255',
            'name' => 'required|max:255',
        ]);
        $slug_job_split = explode(' ',$request->name);
        $credential['slug_job'] = join('-',$slug_job_split);
        $credential['user_id'] = auth()->user()->id;
        $credential['status'] = 'Open';

        $result = Job::create($credential);
        session(['job_id' => Crypt::encrypt($result->id)]);
        return redirect('/dashboard/invite-user');
    }

    public function openjob(Request $request)
    {
        $jobs = Job::paginate(6);
        return view('dashboard.openjobs',[
            "jobs" => $jobs->withQueryString(),
            'user_not_ready' => 'No Jobs, Please Create'
        ]);
    }
    public function gotoinviteuser(Request $request)
    {
        session(['job_id' => $request->id]);
        return redirect('/dashboard/invite-user');
    }
}
