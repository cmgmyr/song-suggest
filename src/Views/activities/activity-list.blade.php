@if($activities->count() > 0)
    @foreach($activities as $activity)
        <article class="media alert alert-{{$activity->color_class ?: 'info'}}">
            <div class="pull-left">
                <img src="{{$activity->user->present()->avatar(65)}}" alt="{{$activity->user->first_name}}" title="{{$activity->user->first_name}}" class="avatar">
            </div>

            <div class="media-body">
                <h4 class="media-heading">{{$activity->user->first_name}}</h4>
                <p class="text-muted"><small title="{{$activity->created_at->format('m/d/Y @ g:i:s A T')}}">{{$activity->created_at->diffForHumans()}}</small></p>

                {{$activity->text}}
            </div>
        </article>
    @endforeach
@else
    <p>Sorry, nothing here yet.</p>
@endif