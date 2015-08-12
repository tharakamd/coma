@extends('pages.parent.master');
@section('title')
    Coma - Add Assignment
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
            {!! Form::open(array('action'=>array('AssignmentController@create_assignment','tharakamd',$course),'class'=>'form-horizontal','files'=>true, 'id'  => 'create_new_assignment_form'))!!}
            <div class="form-group">
                {!! Form::label('assignment_id','Assignment ID') !!}
                {!! Form::text('assignment_id','',array('class'=>'form-control')) !!}
                <span class="help-block">{{ $errors->first('assignment_id') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('assignment_name','Assignment Name') !!}
                {!! Form::text('assignment_name','',array('class'=>'form-control')) !!}
                <span class="help-block">{{ $errors->first('assignment_name') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('test_cases','Test files as a zip file') !!}
                {!! Form::file('test_cases') !!}
                <span class="help-block">{{ $errors->first('test_cases') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('test_results','Test results as a coma separate file') !!}
                {!! Form::file('test_results') !!}
                <span class="help-block">{{ $errors->first('test_results') }}</span>
                <br>
                {!! Form::submit('Add', array('class'=>'btn btn-primary')) !!}
                <a href="{!! action('PagesController@assignment',$course) !!}" class="btn btn-default">Back to assignments</a>
            </div>
            {!! Form::close() !!}


        </div>
        <div class="col-lg-2"></div>
    </div>
@stop
