<div class="row">
    <div class="col-md-6">
        &nbsp;
    </div>
    <div class="col-md-6 user-buttons">
        <a href="{{URL::route('users.deleted')}}" class="btn btn-danger pull-right">View Deleted</a>
        <a href="{{URL::route('users.create')}}" class="btn btn-primary pull-right">Create New</a>
        <a href="{{URL::route('users')}}" class="btn btn-info pull-right">View Users</a>
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
                @include('users.partials.manage-buttons')
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<p>Sorry, there are no records.</p>
@endif
