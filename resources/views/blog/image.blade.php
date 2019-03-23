@extends('adminlte::welcome')

@section('htmlheader_title', $screenshot['screenshot_title'])

@section('main-content')
	<div class="row">
		<div class="container">
			<img src="storage/images/cover_images/{{ $screenshot['cover_image'] }}" alt="{{ $screenshot['screenshot_title'] }} image">
			<div class="card border-0">
				<div class="card card-header border-0">
					<h1>{{ $screenshot["screenshot_title"] }}</h1>					
				</div>
				<div class="card card-body border-0">
					<p>{{ $screenshot["screenshot_content"] }}</p>					
				</div>
			</div>
			
		</div>
	</div>
@endsection