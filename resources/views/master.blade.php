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
    </head>
    <body>
        @if(session()->has('user'))
            @include('includes.sidebar')
        @endif
        <div class="container">
            @yield('content')
        </div>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/bootstrap.js') }}"></script>
    </body>
</html>