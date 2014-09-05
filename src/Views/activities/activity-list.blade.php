@if($activities->count() > 0)
    @foreach($activities as $activity)
        @if($activity->type == 'activity')
            <div class="row alert alert-{{$activity->color_class ?: 'info'}}">
                <div class="col-md-2"><img src="{{$activity->user->present()->avatar(60)}}" alt="{{$activity->user->first_name}}"></div>
                <div class="col-md-10">{{$activity->user->first_name . ' ' . $activity->message}}</div>
            </div>
        @else
            <div class="row alert alert-{{$activity->color_class ?: 'info'}}">
                <div class="col-md-2"><img src="{{$activity->user->present()->avatar(60)}}" alt="{{$activity->user->first_name}}"></div>
                <div class="col-md-10">{{$activity->user->first_name . ' said: ' . $activity->comment}}</div>
            </div>
        @endif
    @endforeach
@else
    <p>Sorry, nothing here yet.</p>
@endif