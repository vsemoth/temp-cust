@extends('adminlte::page')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Post</div>

                <div class="card-body">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ $post->title }}</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $post->post_content }}</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
