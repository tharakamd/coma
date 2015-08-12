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
    <div class="row "></div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 ">
            <div class="row">
                <h3><small>Compilation Results</small></h3>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <table class="table table-hover">
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                </tr>
                @foreach($codes as $code)
                    <tr>
                        <td>{{$code->name}}</td>
                        <td>{{$code->status}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@section('scripts')

@stop