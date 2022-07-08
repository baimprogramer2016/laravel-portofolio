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
    <div class="container text-center pt-5">
        <a class="nav-link text-secondary fw-bold" aria-current="page" href="/home">
            <span data-feather="home"></span>
            <i class="bi bi-arrow-left"></i> Back
          </a>
        <h1>Create Job</h1><br>
        <div class="row justify-content-center">
            <div class="col-6">
            <form action="/create-job" method="post">
                @csrf
                    <div class="col justify-content-center flex-no-wrap">
                        <div class="row-md-4 mt-3 text-end">
                            <input type="text" class="form-control text-center @error('name') is-invalid @enderror" name='name' id='name' placeholder="Project Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row-md-4 mt-3 text-end">
                            <input type="text" class="form-control text-center @error('alias') is-invalid @enderror" name='alias' id='alias' placeholder="Alias Name">
                            @error('alias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row-md  mt-3 text-start text-center">
                            <button class='btn btn-primary '>Create</button>
                        </div>
                    </div>
            </form>
            </div>
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
