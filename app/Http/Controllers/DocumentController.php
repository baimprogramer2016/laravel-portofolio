<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Job;
use App\Models\document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        //list table document
        $result = Document::where('job_id', Crypt::decrypt(session()->get('job_id')))->orderByDesc('id')->paginate(5);

        return view('dashboard.document.document',[
            'job_name' => self::getId(session()->get('job_id'))->name,
            'result_document' => $result,
        ]);
    }

    public function documentstore(Request $request)
    {
        $val_data = $request->validate([
            'title' => 'required|max:255',
            'path' => 'required|max:1024',
        ]);

        if($request->file('path'))
        {
            $val_data['path'] = $request->file('path')->store('file_uploads');
        }

        $val_data['job_id'] =  Crypt::decrypt(session()->get('job_id'));

        document::create($val_data);

        return redirect('/dashboard/document')->with('success', 'Data is Saved');

    }
    //delete
    public function documentdelete(Request $request)
    {

        $delete = Document::find(Crypt::decrypt($request->id));

        $delete->delete();

        if($delete->path)
        {
            Storage::delete($delete->path);
        }
       return redirect('/dashboard/document')->with('success','Delete is Successfully');
    }

    //get session Job
    public function getId($job_id){
        $request_id = Crypt::decrypt($job_id);
        $data = Job::where('id', $request_id)->first();
        return $data;
    }
}

