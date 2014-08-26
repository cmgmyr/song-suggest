@section('pageTitle', 'Edit Song')

@section('content')
{{ Form::model($song, array('route' => array('songs.update', $song->id),  'method' => 'put')) }}
@include('songs.form')
@stop