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
    <style>
        body{
            margin: 0;
            padding: 0;
            background: url(/img/bg_wave.svg) no-repeat bottom;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
                    @if (@session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('success') }}
                        </div>
                        @elseif (@session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ session('failed') }}
                        </div>
                        @endif
                    <a class="nav-link text-secondary fw-bold" aria-current="page" href="/home">
                        <span data-feather="home"></span>
                        <i class="bi bi-arrow-left"></i> Back
                      </a>
                    <div class="row bg-light rounded-3" id="login-group">


                        <div class="row text-center">
                            <div class="col mt-3">
                                <h3 class="fw-bold">Register</h3>
                            </div>
                        </div>
                        <form action="/register-user" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fs-10">Name</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" name="name" placeholder="Input Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fs-10">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" name="email" placeholder="Input Email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fs-10">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"" id="password" name="password"  placeholder="Input Password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label fs-10">Access Role</label>
                                <select class="form-select" name="role" id="role" aria-label="Select Access">
                                    <option value="LEAD">Leader</option>
                                    <option value="PROGRAMMER">Developer</option>
                                  </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3 mb-1">Register Now</button>
                            <a class="btn btn-warning w-100 mb-3 text-white">List User</a>

                    </div>
                </div>

        </div>


    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>


