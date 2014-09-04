@section('pageTitle', $song->title . ' <small>by ' . $song->artist . '</small>')

@section('content')
<div class="row">
    <div class="col-md-4">
        @if($youTubeId = $song->getYouTubeId())
            <div class='responsive-video'><iframe src='http://www.youtube.com/embed/{{$youTubeId}}' frameborder='0' allowfullscreen></iframe></div>
        @endif

        <div class="vote-stats">
            Votes: <span class="btn btn-success">{{$song->positiveVotes()->count()}}</span> and <span class="btn btn-danger">{{$song->negativeVotes()->count()}}</span> out of {{$totalUsers}}
        </div>

        @include('votes.vote-form')
    </div>
    <div class="col-md-8">
        <h3>Activity Log</h3>
        @if($song->activities()->count() > 0)
            @foreach($song->activities as $activity)
            <div class="row alert alert-{{$activity->color_class ?: 'default'}}">
                <div class="col-md-2"><img src="{{$activity->user->present()->avatar(60)}}" alt="{{$activity->user->first_name}}"></div>
                <div class="col-md-10">{{$activity->user->first_name . ' ' . $activity->message}}</div>
            </div>
            @endforeach
        @else
            <p>Sorry, nothing here yet.</p>
        @endif
    </div>
</div>
@stop