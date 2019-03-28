@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')

    <div class = "container">
    <h2>Edit Post</h2>
    <hr>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class = "dropdown row">
              <select name="drop" class="mdb-select md-form colorful-select dropdown-primary">
               @foreach ($posts as $post1)
                @if ($post->id != $post1->id)
                  <option value="">-</option>
                  <option value="{{ $post1->id }}">{{ $post1->post_title }}</option>
                @endif
               @endforeach
              </select>
      </div>
   <hr>
    <div class="form-group">
        {{ Form::label('post_title', 'Title') }}
        {{ Form::text('post_title', $post->post_title, ['class' => 'form-control bg-dark text-color' .($errors->has('post_title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}

        @if ($errors->has('post_title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('post_title') }}</strong>
            </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        {{ Form::label('post_content', 'Body') }}
        {{ Form::textarea('post_content', $post->post_content, ['id' => 'article-ckeditor', 'class' => 'form-control bg-dark text-color' .($errors->has('post_content') ? ' is-invalid' : ''), 'placeholder' => 'Type here...']) }}

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
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Update Post', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
      
   </div>

@endsection