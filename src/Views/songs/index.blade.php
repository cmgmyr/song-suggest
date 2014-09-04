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
                @include('songs.index-manage-buttons')
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