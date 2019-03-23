
    <h2>Edit screenshot</h2>
    <hr>
    {!! Form::open(['action' => ['ScreenshotController@update', $screenshot->id], 'method' => 'screenshot', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>
    <hr>
        {{ Form::hidden('_method', 'PUT') }}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{ Form::submit('Update screenshot', ['class' => 'btn btn-primary']) }}
      </div>
    {!! Form::close() !!}