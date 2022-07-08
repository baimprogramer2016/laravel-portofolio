<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Job;
use App\Models\Jobuser;
use App\Models\User;
use Jobusers;

class DashboardController extends Controller
{

    //view page invite user
    public function inviteuser(Request $request)
    {
            $jobusers = Jobuser::where('job_id',Crypt::decrypt(session()->get('job_id')))->get(); //menampilkan darta Job user
            return view('dashboard.inviteuser.inviteuser',[
                'job_name' => self::getId(session()->get('job_id'))->name,
                'job_users' => $jobusers,
                'user_not_ready' => 'Come on, Invite Your Friend in Jobs'
            ]);
    }

    //proses simpan user ke dalam job
    public function storeinviteuser(Request $request)
    {
        $validate = $request->validate([
            'search' => 'required'
        ]);
        $user_id    =   User::select('id')->where('name','=',$request->search)->first();

        if($user_id == "")
        {
            return redirect('dashboard/invite-user')->with('failed','User Not Found');
        }
        else
        {
        $job_id     =   self::getId(session()->get('job_id'))->id;

        $checkuser  =   Jobuser::where('job_id','=',$job_id)
                                ->where('user_id','=',$user_id->id)
                                ->first();

        //check jika sudah ada pada job
        if($checkuser !="" )
        {
            return redirect('dashboard/invite-user')->with('failed',"User Already in The Job");
        }

        Jobuser::create([
            'job_id' => $job_id,
            'user_id' => $user_id->id,
        ]);

        return redirect('dashboard/invite-user');
        }
    }

    //delete jobuser
    public function deletejobuser(Request $request)
    {
        $delete = Jobuser::find(Crypt::decrypt($request->id));
        $delete->delete();
        return redirect('dashboard/invite-user')->with('success',"User Has Been Kick");
    }

    public function getId($job_id){
        $request_id = Crypt::decrypt($job_id);
        $data = Job::where('id', $request_id)->first();
        return $data;
    }
}
