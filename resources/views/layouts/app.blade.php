<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'A.S.A.') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('logo.png')}}" style="width: 100px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(Gate::check('isManager') || Gate::check('isAdmin'))
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item btn btn-light"><a class="nav-link" href="{{url('/athletes')}}">{{__('athletes.Athletes')}}</a></li>
                            <li class="nav-item btn btn-light"><a class="nav-link" href="{{url('/parents')}}">{{__('parents.Parents')}}</a></li>
                            <li class="nav-item btn btn-light"><a class="nav-link" href="{{url('/payments')}}">{{__('payments.Payments')}}</a></li>
                            <li class="nav-item btn btn-light"><a class="nav-link" href="{{url('/groups')}}">{{__('groups.Groups')}}</a></li>
                            <li class="nav-item btn btn-light"><a class="nav-link" href="{{url('/settings')}}">{{__('Settings')}}</a></li>
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark">{{ Auth::user()->name }} | {{ __('Logout') }}</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(Gate::check('isManager') || Gate::check('isAdmin'))
            <main class="py-4">
                @yield('content')
            </main>

            <footer class="mt-auto">
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                @yield('footer')
                <small>&copy; 2020 Pier Luigi Papeschi - V. 0.1 - <a href="https://pierluigipapeschi.com">www.pierluigipapeschi.com</a></small>
            </footer>
        @endif
    </div>
</body>
</html>
