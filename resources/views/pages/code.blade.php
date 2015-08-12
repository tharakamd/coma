@extends('pages.parent.master');
@section('title')
    Coma - Codes
@stop
@section('styleSheets')
    .form_row{
    padding-top: 40px;
    }
@stop
@section('content')
    <div class="row "></div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <a href="{!! action('PagesController@assignment',$course) !!}" class="btn btn-default">Back to assignment</a>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row form_row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            {!! Form::open(array('class'=>'','action'=>array('PagesController@upload_file','tharakamd',$course,$assignment),'id'=>'upload_form','files'=>true)) !!}
            <div class="form-group">
                {!! Form::label('code_path','Select source codes to upload') !!}
                {!! Form::file('code_path') !!}

            </div>
            {!! Form::submit('Upload',array('class'=>'btn btn-primary btn-xs')) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <?php  $user = 'tharakamd'; ?>
            <a href="{!! action('PagesController@compile',compact('user','course','assignment')) !!}" class="btn btn-primary">Compile All</a>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="row">
                <h3><small>List of uploaded source codes</small></h3>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <tr>
                        <th>File Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Marks</th>
                    </tr>
                    @foreach($codes as $code)
                    <tr>
                        <td>{{$code->name}}</td>
                        <td>{{$code->type}}</td>
                        <td>{{$code->status}}</td>
                        <td>{{$code->marks}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row"> </div>


@stop

@section('scripts')
    {{--ajax form handling section--}}
@stop