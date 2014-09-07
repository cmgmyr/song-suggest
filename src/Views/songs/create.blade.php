@section('pageTitle', 'Add Song')

@section('content')
{{ Form::model($song, ['route' => ['songs.store'], 'method' => 'post']) }}
@include('songs.form')
@stop