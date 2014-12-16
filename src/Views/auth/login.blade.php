@section('pageTitle', 'Log In')

@section('content')
<div id="login-form" class="row">
    <div class="col-md-6 col-md-offset-3">
        {{Form::open(['route' => 'attemptLogin'])}}
            <div class="form-group">
                {{Form::label('email', 'Email Address')}}
                {{Form::email('email', null, ['class' => 'form-control focus', 'placeholder' => 'Enter Email', 'required'])}}
            </div>

            <div class="form-group">
                {{Form::label('password', 'Password')}}
                {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'required'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}

                <label>
                    {{Form::checkbox('remember')}} Remember <span class="hidden-xs">me</span>
                </label>

                {{link_to('/password/remind', 'Reset Password', ['class' => 'btn btn-default pull-right'])}}
            </div>
        {{Form::close()}}
    </div>
</div>
@stop
