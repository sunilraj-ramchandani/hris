<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>HRIS | @yield('title')</title>
        @if(session()->has('user'))
            <link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">      
        @else
            <link rel="stylesheet" href="{{ asset('/css/login.css') }}">     
        @endif
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/bootstrap.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/649e71a687.js" crossorigin="anonymous"></script>
    </head>
    <body>
        @if(session()->has('user'))
            @include('includes.sidebar')
        @endif
        @yield('content')
    </body>
</html>