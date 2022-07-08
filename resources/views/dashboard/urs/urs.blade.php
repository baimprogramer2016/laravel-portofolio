
@extends('dashboard.layouts.main')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-bounding-box'></i> User Request Spesification</h1>
</div>
<div class="container ">
    <div class="row">
        <div class="col-md-8">
        @if (@session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <form action="/dashboard/urs" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title Form</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name='title' aria-describedby="title">
              @error('title')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="noted" class="form-label">Noted</label>
                @error('body')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="body" type="hidden" name="body" required value={{ old('body') }}>
                <trix-editor input="body"></trix-editor>
              </div>
            <button type="submit" class="btn btn-primary" name="save"><i class="bi bi-save2"></i> Save</button>
            <a href="/dashboard/urs-list" class='btn btn-info text-white'><i class='bi bi-card-list'></i> List Data</a>
          </form>
        </div>
    </div>
</div>
    <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>

@endsection
