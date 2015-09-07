@extends('pages.parent.master');
@section('aditions')
    <link rel="stylesheet" href="{{URL::asset("css/one-page-wonder.css")}}">
@stop
@section('title')
    Coma - Home
@stop
@section('content')
<div class="row"></div>
<div class="row">
    <!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">

            </div>
        </div>
    </header>
    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive pull-right img-border" src="{{URL::asset("images/banner1.jpg")}}">
            <h2 class="featurette-heading">Coma
                <span class="text-muted">will mark your codes</span>
            </h2>
            <p class="lead">Now you can compile execute and evaluate thousands of codes efficiently with only single click.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <img class="featurette-image img-circle img-responsive pull-left img-border" src="{{URL::asset("images/banner2.jpg")}}">
            <h2 class="featurette-heading">Coma
                <span class="text-muted">will manage your codes</span>
            </h2>
            <p class="lead">Now you can create Courses and Assignments and upload your codes.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right img-border" src="{{URL::asset("images/banner3.jpg")}}">
            <h2 class="featurette-heading">Coma
                <span class="text-muted">will generate result sheets</span>
            </h2>
            <p class="lead">Now you can download results as Excell, PDF and CSV files</p>
        </div>

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Coma 2015</p>
                </div>
            </div>
        </footer>

    </div>

</div>
@stop