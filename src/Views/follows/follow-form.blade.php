{{Form::open(['route' => ['follows.store', $song->id], 'class' => 'follow-form'])}}
<div>
    <label>
        {{Form::checkbox('follow', 'y', $following, ['id' => 'follow-checkbox'])}} Get email notifications about this song
    </label>
</div>
{{Form::close()}}