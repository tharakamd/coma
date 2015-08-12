<!DOCTYPE html>
<html>
<head>
    {{--Bootasrap importing--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    {{--Importing js--}}
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <style>
        body{
            padding-top: 40px;
        }

        @yield('styleSheets')
    </style>
    <title>@yield('title')</title>
</head>
<body>
@include('pages.parent.components.header')
@yield('content')

@yield('scripts')
</body>
</html>
