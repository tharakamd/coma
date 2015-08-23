@extends('pages.parent.basics');
@section('title')
    Come - Login
@stop
@section('styles')
    <style>
        body{
            background-image: url("{{URL::asset("images/login.jpg")}}");
        }
    </style>
@stop
@section('content')
    <div class="row"></div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <p><strong>Login to your Coma account</strong></p>
                    <br>
                </div>
            {!! Form::open(array('action'=>'Auth\AuthController@getLogin','class'=>'form-horizontal')) !!}
            <div class="form-group">
                {!! Form::label('email','Email') !!}
                {!! Form::email('email','',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('password','Password') !!}
                {!!  Form::password('password',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('remember') !!}
                    Remember Me
                </label>
            </div>
            </div>
            <div class="form-group">
            {!! Form::submit('Login',array('class'=>'btn btn-primary')) !!}
            </div>
            {!! Form::close() !!}
            <div class="row">
                <p>Don't have an account yet ? <a href="{!! action('Auth\AuthController@postRegister') !!}">Register</a> now in Coma</p>
            </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">

    </div>
@stop
