@extends('pages.parent.basics');
@section('title')
    Come - Register
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
                        <p><strong>Create a new Coma account</strong></p>
                        <br>
                    </div>
            {!! Form::open(array('action'=>'Auth\AuthController@getRegister','class'=>'form-horizontal')) !!}
            <div class="form-group">
                {!! Form::label('name','Name') !!}
                {!! Form::text('name','',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','Email') !!}
                {!! Form::email('email','',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('password','Password') !!}
                {!!  Form::password('password',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('password_confirmation','Confirm Password') !!}
                {!!  Form::password('password_confirmation',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Register',array('class'=>'btn btn-primary')) !!}
                <a href="{!! action('Auth\AuthController@getLogin') !!}" class="btn btn-default">Back to login</a>
            </div>
            {!! Form::close() !!}
                </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row"></div>
@stop
