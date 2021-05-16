<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>HRIS | @yield('title')</title>
        @if(session()->has('user'))
            <link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">      
        @else
            <link rel="stylesheet" href="{{ asset('/css/login.css') }}">     
        @endif
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/jquery-3.5.1.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/css/buttons.bootsrap5.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/jszip.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/pdfmake.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/vfs_fonts.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.html5.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.print.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.colVis.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/sidebar.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/select2.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script type="text/javascript" charset="utf8" src="{{ asset('/js/app.js') }}"></script>
        
        
        
        
        
        
        <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/buttons.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
        <script src="https://kit.fontawesome.com/649e71a687.js" crossorigin="anonymous"></script>
    </head>
    <body>
        @if(session()->has('user'))
            @include('includes.sidebar')
        @endif
        @yield('content')
        @include('includes.custom_field')
        @include('modals.delete_modals')
    </body>
    <script>
    $(".add_custom_field").click(function(){
        $("#field_table").val($(this).data("table"));
    });
    </script>
</html>