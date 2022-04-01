<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="d-flex flex-column h-100 antialiased">
        <header>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Unsecure App</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link {{ request()->RouteIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Acceuil</a>
                  </li>
                  @if(\Auth::user())
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                      Logout
                    </a>
                  </li>
                  @endif
                  @if(!\Auth::user())
                  <li class="nav-item">
                    <a class="nav-link {{ request()->RouteIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Se connecter</a>
                  </li>
                  @endif
                </ul>
                <form class="d-flex" method="POST" action="{{ route('article.search') }}">
                @csrf
                  <input class="form-control me-2" type="search" name="search" placeholder="Chercher un article" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Chercher</button>
                </form>
              </div>
            </div>
          </nav>
        </header>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
          <div class="container">
            @yield('content')
          </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>
