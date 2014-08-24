@section('pageTitle', 'Edit Category')

@section('content')
{{ Form::model($category, array('route' => array('admin.blog.categories.update', $category->id),  'method' => 'put')) }}
@include('admin.blog.categories.form')
@stop