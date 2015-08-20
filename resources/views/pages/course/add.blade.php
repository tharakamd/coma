@extends('pages.parent.master');
@section('title')
    Coma - Add Course
@stop
@section('styleSheets')
    .course_list{
    padding-top: 40px;
    }
    .first_row{
    padding-top:20px
    }
@stop
@section('content')
    <div class="row first_row">
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            {!! Form::open(array('action'=>'CourseController@createCourse','id'  => 'create_new_course_form'))!!}
            <div class="form-group">
                {!! Form::label('course_id','Course ID') !!}
                {!! Form::text('course_id','',array('class'=>'form-control')) !!}
                <span class="help-block">{{ $errors->first('course_id') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('course_name','Course Name') !!}
                {!! Form::text('course_name','',array('class'=>'form-control')) !!}
                <span class="help-block">{{ $errors->first('course_name') }}</span>
            </div>
            <div class="form-group">
                {!! Form::submit('Create Course', array('class'=>'btn btn-primary')) !!}
                <a href="{!! action('CourseController@listCourses') !!}" class="btn btn-default">Back to courses</a>
            </div>
            {!! Form::close() !!}


        </div>
        <div class="col-lg-2"></div>
    </div>
@stop
