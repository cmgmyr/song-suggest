@section('pageTitle', 'Songs')

@section('content')
@if(count($songs) > 0)
<table class="table table-hover table-condensed table-bordered table-striped song-table">
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
        <td class="manage-buttons">
            @include('songs.index-manage-buttons')
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
<p>Sorry, there are no records.</p>
@endif
@stop