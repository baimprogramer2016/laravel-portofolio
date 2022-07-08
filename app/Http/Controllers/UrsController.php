<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urs;
use Illuminate\Support\Facades\Crypt;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class UrsController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.urs.urs',[
            'job_name' => self::getId(session()->get('job_id'))->name,
        ]);
    }

    public function storeurs(Request $request)
    {
        $valid_data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $valid_data['user_id'] = auth()->user()->id;
        $valid_data['job_id'] = Crypt::decrypt(session()->get('job_id'));

        Urs::create($valid_data);
        return redirect('/dashboard/urs-list')->with('success','Data is Saved');
    }

    //list urs
    public function listurs(Request $request)
    {
        $dataurs = DB::table('urs')
                  ->join('Jobs','urs.job_id','Jobs.id')
                  ->join('Users','urs.user_id','Users.id')
                  ->where('urs.job_id',Crypt::decrypt(session()->get('job_id')))
                  ->select('Users.name as name_create' ,'urs.id','jobs.name as name_job','urs.created_at','urs.title')
                  ->paginate(10);

        return view('dashboard.urs.urs-list',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'urs_data' => $dataurs,
        ]);
    }

    //view
    public function viewurs(Request $request)
    {

        $dataurs = DB::table('urs')
        ->join('Jobs','urs.job_id','Jobs.id')
        ->join('Users','urs.user_id','Users.id')
        ->where('urs.job_id',Crypt::decrypt(session()->get('job_id')))
        ->where('urs.id',Crypt::decrypt($request->id))
        ->select('Users.name as name_create' ,'urs.id','jobs.name as name_job','urs.created_at','urs.title', 'jobs.alias','urs.body')
        ->first();

        return view('dashboard.urs.urs-view',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'data_urs' => $dataurs,
        ]);
    }

    public function editurs(Request $request)
    {
        $editurs = Urs::where('id', Crypt::decrypt($request->id))->first();
        return view('dashboard.urs.urs-edit',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'data_urs' => $editurs,
        ]);
    }

    public function updateurs(Request $request)
    {
        $valid_data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $valid_data['user_id'] = auth()->user()->id;
        $valid_data['job_id'] = Crypt::decrypt(session()->get('job_id'));

        Urs::where('id', Crypt::decrypt($request->id))
            ->update($valid_data);

        $dataurs = DB::table('urs')
            ->join('Jobs','urs.job_id','Jobs.id')
            ->join('Users','urs.user_id','Users.id')
            ->where('urs.job_id',Crypt::decrypt(session()->get('job_id')))
            ->where('urs.id',Crypt::decrypt($request->id))
            ->select('Users.name as name_create' ,'urs.id','jobs.name as name_job','urs.created_at','urs.title', 'jobs.alias','urs.body')
            ->first();
        return view('dashboard.urs.urs-view',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'data_urs' => $dataurs,
        ]);
    }

    //delete
    public function deleteurs(Request $request)
    {
        //return $request;
        $delete = Urs::find(Crypt::decrypt($request->id));
        $delete->delete();
        return redirect('/dashboard/urs-list')->with('success','Data Has been Slain');
    }
    //get session Job
    public function getId($job_id){
        $request_id = Crypt::decrypt($job_id);
        $data = Job::where('id', $request_id)->first();
        return $data;
    }
}
