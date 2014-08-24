@section('pageTitle', 'Blog Posts')

@section('content')
<div class="admin-btn-group row">
    <div class="col-md-6">
        &nbsp;
    </div>
    <div class="col-md-6">
        <a href="{{URL::route('admin.blog.posts.create')}}" class="btn btn-primary pull-right">Create New</a>
    </div>
</div>
<hr />
@if(count($posts) > 0)
<div class="table-responsive clear">
    <table class="table table-hover table-condensed table-bordered table-striped">
        <thead>
        <tr>
            <td>Title</td>
            <td>Slug</td>
            <td>Manage</td>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->slug}}</td>
            <td>
                <a href="{{URL::route('admin.blog.posts.edit', array('id' => $post->id))}}" class="btn btn-primary btn-xs">Edit</a>

                {{ Form::open(array('route' => array('admin.blog.posts.destroy', $post->id), 'method' => 'delete', 'style' => 'display:inline;', 'data-confirm' => 'Are you sure?', 'class' => 'delete-confirm')) }}
                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<p>Sorry, there are no records.</p>
@endif
@stop