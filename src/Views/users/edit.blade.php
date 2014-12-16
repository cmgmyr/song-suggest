@section('pageTitle', 'Edit User')

@section('content')
{{ Form::model($user, ['route' => ['users.update', $user->id],  'method' => 'put']) }}
@include('users.form')
@stop
