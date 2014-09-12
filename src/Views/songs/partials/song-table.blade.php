@if($categories->count() > 0)
<table class="table table-condensed song-table">
    @foreach($categories as $category)
        @if($category->songs()->count() > 0)
            <tr>
                <td class="song-table-title" colspan="5">
                    <h3>{{$category->name}}</h3>
                </td>
            </tr>
            <tr class="song-table-header bordered">
                <td>Artist</td>
                <td>Title</td>
                <td>Votes</td>
                <td class="hidden-xs">Suggested</td>
                <td>Manage</td>
            </tr>
            <?php $x = 0; ?>
            @foreach($category->songs as $song)
            <tr class="bordered hoverable {{$x % 2 == 1 ? 'striped' : ''}}">
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
            <?php $x++; ?>
            @endforeach
        @endif
    @endforeach
</table>
@else
<p>Sorry, there are no songs.</p>
@endif