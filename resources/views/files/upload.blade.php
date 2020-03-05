@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">File Manipulation</div>

            <div class="card-body">


                {!!Form::open(array('url' => URL::to('/file-manipulation' ),'files' => true, 'method' => 'PUT'))!!}
                <div class="btn btn-secondary btn-file">
                    Browse&hellip;
                    {{Form::file('file',['class' => 'form-control' ,'accept' => '.TXT '])}}
                </div>
                <input name="type" type="hidden" id="formType">
                <button type="button" class="btn btn-primary" id="submitFile" > Submit</button>
                {{ Form::close() }}

            </div>
        </div>
        <div class="card-footer">
            <div class="btn-toolbar"> <a href="{{URL::previous()}}">
                    <button type="button" class="btn btn-danger">Back</button>
                </a>

            </div>
        </div>


@endsection
