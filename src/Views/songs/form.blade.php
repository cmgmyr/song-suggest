<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('artist', 'Artist', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('artist', null, array('class' => 'form-control focus')) }}
			</div>
		</div>

        <div class="form-group">
            {{ Form::label('title', 'Song Title', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            <p>{{ Form::submit('Save!', array('class' => 'btn btn-primary btn-large')) }}</p>
        </div>
	</div>
</div>
{{Form::close()}}