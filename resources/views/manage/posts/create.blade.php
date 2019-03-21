@extends('adminlte::page')

@section('htmlheader_title', 'Create New Post')

@section('main-content')
    <h2>Create Your Post</h2>
    <hr>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{ Form::label('post_title', 'Title') }}
        {{ Form::text('post_title', null, ['class' => 'form-control bg-dark' .($errors->has('post_title') ? ' is-invalid' : ''), 'placeholder' => 'Title', 'value' => "old('email')"]) }}

        @if ($errors->has('post_title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('post_title') }}</strong>
            </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        {{ Form::label('post_content', 'Body') }}
        {{ Form::textarea('post_content', null, ['id' => 'article-ckeditor', 'class' => 'form-control bg-dark' .($errors->has('post_content') ? ' is-invalid' : ''), 'placeholder' => 'Type here...']) }}

        @if ($errors->has('post_content'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('post_content') }}</strong>
            </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>
    <hr>
        {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection