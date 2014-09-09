@if(count($songs) > 0)
<table class="table table-hover table-condensed table-bordered table-striped song-table">
    <thead>
    <tr>
        <td>Artist</td>
        <td>Title</td>
        <td>Votes</td>
        <td>Manage</td>
    </tr>
    </thead>
    <tbody>
    @foreach($songs as $song)
    <tr>
        <td>{{$song->artist}}</td>
        <td>{{$song->title}}</td>
        <td>
            <span class="btn btn-success btn-xs">{{$song->positiveVotes()->count()}}</span>
            <span class="btn btn-danger btn-xs">{{$song->negativeVotes()->count()}}</span>
        </td>
        <td class="manage-buttons">
            @include('songs.partials.index-manage-buttons')
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
<p>Sorry, there are no songs.</p>
@endif