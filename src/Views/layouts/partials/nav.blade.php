<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('')}}">Song Suggest</a>
        </div>

        @if(Auth::check())
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Add Song</a></li>
                <li class="{{ Route::is('account') ? 'active' : '' }}">{{link_to_route('account', 'Update Account')}}</li>
                <li>{{link_to_route('logout', 'Logout')}}</li>
            </ul>
        </div>
        @endif
    </div>
</nav>