
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    @vite('resources/js/signin.js')
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
<main class="form-signin">
     @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                 @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                 @endforeach
            </ul>
        </div>
    @endif
  <form action="{{route('register.store')}}" method="POST">
  @csrf
    <img class="mb-4" src="{{asset('images/bootstrap-logo.svg')}}" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Имя">
      <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password_confirmation" class="form-control" id="floatingConfirmPassword" placeholder="Password Confirm">
      <label for="floatingPassword">Confirm Password</label>
    </div>
    <div class="checkbox mb-3">

    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегестрироваться</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2023</p>
  </form>
</main>



  </body>
</html>
