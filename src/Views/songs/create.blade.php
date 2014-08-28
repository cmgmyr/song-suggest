@section('pageTitle', 'Add Song')

@section('content')
{{ Form::model($song, array('route' => array('songs.store'), 'method' => 'post')) }}
@include('songs.form')
@stop