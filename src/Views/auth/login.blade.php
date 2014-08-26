@section('pageTitle', 'Log In')

@section('content')
<div id="login-form" class="row">
    {{Form::open(array('route' => 'attemptLogin', 'class' => 'col-lg-4 col-lg-offset-4'))}}
    <fieldset>
        <legend class="">Login</legend>

        <div class="form-group">
            {{Form::label('email', 'Email Address')}}
            {{Form::email('email', null, array('class' => 'form-control focus', 'placeholder' => 'Enter Email'))}}
        </div>

        <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password'))}}
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </fieldset>
    {{Form::close()}}
</div>
@stop