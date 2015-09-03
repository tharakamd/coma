@extends('pages.parent.master');
@section('title')
    Coma - Assignments
@stop
@section('styleSheets')
    .course_list{
    padding-top: 40px;
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
                <h3><small><strong>Select or add an assignment</strong></small></h3>
            </div>
            <div class="row add_new">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_assignment_model">Add New</button>
                <a href="{!! action('CourseController@listCourses') !!}" class="btn btn-default">Back to courses</a>
            </div>
            <div class="row course_list">
                <div class="col-lg-9">
                <div class="list-group">

                    @foreach($assignments as $assignment )
                            <a href="{!! action('CodeController@listCodes',array($assignment->course_id,$assignment->assignment_id)) !!}" class="list-group-item">
                                <strong>{{$assignment->assignment_id}}</strong> - {{ $assignment->name }}
                            </a>
                    @endforeach

                </div>
                </div>
                <div class="col-lg-1">
                    @foreach($assignments as $assignment )
                        <div class="row delete_btn">
                            <a href="{!! action('AssignmentController@removeAssignment',array($assignment->course_id,$assignment->assignment_id)) !!}"> <span class="glyphicon glyphicon-trash btn btn-danger"></span></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row"></div>




    <!-- Modal -->
    <div class="modal" id="add_assignment_model" tabindex="-1" role="dialog" aria-labelledby="mymodel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Assignment</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('action'=>array('AssignmentController@createAssignment',$course),9,'files'=>true, 'id'  => 'create_new_assignment_form'))!!}
                    <div class="form-group">
                        {!! Form::label('assignment_id','Assignment ID') !!}
                        {!! Form::text('assignment_id','',array('class'=>'form-control')) !!}
                        <span class="help-block" id="id_err">{{ $errors->first('assignment_id') }}</span>
                    </div>
                    <div class="form-group">
                        {!! Form::label('assignment_name','Assignment Name') !!}
                        {!! Form::text('assignment_name','',array('class'=>'form-control')) !!}
                        <span class="help-block" id="name_err">{{ $errors->first('assignment_name') }}</span>
                    </div>
                    <div class="form-group">
                        {!! Form::label('test_cases','Test files as a zip file') !!}
                        {!! Form::file('test_cases') !!}
                        <span class="help-block" id="case_err">{{ $errors->first('test_cases') }}</span>
                    </div>
                    <div class="form-group">
                        {!! Form::label('test_results','Test results as a coma separate file') !!}
                        {!! Form::file('test_results') !!}
                        <span class="help-block" id="res_err">{{ $errors->first('test_results') }}</span>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Add', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
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
            var err3 = $("#case_err").text(); // the text of the error message three
            var err4 = $("#res_err").text(); // the text of the error message four
            console.log(err1);
            if((err1.localeCompare("")!=0)||(err2.localeCompare("")!=0)||(err3.localeCompare("")!=0)||(err4.localeCompare("")!=0)){ // if the error one is not empty
                $("#add_assignment_model").modal("show");
            }
        });
    </script>
@stop
