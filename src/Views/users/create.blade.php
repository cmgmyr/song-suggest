@section('pageTitle', 'Add User')

@section('content')
{{ Form::model($user, ['route' => ['users'], 'method' => 'post']) }}
@include('users.form')
@stop
