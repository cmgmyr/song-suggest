@section('pageTitle', 'Edit Post')

@section('content')
{{ Form::model($post, array('route' => array('admin.blog.posts.update', $post->id),  'method' => 'put')) }}
@include('admin.blog.posts.form')
@stop