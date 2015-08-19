@extends('pages.parent.basics');
@section('title')
    Come - Login
@stop
@section('content')
    <div class="row"></div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
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
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row"></div>
@stop
