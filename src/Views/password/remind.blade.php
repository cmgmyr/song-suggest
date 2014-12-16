@section('pageTitle', 'Need to reset your password?')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{Form::open()}}
            <div class="form-group">
                {{Form::label('email', 'Email Address')}}
                {{Form::email('email', null, ['class' => 'form-control focus', 'placeholder' => 'Enter Email', 'required'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Reset Password', ['class' => 'form-control btn btn-primary']) }}
            </div>
        {{Form::close()}}
    </div>
</div>
@stop
