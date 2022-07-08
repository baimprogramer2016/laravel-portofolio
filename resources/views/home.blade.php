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
    <div class="container">
        @if ( session('noaccess') !="" )
        <div class="alert alert-danger alert-dismissible fade show text-center mt-1" role="alert">
            {{ session('noaccess') }}
        </div>
        @endif
            <section class="jumbotron text-center mt-4">
                <img src="img/account.jpg" alt="Account" width=100 class="rounded-circle img-thumbnail"><br>
                <a href="" class='fw-bold text-decoration-none text-secondary ms-1 me-1'><i class="bi bi-magic"></i> Edit Account</a>
                <h1>{{ auth()->user()->name }}</h1>
                <p class="lead">{{ auth()->user()->email .' - '.auth()->user()->role}}</p>
                <div class="menu-list d-flex col justify-content-center">
                    <a href="/create-job" class='fw-bold text-decoration-none  me-2'><i class="bi bi-pencil"></i> Create</a> |
                    <a href="/open-job" class='fw-bold text-decoration-none  ms-1 me-1'><i class="bi bi-folder2"></i> Open</a> |
                    <a href="/register-user" class='fw-bold text-decoration-none ms-1 me-1'><i class="bi bi-person-circle"></i> Users</a> |
                    <form action="/logout" method='post' class='ms-2'>
                        @csrf
                        <button class='fw-bold text-decoration-none'><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </div>
            </section>
    </div>

    <div class='text-porto fixed-bottom'>
            <div class='foo1'>
            PortoFolio Laravel<br>
            Developer - Anhari
            </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#11538D" fill-opacity="1" d="M0,128L80,112C160,96,320,64,480,96C640,128,800,224,960,250.7C1120,277,1280,235,1360,213.3L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
        <div class='foo2'>
            PortoFolio Laravel<br>
            Developer - Anhari
            </div>
    </div>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
