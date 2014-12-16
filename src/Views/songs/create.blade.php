@section('pageTitle', 'Add Song')

@section('content')
{{ Form::model($song, ['route' => ['songs.store'], 'method' => 'post', 'files' => true]) }}
@include('songs.form')
@stop
