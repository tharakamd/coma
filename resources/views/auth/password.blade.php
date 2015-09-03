@extends('pages.parent.basics');
@section('title')
    Come - Reset password
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
                    <p><strong>Reset to your Coma password</strong></p>
                    <br>
                </div>
                {!! Form::open(array('action'=>'Auth\PasswordController@postEmail','class'=>'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::label('email','Email') !!}
                    {!! Form::email('email','',array('class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Send password reset link',array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">

    </div>
@stop
