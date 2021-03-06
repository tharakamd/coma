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
@stop
@section('content')
    <div class="row "></div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <a href="{!! action('PagesController@courses') !!}" class="btn btn-default">Back to course</a>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 ">
            <div class="row">
                <h3><small>Select or add an assignment</small></h3>
            </div>
            <div class="row add_new">
                <a href="{!! action('AssignmentController@add_assignment',array('tharakamd',$course)) !!}" class="btn btn-primary">Add New</a>
            </div>
            <div class="row course_list">
                <div class="list-group">
                    @foreach($assignments as $assignment )
                        <a href="{!! action('PagesController@code',array($assignment->course_id,$assignment->ass_id)) !!}" class="list-group-item"><strong>{{$assignment->ass_id}}</strong> - {{ $assignment->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row"></div>


@stop

