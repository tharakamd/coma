@extends('pages.parent.master');
@section('title')
    Coma - Codes
@stop
@section('styleSheets')
    .control{
    padding-top:10px
    }
    .form_row{
        padding-top: 20px
    }
@stop
@section('content')
    <div class="row "></div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="row">
                <h3><small><strong>Select or add a source code</strong></small></h3>
            </div>
            <div class="row control">
            <a href="{!! action('CodeController@compileAll',compact('course','assignment')) !!}" class="btn btn-primary">Compile All</a>
            <a href="{!! action('AssignmentController@listAssignments',$course) !!}" class="btn btn-default">Back to assignment</a>
            </div>
            <div class="row form_row">
                <div class="col-lg-6">
                    {!! Form::open(array('class'=>'form-inline','action'=>array('CodeController@uploadFile',$course,$assignment),'id'=>'upload_form','files'=>true)) !!}
                    <div class="form-group">
                        {!! Form::label('code_path','Select source codes to upload (single file)') !!}
                        {!! Form::file('code_path',array('class'=>'')) !!}

                    </div>
                    <br>
                    <br>
                    {!! Form::submit('Upload',array('class'=>'btn btn-default')) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::open(array('class'=>'form-inline','action'=>array('CodeController@uploadZipFile',$course,$assignment),'id'=>'upload_zip_form','files'=>true)) !!}
                    <div class="form-group">
                        {!! Form::label('file_path','Select source codes to upload (zip file)') !!}
                        {!! Form::file('file_path',array('class'=>'')) !!}

                    </div>
                    <br>
                    <br>
                    {!! Form::submit('Upload',array('class'=>'btn btn-default')) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
        <div class="col-lg-2"></div>

    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <div class="row">
                <h3><small>List of uploaded source codes</small></h3>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <tr class="active">
                        <th>File Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Marks</th>
                        <th>Delete Code</th>
                    </tr>
                    @foreach($codes as $code)
                    <tr class="warning">
                        <td>{{$code->name}}</td>
                        <td>{{$code->type}}</td>
                        <td>{{$code->status}}</td>
                        <td>{{$code->marks}}</td>
                        <td><a href="{!! action('CodeController@removeCode',array($course,$assignment,$code->code_id)) !!}" class="btn btn-ddanger glyphicon glyphicon-trash"></a> </td>
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