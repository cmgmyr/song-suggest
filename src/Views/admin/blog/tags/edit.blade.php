@section('pageTitle', 'Edit Tag')

@section('content')
{{ Form::model($tag, array('route' => array('admin.blog.tags.update', $tag->id),  'method' => 'put')) }}
@include('admin.blog.tags.form')
@stop