@extends('adminlte::layouts.app')

@section('htmlheader_title', $post['post_title'])

@section('main-content')
	<div class="row">
		<div class="container">
			<img src="storage/images/cover_images/{{ $post['cover_image'] }}" alt="{{ $post['post_title'] }} image">
			<div class="card border-0">
				<div class="card card-header border-0">
					<h1>{{ $post["post_title"] }}</h1>					
				</div>
				<div class="card card-body border-0">
					<h1>{{ $post["post_content"] }}</h1>					
				</div>
			</div>
			
		</div>
	</div>
@endsection