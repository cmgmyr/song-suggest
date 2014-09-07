{{ link_to_route('songs.show', 'View', ['id' => $song->id], ['class' => 'btn btn-info btn-xs']) }}

@if($currentUser->is_admin == 'y' || $song->votes()->count() <= 1)
    {{ link_to_route('songs.edit', 'Edit', ['id' => $song->id], ['class' => 'btn btn-primary btn-xs']) }}
@endif

@if($currentUser->is_admin == 'y' || $currentUser->id == $song->user_id)
    {{ Form::open(['route' => ['songs.destroy', $song->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
    {{ Form::close() }}
@endif