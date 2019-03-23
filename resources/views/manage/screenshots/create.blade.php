@extends('adminlte::page')

@section('htmlheader_title', 'Create New Post')

@section('main-content')
    <h2>Upload Your Screenshot</h2>
    <hr>
    {!! Form::open(['action' => 'ScreenshotController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>
    <hr>
        {{ Form::submit('Upload Screenshot', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection