@section('pageTitle', $song->title . ' <small>by ' . $song->artist . '</small>')

@section('content')
<div class="row">
    <div class="col-md-4">
        @if($youTubeId = $song->getYouTubeId())
            <div class='responsive-video'><iframe src='http://www.youtube.com/embed/{{$youTubeId}}' frameborder='0' allowfullscreen></iframe></div>
        @endif

        <div class="vote-stats">
            Votes: <span class="btn btn-success">{{$song->positiveVotes()}}</span> and <span class="btn btn-danger">{{$song->negativeVotes()}}</span> out of {{$totalUsers}}
        </div>

        @include('votes.vote-form')

        @include('follows.follow-form')
    </div>
    <div class="col-md-8">
        @include('comments.comment-form')

        @include('activities.activity-list')
    </div>
</div>
@stop