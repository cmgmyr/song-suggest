@section('pageTitle', 'Edit User')

@section('content')
{{ Form::model($user, array('route' => array('users.update', $user->id),  'method' => 'put')) }}
@include('users.form')
@stop