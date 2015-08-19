@extends('pages.parent.basics');
@section('title')
    Come - Register
@stop
@section('content')
    <div class="row"></div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            {!! Form::open(array('action'=>'Auth\AuthController@getRegister','class'=>'form-horizontal')) !!}
            <div class="form-group">
                {!! Form::label('name','Name') !!}
                {!! Form::text('name','Your name',array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','Email') !!}
                {!! Form::email('email','example@email.com',array('class'=>'form-control')) !!}
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
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row"></div>
@stop
