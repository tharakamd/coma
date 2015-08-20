@extends('pages.parent.master');
@section('title')
    Coma - Uploads
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
            @if($status == 'done')
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Done Uploading</h3>
                    </div>
                    <div class="panel-body">
                        Done Uploading
                    </div>
                </div>
            @else
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Error Uploading</h3>
                    </div>
                    <div class="panel-body">
                        Error Uploading
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <a href="{!! action('CodeController@listCodes', array($course,$assignment)) !!}" class="btn btn-default">Back to assignment</a>
        </div>
        <div class="col-lg-4"></div>
    </div>

@stop

@section('scripts')

@stop