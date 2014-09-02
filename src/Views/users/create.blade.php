@section('pageTitle', 'Add User')

@section('content')
{{ Form::model($user, array('route' => array('users'), 'method' => 'post')) }}
@include('users.form')
@stop