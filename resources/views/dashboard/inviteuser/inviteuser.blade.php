
@extends('dashboard.layouts.main')
@section('content')


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class='bi bi-person-plus'></i> Invite User</h1>
</div>
<div class="container ">
    <div class="row">
        @if (@session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('failed') }}
        </div>
        @elseif (@session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="col-md-4" id="tab" >
            <form action="/dashboard/invite-user" method="post">
                @csrf
                <div class="mb-3">
                <label for="search" class="form-label">Select user</label>
                <input class="typeahead form-control @error('search') is-invalid @enderror" id="search" name='search'autocomplete='off'  type="text">

                <div id="search" class="form-text">Input people who will follow this project </div>
                </div>
                <button type="submit" name='submituser' class="btn btn-primary">Invite</button>
          </form>
        </div>
        <div class="col-md">
            @if ( $job_users->count() > 0 )
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"<i class='bi bi-person'></i>  Name</th>
                    <th scope="col"><i class='bi bi-envelope'></i> Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($job_users as $user_item)

                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $user_item->user->name }}</td>
                            <td>{{ $user_item->user->email }}</td>
                            <td>{{ $user_item->user->role }}</td>
                            <td>
                                <form action="/job-user-delete/{{ Crypt::encrypt($user_item->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class='btn-xs btn-danger p-1' onclick="return confirm('Are You Sure want to Delete')"><i class='bi bi-arrow-right'></i> Kick User</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              @else
              <div class="alert alert-warning alert-dismissible fade show text-center mt-4" role="alert">
                {{ $user_not_ready }}
            </div>
              @endif
        </div>
    </div>
</div>
    <script type="text/javascript">
        var path = "{{ route('userautocomplete') }}";

        $('#search').typeahead({
                source: function (query, process) {
                    return $.get(path, {
                        query: query
                    }, function (data) {
                        return process(data);
                    });
                }
            });

    </script>
@endsection
