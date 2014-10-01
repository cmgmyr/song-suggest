@if($currentUser->is_admin == 'y')
<hr>
{{Form::open()}}
    <!-- Update Category Form Input -->
    <div class="form-group">
        {{ Form::label('category', 'Update Category', ['class' => 'control-label']) }}
        {{Form::select('category', $categories->lists('name', 'id'), $song->category_id, ['class' => 'form-control'])}}
    </div>
{{Form::close()}}
@endif