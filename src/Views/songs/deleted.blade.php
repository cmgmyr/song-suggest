@section('pageTitle', 'Deleted Songs')

@section('content')
@if($songs->count() > 0)
<table class="table table-condensed table-striped table-bordered table-hover song-table">
    <thead>
        <tr>
            @include('songs.partials.song-table-header')
        </tr>
    </thead>
    <tbody>
        @foreach($songs as $song)
        <tr>
            @include('songs.partials.song-table-body')
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Sorry, there are no songs.</p>
@endif
@stop