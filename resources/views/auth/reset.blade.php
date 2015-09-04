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
    <div class="row">

    </div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 panel panel-default">
            <div class="panel-body">
            <form method="POST" action="/password/reset" class="form-horizontal">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                    <a href="{!! action('Auth\AuthController@postLogin') !!}" class="btn btn-default">Back to login</a>
                </div>

                <div>

                </div>
            </form>
            </div>
        </div>
    </div>
@stop

