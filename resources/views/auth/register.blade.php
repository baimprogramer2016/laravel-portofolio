<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title_bar }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

  <div class="container">
      <div class="row  justify-content-center">
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="row bg-light rounded-3" id="login-group">

                @if(session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="row text-center">
                    <div class="col mt-3">
                        <h3 class="fw-bold">Register</h3>
                    </div>
                </div>
                <form action="/register" method="post">
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
                            <option value="LEAD">Leader (Ready)</option>
                            <option value="PROGRAMMER">Developer (Not Ready)</option>
                          </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">Register Now</button>
                    <p class="text-center">I Have a Account , <a href="/login"> Login </a></p>
                    <hr>
                  </form>
                  <h5 class="text-center fs-5">Portofolio Laravel - 2022</h5>
            </div>
        </div>
      </div>
  </div>
</body>
</html>
