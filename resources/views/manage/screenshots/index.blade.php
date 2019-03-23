@extends('adminlte::page')

@section('htmlheader_title', 'screenshot_image')

@section('main-content')

<div class="card" align="center">
	@section('contentheader_title')

    <div class="card-header">
        <h1>All Screenshots</h1>
        <a href="{{ route('screenshots.create') }}" style="float: right;" class="btn btn-primary btn-sm">New</a>
    </div>

	@endsection

    <div align="center" class="card-body">

		@if(count($screenshots) > 0)

			@foreach ($screenshots as $screenshot)
				<div style="display: inline-flex; position: absolute; z-index: 5000;">
					<a class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
					  Edit Image
					</a>
				</div>

				<div style="position: relative;">
					<img src='{{ url("storage/images/cover_images/$screenshot->cover_image") }}' alt="screenshot image">
				</div>
				<hr>
			@endforeach

		@endif
    	
    </div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('manage.screenshots.edit')
      </div>
    </div>
  </div>
</div>
	
</div>

<script>
	
$(function() {

  $('[data-toggle="modal"]').hover(function() {
    var modalId = $(this).data('target');
    $(modalId).modal('show');

  });

});

</script>

@endsection