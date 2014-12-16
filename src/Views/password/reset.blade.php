@section('pageTitle', 'Update your password')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{Form::open()}}
            {{Form::hidden('token', $token)}}
            <div class="form-group">
                {{Form::label('email', 'Email Address')}}
                {{Form::email('email', null, ['class' => 'form-control focus', 'placeholder' => 'Enter Email', 'required'])}}
            </div>

            <div class="form-group">
                {{Form::label('password', 'New Password')}}
                {{Form::password('password', ['class' => 'form-control', 'required'])}}
            </div>

            <div class="form-group">
                {{Form::label('password_confirmation', 'Confirm Password')}}
                {{Form::password('password_confirmation', ['class' => 'form-control', 'required'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Reset Password', ['class' => 'form-control btn btn-primary']) }}
            </div>
        {{Form::close()}}
    </div>
</div>
@stop
