@section('pageTitle', 'Update Account')

@section('content')
{{ Form::model($user, ['route' => ['account.update', $user->id],  'method' => 'put', 'files' => true]) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('first_name', 'First Name', ['class' => 'control-label']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control focus']) }}
        </div>

        <div class="form-group">
            {{ Form::label('last_name', 'Last Name', ['class' => 'control-label']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('image', 'Image (.jpg)', ['class' => 'control-label']) }}
            {{ Form::file('image', ['class' => 'form-control', 'accept' => '.jpg']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('password_confirm', 'Password (Confirm)', ['class' => 'control-label']) }}
            {{ Form::password('password_confirm', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <label>Email Notification</label>
            <div class="controls">
                <label>{{Form::radio('notify', 'y')}} Yes</label>
                <label>{{Form::radio('notify', 'n')}} No</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-6 text-right">
        {{ Form::submit('Save!', ['class' => 'btn btn-primary btn-large']) }}
    </div>
</div>
{{Form::close()}}
@stop