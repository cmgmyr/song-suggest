@if($currentUser->is_admin == 'y')
<hr>
{{Form::open(['route' => ['songs.category', $song->id],  'method' => 'put'])}}
    <!-- Update Category Form Input -->
    <div class="form-group">
        {{ Form::label('category_id', 'Update Category', ['class' => 'control-label']) }}
        {{Form::select('category_id', $categories->lists('name', 'id'), $song->category_id, ['class' => 'form-control'])}}
    </div>
    
    <!-- Save Form Input -->
    <div class="form-group">
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    </div>
{{Form::close()}}
@endif