@extends('pages.parent.master');
@section('title')
    Coma - Coueses
@stop
@section('styleSheets')
    .course_list{
        padding-top: 40px;
        margin-left:-30px;
    }
    .add_new{
        padding-top:10px
    }
    .delete_btn{
    top: 7px;
    padding-top: 5px;
    }
@stop
@section('content')
    <div class="row "></div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 ">
            <div class="row">
                <h3><small><strong>Select or add a course</strong></small></h3>
            </div>
            <div class="row add_new">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_course_model">Add New</button>
            </div>
            <div class="row course_list">
                <div class="col-lg-9">
                <div class="list-group">
                    @foreach($courses as $course )
                    <a href="{!! action('AssignmentController@listAssignments',[$course->course_id]) !!}" class="list-group-item"><strong>{{$course->course_id}}</strong> - {{ $course->name }}</a>
                    @endforeach
                </div>
                </div>
                <div class="col-lg-1">
                    @foreach($courses as $course )
                        <div class="row delete_btn">
                            <a href="{!! action('CourseController@removeCourse',[$course->course_id]) !!}"> <span class="glyphicon glyphicon-trash btn btn-danger"></span></a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row"></div>


    <!-- Modal -->
    <div class="modal" id="add_course_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Course</h4>
                </div>
                <div class="modal-body">
                            {!! Form::open(array('action'=>'CourseController@createCourse','id'  => 'create_new_course_form'))!!}
                            <div class="form-group">
                                {!! Form::label('course_id','Course ID') !!}
                                {!! Form::text('course_id','',array('class'=>'form-control')) !!}
                                <span class="help-block" id="id_err">{{ $errors->first('course_id') }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('course_name','Course Name') !!}
                                {!! Form::text('course_name','',array('class'=>'form-control')) !!}
                                <span class="help-block" id="name_err">{{ $errors->first('course_name') }}</span>
                            </div>

                </div>
                <div class="modal-footer">
                        {!! Form::submit('Create Course', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            var err1 = $("#id_err").text(); // the text of the error message one
            var err2 = $("#name_err").text(); // the text of the error message two
            console.log(err1);
            if((err1.localeCompare("")!=0)||(err2.localeCompare("")!=0)){ // if the error one is not empty
                $("#add_course_model").modal("show");
            }
        });
    </script>
@stop