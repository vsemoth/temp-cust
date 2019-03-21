@extends('adminlte::page')

@section('htmlheader_title', 'Posts Index')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>All Posts 
                            <a href="{{ route('posts.create') }}" style="float: right;" class="btn btn-primary btn-sm">New</a>
                    </h1>
                </div>

                <div class="card-body">
                    <table class="table table-gridlines">
                        @foreach($posts as $post)
                         @if(count($post) > 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <a href="{{ route('blog.single',$post->slug) }}">
                                            {{ $post->post_title }}
                                        </a>
                                    </th>
                                    <th>Action:</th>
                                    <th></th>
                                    <th>NAV Map:</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->post_content }}</td>
                                    <td>
                                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) !!}
                                            {{ Form::submit('DELETE', ['class' => 'btn btn-danger btn-sm']) }}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                    <td style="float: left;">
                                        @foreach (App\Post::all() as $post2) 
                                            @if (!count($post2->drop) > 0)
                                                @if ($post2->id != $post->id)
                                                    @if ($post2->id == $post->drop)
                                                        {{ $post2->post_title }} ->
                                                    @endif 
                                                @endif
                                            @elseif(!count($post2->drop) > 0)
                                                {{ $post->post_title }} ->
                                            @endif
                                        @endforeach
                                        @if (count($post2->drop) > 0)
                                            {{$post->post_title}}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                         @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
