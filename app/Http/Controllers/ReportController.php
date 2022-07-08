<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\crypt;
use App\Models\Jobuser;
use App\Models\Job;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $user_job = Jobuser::where('job_id', Crypt::decrypt(session()->get('job_id')))->get();
        return view('dashboard.reports.form-report',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'user_job' => $user_job,
            'result_report' => "empty"
        ]);
    }

    public function reportget(Request $request)
    {
        $user_job = Jobuser::where('job_id', Crypt::decrypt(session()->get('job_id')))->get();
        return view('dashboard.reports.form-report',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'user_job' => $user_job,
            'result_report' => "avalable"
        ]);

    }


    public function getId($job_id){
        $request_id = Crypt::decrypt($job_id);
        $data = Job::where('id', $request_id)->first();
        return $data;
    }
}
