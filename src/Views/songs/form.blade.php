<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('artist', 'Artist', ['class' => 'control-label']) }}
			<div class="controls">
				{{ Form::text('artist', null, ['class' => 'form-control focus']) }}
			</div>
		</div>

        <div class="form-group">
            {{ Form::label('title', 'Song Title', ['class' => 'control-label']) }}
            <div class="controls">
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('youtube', 'YouTube Link', ['class' => 'control-label']) }}
            <div class="controls">
                {{ Form::text('youtube', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            <p>{{ Form::submit('Save!', ['class' => 'btn btn-primary btn-large']) }}</p>
        </div>
	</div>
</div>
{{Form::close()}}