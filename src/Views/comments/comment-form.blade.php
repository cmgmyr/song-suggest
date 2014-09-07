{{Form::open(['route' => ['comments.store', $song->id], 'class' => 'comment-form'])}}
<div class="form-group">
    {{ Form::label('comment', 'Leave a comment', ['class' => 'control-label']) }}
    <div class="controls">
        {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
    </div>
</div>
<p>{{ Form::submit('Post Comment', ['class' => 'btn btn-primary']) }}</p>
{{Form::close()}}