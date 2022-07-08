
@extends('dashboard.layouts.main')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-card-list'></i> List Notes</h1>
</div>
<div class="container ">

    <div class="row">
        @if (@session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="d-flex justify-content-end">
            <button  class='ml-auto'><a href="/dashboard/urs" class='btn-sm btn-primary text-white text-decoration-none'><i class='bi bi-plus-circle'></i> Add Data</a></button>
        </div>
        @if ( $urs_data->count() > 0 )
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">User Create</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($urs_data as $urs_item)

                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $urs_item->title }}</td>
                        <td>{{ $urs_item->name_create }}</td>
                        <td>{{ $urs_item->created_at }}</td>

                        <td>

                                <a href="/dashboard/urs-view/{{ Crypt::encrypt($urs_item->id) }}" class='btn-sm btn-info p-1 text-white text-decoration-none'><i class='bi bi-eye'></i>  View</a>
                                <a href="/dashboard/urs-edit/{{ Crypt::encrypt($urs_item->id) }}" class='btn-sm btn-success p-1 text-white text-decoration-none'><i class='bi bi-pencil'></i>  Edit</a>

                                <form action="/dashboard/urs-delete/{{ Crypt::encrypt($urs_item->id) }}"  class="d-inline" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class='btn-sm btn-danger p-1' onclick="return confirm('Are You Sure want to Delete')"><i class='bi bi-x-circle-fill'></i> Delete</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center">
            {{ $urs_data->links()}}
            </div>
          @else
          <div class="alert alert-warning alert-dismissible fade show text-center mt-4" role="alert">
            Haven't Entered Notes
        </div>
          @endif
    </div>
</div>
@endsection
