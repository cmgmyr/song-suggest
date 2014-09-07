@section('pageTitle', 'Log In')

@section('content')
<div id="login-form" class="row">
    {{Form::open(['route' => 'attemptLogin', 'class' => 'col-lg-4 col-lg-offset-4'])}}
    <fieldset>
        <div class="form-group">
            {{Form::label('email', 'Email Address')}}
            {{Form::email('email', null, ['class' => 'form-control focus', 'placeholder' => 'Enter Email'])}}
        </div>

        <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password'])}}
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </fieldset>
    {{Form::close()}}
</div>
@stop