<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Support\Facades\Crypt;
use App\Models\Task;
use App\Models\Jobuser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        //menampilkan user yang join pada job
        $user_task  = DB::table('tasks')
                     ->select('tasks.user_id','users.name',DB::raw('count(*) as task_count'))
                     ->leftJoin('Users', 'tasks.user_id','Users.id')
                     ->leftJoin('jobs','tasks.job_id', 'jobs.id')
                     ->where('job_id', Crypt::decrypt(session()->get('job_id')))
                     ->groupBy('tasks.user_id', 'users.name')
                     ->get();

        return view('dashboard.task.task',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'user_task' => $user_task,
        ]);
    }


    public function percent($user_id)
    {
        $percent = Task::where('job_id', Crypt::decrypt(session()->get('job_id')))
                        ->where('status','D')
                        ->where('user_id', $user_id)
                        ->sum('percent');
                        return $percent;
    }

    //menghitung jumlah task
    public static function taskdone($user_id)
    {
        $count = Task::where('job_id', Crypt::decrypt(session()->get('job_id')))
                ->where('user_id', $user_id)
                ->where('status','D') //D = Done , O = Open
                ->count();

        return $count;
    }

    //create
    public function create(Request $request)
    {
        //select user pada job itu
        $result = Jobuser::where('job_id', Crypt::decrypt(session()->get('job_id')))->get();

        return view('dashboard.task.task-create',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'user_job' => $result
        ]);
    }

    public function savetask(Request $request)
    {

        //validasi
        $data = $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:255',
            'day' => 'required',
            'percent' => 'required',
            'description' =>'required'
        ]);

        $data['job_id'] = Crypt::decrypt(session()->get('job_id'));
        $data['status'] = 'O';

        Task::create($data);
        return redirect('/dashboard/task-create')->with('success','Task Has Been Create');
    }


    //------------------------------------------------------- DETAIL----------------------------------
    //detail task
    public function detailtask(Request $request)
    {
        $result = Task::where('job_id', Crypt::decrypt(session()->get('job_id')))
                        ->where('user_id', Crypt::decrypt($request->user_id))
                        ->get();


        return view('dashboard.task.task-detail',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'task_user' => $result,
            'user_name'=> User::where('id', Crypt::decrypt($request->user_id))->select('name')->first(),
            'task_count'=> Task::where('user_id', Crypt::decrypt($request->user_id))->where('job_id', Crypt::decrypt(session()->get('job_id')))->count(),
            'task_done'=> Task::where('user_id', Crypt::decrypt($request->user_id))->where('job_id', Crypt::decrypt(session()->get('job_id')))->where('status','D')->count(),
            'task_percent'=> Task::where('user_id', Crypt::decrypt($request->user_id))->where('job_id', Crypt::decrypt(session()->get('job_id')))->where('status','D')->sum('percent')
        ]);
    }
       //get session Job
       public function getId($job_id){
        $request_id = Crypt::decrypt($job_id);
        $data = Job::where('id', $request_id)->first();
        return $data;
    }
}
