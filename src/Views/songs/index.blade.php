@section('pageTitle', 'Songs')

@section('content')
@if(count($songs) > 0)
<div class="table-responsive clear">
    <table class="table table-hover table-condensed table-bordered table-striped">
        <thead>
        <tr>
            <td>Artist</td>
            <td>Title</td>
            <td>Manage</td>
        </tr>
        </thead>
        <tbody>
        @foreach($songs as $song)
        <tr>
            <td>{{$song->artist}}</td>
            <td>{{$song->title}}</td>
            <td>
                {{ link_to_route('songs.show', 'View', ['id' => $song->id], ['class' => 'btn btn-info btn-xs']) }}

                {{ link_to_route('songs.edit', 'Edit', ['id' => $song->id], ['class' => 'btn btn-primary btn-xs']) }}

                {{ Form::open(array('route' => array('songs.destroy', $song->id), 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm')) }}
                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<p>Sorry, there are no records.</p>
@endif
@stop