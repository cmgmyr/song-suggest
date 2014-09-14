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