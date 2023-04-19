
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Album example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <script src="https://kit.fontawesome.com/76a91fea5d.js" crossorigin="anonymous"></script>


    <!-- Bootstrap core CSS -->

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

@vite('resources/js/app.js')
  </head>
  <body>

<header>
        @if(session()->has('success'))
             <div class="alert alert-success success-notification">
                  {{session('success')}}
             </div>
        @endif
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">Warcraft Blog</h4>
          <p class="text-muted">На этом сайте вы можете просматривать, создавать, редактировать свои статьи.
          Существует возможность оценивания, комментирования и модерации всего, что было перечислено выше.
          Все герои и героини Азерота приглашаются к активному обсуждению игрового мира, а также его активного дополнения информации о нём,
          чувствуйте себя здесь как дома</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
            <h4><a class="text-white" href="{{route('home')}}">Главная</a></h4>
          <ul class="list-unstyled">
          @guest
            <li><a href="{{route('login.create')}}" class="text-white">Login</a></li>
            <li><a href="{{route('register.create')}}" class="text-white">Register</a></li>
          @endguest
            @auth
            <li><a href="#" class="text-white">{{Auth::user()->name}}</a></li>
            @admin
            <li><a href="#" class="text-white">Вы администратор!</a></li>
            @endadmin
            <li><a href="{{route('logout')}}" class="text-white">Logout</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>WarcraftBlog</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

 @yield('content')
</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Данный сайт был написан на примерах предоставленные мне Bootstrap</p>
    <p class="mb-0">Мой <a href="https://github.com/TheRetroHome">gitHub</a> или репозиторий <a href="https://github.com/TheRetroHome/warcraftBlog">warcraftBlog</a>.</p>
  </div>
</footer>
  </body>
</html>
