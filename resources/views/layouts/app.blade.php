<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{--
        Quando adiciona o bootstrap tem que comentar essa linha
        <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script>
    var SITE_URL = "{{URL::to('/')}}";
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        @can('viewAny', App\Models\Post::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.list') }}">{{ __('Posts') }}</a>
                        </li>
                        @endcan

                        @can('admin-access')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.list') }}">{{ __('Categories') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.list') }}">{{ __('Users') }}</a>
                        </li>
                        @endcan



                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @if (session('success'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @yield('content')


            @include('layouts.modal-deletar')

        </main>
    </div>
</body>
</html>
