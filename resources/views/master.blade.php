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
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        
        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/old-css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-glyphicons.css') }}">
        <script src="https://kit.fontawesome.com/649e71a687.js" crossorigin="anonymous"></script>
    </head>
    <body>
        @if(session()->has('user'))
            @include('includes.sidebar')
        @endif
        @yield('content')
        @include('includes.custom_field')
    </body>
    <script>
        $(".add_custom_field").click(function(){
            $("#field_table").val($(this).data("table"));
        });
    </script>
</html>