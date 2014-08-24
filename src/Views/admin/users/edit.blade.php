@section('pageTitle', 'Edit User')

@section('content')
{{ Form::model($user, array('route' => array('admin.users.update', $user->id),  'method' => 'put')) }}
@include('admin.users.form')
@stop