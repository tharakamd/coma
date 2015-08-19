@extends('pages.parent.master');
@section('title')
    Coma - Projects
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
        <div class="col-lg-8 ">
            <div class="row">
                <h3><small>Select or add a course</small></h3>
            </div>
            <div class="row add_new">
                <a class="btn btn-primary " href="#">Add New</a>
            </div>
            <div class="row course_list">
                <div class="list-group">
                    @foreach($courses as $course )
                    <a href="{!! action('PagesController@assignment',[$course->course_id]) !!}" class="list-group-item"><strong>{{$course->course_id}}</strong> - {{ $course->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row"></div>
@stop