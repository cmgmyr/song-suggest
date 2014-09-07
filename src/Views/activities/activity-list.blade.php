@if($activities->count() > 0)
    @foreach($activities as $activity)
        @if($activity->type == 'activity')
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-{{$activity->color_class ?: 'info'}}">
                        <div class="row">
                            <div class="col-md-2"><img src="{{$activity->user->present()->avatar(60)}}" alt="{{$activity->user->first_name}}"></div>
                            <div class="col-md-10">
                                <p class="text-muted"><small title="{{$activity->created_at->format('m/d/Y @ g:i:s A T')}}">{{$activity->created_at->diffForHumans()}}</small></p>
                                <p>{{$activity->user->first_name . ' ' . $activity->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-{{$activity->color_class ?: 'info'}}">
                        <div class="row">
                            <div class="col-md-2"><img src="{{$activity->user->present()->avatar(60)}}" alt="{{$activity->user->first_name}}"></div>
                            <div class="col-md-10">
                                <p class="text-muted"><small title="{{$activity->created_at->format('m/d/Y @ g:i:s A T')}}">{{$activity->created_at->diffForHumans()}}</small></p>
                                <p>{{$activity->user->first_name . ' said: ' . $activity->comment}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <p>Sorry, nothing here yet.</p>
@endif