
@extends('dashboard.layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-calendar-check'></i> Detail Task</h1>
</div>
<div class="container ">
    <a href="/dashboard/task" class='btn-sm btn-primary mb-5 text-decoration-none'>Back to Task</a>
    <div class="row-md-4">
        <div class="col">
            <h2>Project Name</h2>
            <h5>Alias Name</h5>
            <div class="alert alert-warning p-2 mt-3">
                <b>Detail Info :</b>
                <div class="row" >
                    <div class="col-md-2">
                        User : <b>{{ $user_name->name }}</b>
                    </div>
                    <div class="col-md-2">
                        Task : <b>{{ $task_count }}</b>
                    </div>
                    <div class="col-md-2">
                        Done : <b>{{ $task_done }}</b>
                    </div>
                    <div class="col-md-2">
                        Percent : <b>{{ $task_percent }} %</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">

            @foreach ($task_user as $item_task)
            <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{  $item_task->title }}</h5>
                  <b class="mb-2 text-muted">Created : {{  \Carbon\Carbon::parse($item_task->created_at)->diffForHumans()  }}</b><br>
                  <a class="card-link text-decoration-none disabled">Day : {{ $item_task->day }}</a>
                  <a  class="card-link text-decoration-none">Status : {{ $item_task->status }}</a>
                  <a  class="card-link text-decoration-none">Percentage : {{ $item_task->percent }} %</a>
                  <p class="card-text">{!! $item_task->description  !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

