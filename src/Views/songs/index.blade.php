@section('pageTitle', 'Songs')

@section('content')
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
                @include('songs.partials.song-table-header')
            </tr>
            <?php $x = 0; ?>
            @foreach($category->popularSongs() as $song)
            <tr class="bordered hoverable {{$x % 2 == 1 ? 'striped' : ''}}">
                @include('songs.partials.song-table-body')
            </tr>
            <?php $x++; ?>
            @endforeach
        @endif
    @endforeach
</table>
@else
<p>Sorry, there are no songs.</p>
@endif
@stop