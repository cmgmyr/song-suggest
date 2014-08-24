@section('pageTitle', 'Add Post')

@section('content')
{{ Form::model($post, array('route' => array('admin.blog.posts'), 'method' => 'post')) }}
@include('admin.blog.posts.form')
@stop