{{Form::open(['route' => ['comments.store', $song->id], 'class' => 'comment-form'])}}
    <div class="form-group">
        {{ Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Leave a comment', 'required', 'rows' => 3]) }}
    </div>

    <div class="form-group comment-form-submit">
        {{ Form::submit('Post Comment', ['class' => 'btn btn-sm btn-default']) }}
    </div>
{{Form::close()}}
