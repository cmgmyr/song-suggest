@section('pageTitle', 'Add Tag')

@section('content')
{{ Form::model($tag, array('route' => array('admin.blog.tags'), 'method' => 'post')) }}
@include('admin.blog.tags.form')
@stop