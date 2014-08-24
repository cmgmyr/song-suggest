<div class="row">
	<div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', 'Title', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('title', null, array('class' => 'form-control focus')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::textarea('body', null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('published_at', 'Publish Date', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('published_at', null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('user_id', 'User', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('user_id', $userList, $currentUser, array('class' => 'form-control')) }}
            </div>
        </div>
	</div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('categories', 'Categories', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::checkboxList('categories', $categories, $post->categories, 'name') }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('tags', 'Tags', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('tags', null, array('class' => 'form-control', 'data-role' => 'tagsinput', 'id' => 'blogtags')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('enable_comments', 'Enable Comments?', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('enable_comments', array('y' => 'yes', 'n' => 'no'), null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('status', 'Status', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('status', array('published' => 'Published', 'draft' => 'Draft'), null, array('class' => 'form-control')) }}
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