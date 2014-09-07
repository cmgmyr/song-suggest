@section('pageTitle', 'Edit Song')

@section('content')
{{ Form::model($song, ['route' => ['songs.update', $song->id],  'method' => 'put']) }}
@include('songs.form')
@stop