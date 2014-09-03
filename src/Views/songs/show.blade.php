@section('pageTitle', $song->title . ' <small>by ' . $song->artist . '</small>')

@section('content')
<p>Votes: <span class="btn btn-success">{{$song->positiveVotes()->count()}}</span> and <span class="btn btn-danger">{{$song->negativeVotes()->count()}}</span> out of {{$totalUsers}}</p>
<p>More info coming soon...</p>
@stop