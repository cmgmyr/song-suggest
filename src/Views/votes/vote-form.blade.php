{{Form::model($vote, ['route' => ['votes.store', $song->id], 'class' => 'form-inline voting-form'])}}
<div class="form-group">
    <label>
        Your Vote:
    </label>
</div>
<div class="radio">
    <label>
        {{Form::radio('vote', 'y')}} Yes
    </label>
</div>
<div class="radio">
    <label>
        {{Form::radio('vote', 'n')}} No
    </label>
</div>
<div class="form-group">
    {{ Form::submit('Vote!', ['class' => 'btn btn-sm btn-primary']) }}
</div>
{{Form::close()}}
