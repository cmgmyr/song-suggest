<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('name', null, array('class' => 'form-control focus')) }}
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-6 text-right">
		<p>{{ Form::submit('Save!', array('class' => 'btn btn-primary btn-large')) }}</p>
	</div>
</div>
{{Form::close()}}