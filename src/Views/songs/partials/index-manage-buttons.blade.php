@if(!$song->trashed())
    {{ link_to_route('songs.show', 'View', ['id' => $song->id], ['class' => 'btn btn-info btn-xs']) }}

    @if($currentUser->is_admin == 'y' || $song->totalVotes() <= 1)
        {{ link_to_route('songs.edit', 'Edit', ['id' => $song->id], ['class' => 'btn btn-primary btn-xs']) }}
    @endif
@endif

@if($currentUser->is_admin == 'y' || $currentUser->id == $song->user_id)
    @if($song->trashed())
        {{ Form::open(['route' => ['songs.restore', $song->id], 'method' => 'put', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
            <button type="submit" class="btn btn-success btn-xs">Restore</button>
        {{ Form::close() }}

        {{ Form::open(['route' => ['songs.force', $song->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
            <button type="submit" class="btn btn-danger btn-xs">Force Delete</button>
        {{ Form::close() }}
    @else
        {{ Form::open(['route' => ['songs.destroy', $song->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
        {{ Form::close() }}
    @endif
@endif
