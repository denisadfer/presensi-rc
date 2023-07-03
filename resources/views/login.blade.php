<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rose Catering | {{ $title }}</title>
  <link rel="icon" href="https://cdn.discordapp.com/attachments/865222321475158016/1093039011116879904/RC_white2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <style>
    * {
      box-sizing: border-box;
    }
    .jumbotron {
      display: block;
      width: 100%;
      height: 365px;
    }

    .jumbotron::before {
      content: '';
      display: block;
      background-image: url(https://cdn.discordapp.com/attachments/865222321475158016/1083250344412323931/bg.png);
      width: 100%;
      height: 100%;
      filter: blur(2px);
      position: absolute;
      bottom: 0;
      left: 0;
    }

    .jumbotron::after {
      content: '';
      display: block;
      width: 100%;
      height: 100%;
      background-image: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0.7),
        rgba(0, 0, 0, 0)
      );
      position: absolute;
      bottom: 0;
      left: 0
    }
    .container {
      z-index: 1;
      position: relative;
    }
  </style>
</head>

<body class="h-100 d-flex flex-column">
  <section class="jumbotron">
    <div class="container mt-5 pt-4">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card p-5 shadow">
            <div class="d-flex justify-content-center mb-3" style="margin-top: -20px;">
              <img src="https://cdn.discordapp.com/attachments/865222321475158016/1095530652553707651/logo_rose_new.png" width="50%">
            </div>
            <h5 class="w-bold text-center mb-4">Login</h5>
            <form action="/" method="post">
              @csrf
              @if(session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required>
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password" required>
                <label for="floatingPassword">Password</label>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" name="login"
                style="font-size: 17px;">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>