@section('pageTitle', 'Add User')

@section('content')
{{ Form::model($user, array('route' => array('admin.users'), 'method' => 'post')) }}
@include('admin.users.form')
@stop