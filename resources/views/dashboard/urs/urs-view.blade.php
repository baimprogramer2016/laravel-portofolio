
@extends('dashboard.layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-eye'></i> View User Request Spesification</h1>
</div>
<div class="container ">
    <div class="row">

        <div class="col-md-8 mb-5">
            <button><a href="/dashboard/urs-list/" class='btn-sm btn-info p-1 text-white text-decoration-none p-1'><i class='bi bi-card-list'></i>  Back to List</a></button>
            <button><a href="/dashboard/urs-edit/{{ Crypt::encrypt($data_urs->id) }}" class='btn-sm btn-success p-1 text-white text-decoration-none p-1'><i class='bi bi-pencil'></i>  Edit</a></button>
            <form action="/dashboard/urs-delete/{{ Crypt::encrypt($data_urs->id) }}" method="post" class='d-inline'>
                @csrf
                @method('delete')
                <button class='btn-sm btn-danger p-1 text-white text-decoration-none p-1' onclick="return confirm('Are You Sure ?')"><i class='bi bi-x-circle'></i>  Delete</button>
            </form>
            <div class="alert alert-warning p-3 mt-3">
            <div class="col">
                <h2>{{$data_urs->title }}</h2>
            </div>
            <div class="col">
                <p class="card-text"><small class="text-muted">Modified : {{ \Carbon\Carbon::parse($data_urs->created_at)->diffForHumans() }}</small></p>
            </div>
            <div class="col">
                <h5 class="card-text"><small class="text-muted">{{ $data_urs->name_job }} ({{ $data_urs->alias }})</small></h5>
            </div>
            </div>
            <div class="col ps-1 pe-2" >
               <p>{!! $data_urs->body !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection

