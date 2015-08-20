@extends('pages.parent.master');
@section('title')
    Coma - Course Creation
@stop
@section('styleSheets')
    .form_row{
    padding-top: 40px;
    }

@stop
@section('content')
    <div class="row"></div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            @if($status)
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Course created successfully</h3>
                    </div>
                    <div class="panel-body">
                        Done Creating
                    </div>
                </div>
            @else
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Error in creating the assignment</h3>
                    </div>
                    <div class="panel-body">
                        Error Creating
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <a href="{!! action('CourseController@listCourses') !!}" class="btn btn-default">Back to courses</a>
        </div>
        <div class="col-lg-4"></div>
    </div>

@stop

@section('scripts')

@stop