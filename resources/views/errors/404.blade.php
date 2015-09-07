<!DOCTYPE html>
<html>
<head>
    {{--Bootasrap importing--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="shortcut icon" href="{!! storage_path().'\images\icon.ico' !!}">
    {{--Importing js--}}
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <style>
        body{
            padding-top: 40px;
            background-image: url("{{URL::asset("images/back.jpg")}}")
        }

        .err_row{
            padding-top: 80px;
        }
        @yield('styleSheets')
        h1 { color: #456984; font-family: 'Raleway',sans-serif; font-size: 62px; font-weight: 800; line-height: 72px; margin: 0 0 24px; text-align: center; text-transform: uppercase; }
    </style>
    <title>Coma - Page not found</title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! action('PagesController@home') !!}">Coma</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{!! action('PagesController@contact') !!}">About</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="row">

</div>
<div class="row err_row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-danger">
            <div class="panel-body">
                <br>
                <br>
                <br>
                <h1>404</h1>
                <br>
                <br>
                <h1>Sorry The page not found</h1>
                <br>
                <br>

            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
</body>
</html>
