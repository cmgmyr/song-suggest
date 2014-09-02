@section('pageTitle', 'Users')

@section('content')
<div class="row">
    <div class="col-md-6">
        &nbsp;
    </div>
    <div class="col-md-6">
        <a href="{{URL::route('users.create')}}" class="btn btn-primary pull-right">Create New</a>
    </div>
</div>
<hr />
@if(count($users) > 0)
<div class="table-responsive clear">
    <table class="table table-hover table-condensed table-bordered table-striped">
        <thead>
        <tr>
            <td>Last Name</td>
            <td>First Name</td>
            <td>Email</td>
            <td>Active</td>
            <td>Admin</td>
            <td>Manage</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->last_name}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{HTML::mailto($user->email)}}</td>
            <td>{{$user->is_active}}</td>
            <td>{{$user->is_admin}}</td>
            <td>
                @if($currentUser->id != $user->id)
                <a href="{{URL::route('users.edit', array('id' => $user->id))}}" class="btn btn-primary btn-xs">Edit</a>

                {{ Form::open(array('route' => array('users.destroy', $user->id), 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm')) }}
                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                {{ Form::close() }}
                @endif
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