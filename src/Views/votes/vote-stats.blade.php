<hr>
<div class="vote-stats">
    <div class="vote-stats-display">
        Votes: <span class="btn btn-success">{{$song->positiveVotes()}}</span> and <span class="btn btn-danger">{{$song->negativeVotes()}}</span> out of {{$totalUsers}}
    </div>

    @if($song->positiveVoteUsers()->count() > 0)
        <div class="alert alert-success">
            @foreach($song->positiveVoteUsers() as $vote)
                <img src="{{$vote->user->present()->avatar(25)}}" alt="{{$vote->user->first_name}}" title="{{$vote->user->first_name}}" class="avatar">
            @endforeach
        </div>
    @endif

    @if($song->negativeVoteUsers()->count() > 0)
        <div class="alert alert-danger">
            @foreach($song->negativeVoteUsers() as $vote)
                <img src="{{$vote->user->present()->avatar(25)}}" alt="{{$vote->user->first_name}}" title="{{$vote->user->first_name}}" class="avatar">
            @endforeach
        </div>
    @endif
</div>
