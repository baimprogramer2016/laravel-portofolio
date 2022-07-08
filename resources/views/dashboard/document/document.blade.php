
@extends('dashboard.layouts.main')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="bi bi-file-earmark-check"></i> Document</h1>
</div>
<div class="container ">
    <div class="col">

        <div class="col-md-8">
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form action='/dashboard/document-store' method='post' enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name='title' aria-describedby="title" value='{{ old('title') }}'>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="path" class="form-label">Document</label>
                <input class="form-control @error('path') is-invalid @enderror" type="file" id="path" name='path' >
                @error('path')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <div class="col-md-8 mt-5">
            @foreach($result_document as $item_document)
                <div class="row mb-3 border border-secondary p-2 justify-content-between">
                    <div class="col-md-6">
                      {{ $item_document->title }}<br>
                      <p class='text-secondary'>{{ \Carbon\Carbon::parse($item_document->updated_at)->diffForHumans() }}</p>
                    </div>
                    <div class="col-md-2 my-auto pt-3">
                        <p><i class="bi bi-file-earmark-pdf"></i> <a target='_blank' href="{{ asset('storage/'.$item_document->path) }}"> Download File</a></p>
                        <form action="/dashboard/document-delete/{{ Crypt::encrypt($item_document->id) }}" method='post'>
                            @method('delete')
                            @csrf
                            <button class='text-danger' onclick="return confirm('Are You Sure ?')"><i class="bi bi-x-circle"></i>  Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="col d-flex justify-content-center">
                {{ $result_document->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
