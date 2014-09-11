@if(count($songs) > 0)
<table class="table table-hover table-condensed table-bordered table-striped song-table">
    <thead>
    <tr>
        <td>Artist</td>
        <td>Title</td>
        <td>Votes</td>
        <td class="hidden-xs">Suggested</td>
        <td>Manage</td>
    </tr>
    </thead>
    <tbody>
    @foreach($songs as $song)
    <tr>
        <td>{{$song->artist}}</td>
        <td>{{$song->title}}</td>
        <td>
            <span class="btn btn-success btn-xs" title="Yes Votes">{{$song->positiveVotes()}}</span>
            <span class="btn btn-danger btn-xs" title="No Votes">{{$song->negativeVotes()}}</span>
            <span class="btn btn-info btn-xs" title="# of Comments">{{$song->commentsCount()}}</span>
        </td>
        <td class="hidden-xs">{{$song->created_at->diffForHumans()}}</td>
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