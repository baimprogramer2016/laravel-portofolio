
@extends('dashboard.layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-calendar-check'></i> Task</h1>
</div>
<div class="container ">
    <a href="/dashboard/task-create" class='btn btn-primary'><i class='bi bi-plus-circle'></i> Create Task</a>
    @if ( $user_task->count() > 0 )
    <div class="row justify-content-center">
        @foreach ($user_task as $item_task)

        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{ $item_task->name }}</h5>
              <div class="row">
                  <div class="col">
                      <p class="card-text">
                          Task :<b> {{ $item_task->task_count }} </b><br>
                          Done : <b>{{ App\Http\Controllers\TaskController::taskdone($item_task->user_id) }}</b> <br>
                        </p>
                  </div>
                  <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted"><h5 class='text-success'>Progress : {{ App\Http\Controllers\TaskController::percent($item_task->user_id) }}%</h5></h6>
                  </div>
              </div>
              <a href="/dashboard/task-detail/{{ Crypt::encrypt($item_task->user_id) }}" class="card-link">Detail</a>
            </div>
          </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show text-center mt-4" role="alert">
        Haven't Entered Tasks
    </div>
    @endif
</div>
@endsection

