<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- Bootsrapt Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/dashboard-style.css">
</head>
<body>
    <div class="container text-center pt-5" style="padding-bottom: 30%">
        <a class="nav-link text-secondary fw-bold" aria-current="page" href="/home">
            <span data-feather="home"></span>
            <i class="bi bi-arrow-left"></i> Back
          </a>
        <h1>Open Jobs</h1><br>
        <div class="row justify-content-center">

            @if ($jobs->count() > 0 )
                @foreach ($jobs as $jobitem)
                <div class="card m-2" style="width: 18rem; \">
                    <div class="card-body">
                      <h5 class="card-title">{{ $jobitem->alias }} </h5>
                      <p class="card-text">{{ $jobitem->name }}<br><span class='text-success'>Status {{ $jobitem->status }}</span></p>
                      <a href="/go-to-invite-user/{{ Crypt::encrypt($jobitem->id) }}" class="btn btn-primary">Go</a>
                    </div>
                  </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $jobs->links()}}
                    </div>
            @else
            <div class="alert alert-warning alert-dismissible fade show text-center mt-4" role="alert">
                {{ $user_not_ready }}
            </div>
            @endif
        </div>
    </div>

    <div class='text-porto fixed-bottom '>
            <div class='foo1'>
            PortoFolio Laravel<br>
            Developer - Anhari
            </div>

        <div class='foo2'>
            PortoFolio Laravel<br>
            Developer - Anhari
            </div>
    </div>


</body>
</html>
