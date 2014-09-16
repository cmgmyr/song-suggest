@if($user->trashed())
    {{ Form::open(['route' => ['users.restore', $user->id], 'method' => 'put', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
        <button type="submit" class="btn btn-success btn-xs">Restore</button>
    {{ Form::close() }}

    {{ Form::open(['route' => ['users.force', $user->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
        <button type="submit" class="btn btn-danger btn-xs">Force Delete</button>
    {{ Form::close() }}
@else
    @if($currentUser->id != $user->id)
    <a href="{{URL::route('users.edit', ['id' => $user->id])}}" class="btn btn-primary btn-xs">Edit</a>

    {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm']) }}
    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
    {{ Form::close() }}
    @endif
@endif