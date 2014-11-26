@if($currentUser->is_admin == 'y')
    <hr class="hidden-xs hidden-sm">
    <h4>Admin Controls:</h4>

    {{ Form::open(['route' => ['songs.reset', $song->id], 'method' => 'put', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
        <button type="submit" class="btn btn-warning">Reset Votes</button>
    {{ Form::close() }}

    {{ Form::open(['route' => ['songs.destroy', $song->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
        <button type="submit" class="btn btn-danger">Delete</button>
    {{ Form::close() }}
@endif