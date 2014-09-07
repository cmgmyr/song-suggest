@if($activities->count() > 0)
    @foreach($activities as $activity)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-{{$activity->color_class ?: 'info'}}">
                    <div class="row">
                        <div class="col-xs-3 col-sm-2 col-md-2"><img src="{{$activity->user->present()->avatar(65)}}" alt="{{$activity->user->first_name}}" class="avatar"></div>
                        <div class="col-xs-9 col-sm-10 col-md-10">
                            <p class="text-muted"><small title="{{$activity->created_at->format('m/d/Y @ g:i:s A T')}}">{{$activity->created_at->diffForHumans()}}</small></p>
                            @if($activity->type == 'activity')
                            <p>{{$activity->user->first_name . ' ' . $activity->message}}</p>
                            @else
                            <p>{{$activity->user->first_name . ' said: ' . $activity->comment}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Sorry, nothing here yet.</p>
@endif