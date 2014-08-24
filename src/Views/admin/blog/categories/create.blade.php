@section('pageTitle', 'Add Category')

@section('content')
{{ Form::model($category, array('route' => array('admin.blog.categories'), 'method' => 'post')) }}
@include('admin.blog.categories.form')
@stop