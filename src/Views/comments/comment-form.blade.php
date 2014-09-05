{{Form::open(['route' => ['comments.store', $song->id], 'class' => 'comment-form'])}}
<div class="form-group">
    {{ Form::label('comment', 'Leave a comment', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::textarea('comment', null, array('class' => 'form-control')) }}
    </div>
</div>
<p>{{ Form::submit('Post Comment', array('class' => 'btn btn-primary')) }}</p>
{{Form::close()}}