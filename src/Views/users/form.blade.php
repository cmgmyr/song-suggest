<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('first_name', 'First Name', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('first_name', null, array('class' => 'form-control focus')) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('last_name', 'Last Name', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('last_name', null, array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('email', 'Email', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::text('email', null, array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
			<div class="controls">
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
		</div>

        <div class="form-group">
            {{ Form::label('password_confirm', 'Password (Confirm)', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::password('password_confirm', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            <label>Is Active</label>
            <div class="controls">
                <label>{{Form::radio('is_active', 'y')}} Yes</label>
                <label>{{Form::radio('is_active', 'n')}} No</label>
            </div>
        </div>

        <div class="form-group">
            <label>Is Admin</label>
            <div class="controls">
                <label>{{Form::radio('is_admin', 'y')}} Yes</label>
                <label>{{Form::radio('is_admin', 'n')}} No</label>
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