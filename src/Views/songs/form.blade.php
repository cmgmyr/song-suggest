<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('artist', 'Artist', ['class' => 'control-label']) }}
			{{ Form::text('artist', null, ['class' => 'form-control focus', 'autocomplete' => 'off']) }}
		</div>

        <div class="form-group">
            {{ Form::label('title', 'Song Title', ['class' => 'control-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('youtube', 'YouTube Link', ['class' => 'control-label']) }}
            {{ Form::text('youtube', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('mp3_file', 'MP3 File', ['class' => 'control-label']) }}
            {{ Form::file('mp3_file', ['class' => 'form-control', 'accept' => '.mp3']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Save!', ['class' => 'btn btn-primary btn-large']) }}
        </div>
	</div>
</div>
{{Form::close()}}