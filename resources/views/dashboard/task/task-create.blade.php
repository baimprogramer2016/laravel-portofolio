
@extends('dashboard.layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-plus-circle'></i> Create Task</h1>
</div>
<div class="container ">
    @if (@session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <a href="/dashboard/task" class='btn btn-primary'><i class='bi bi-arrow-left'></i> Back Task</a>
    <div class="row">
        <div class="col-md-8">
        <form action='/dashboard/task-save' method='post'>
            @csrf
            <div class="mb-3 mt-3">

              <label for="user_id" class="form-label">Pick User</label>
              <select class="form-select" name='user_id' aria-label="Default select example">

                @foreach ($user_job as $item_user)
                <option value="{{ $item_user->user->id }}">---- {{ $item_user->user->name }}</option>
                @endforeach

              </select>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name='title'>
              @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="row">
                <div class="col-2 ">
                  <input type="number" id="day" name='day' class="form-control @error('title') is-invalid @enderror"" aria-describedby="day">
                @error('day')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
                </div>
                <div class="col-2 ">
                    <label for="days" class="col-form-label">Days</label>
                </div>
                <div class="col-2">
                    <input type="number" id="percent" name='percent' class="form-control @error('title') is-invalid @enderror"" aria-describedby="percent">
                    @error('percent')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-2">
                    <label for="percent" class="col-form-label">%</label>
                </div>
              </div>
            <div class="mb-3 mt-3">
                <label for="noted" class="form-label">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="description" type="hidden" name="description"  required value={{ old('description') }}>
                <trix-editor input="description"></trix-editor>
              </div>
            <button type="submit" class="btn btn-primary mb-5" name="save"><i class="bi bi-save2"></i> Save</button>
          </form>
        </div>
    </div>
</div>
@endsection

