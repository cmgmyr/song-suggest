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

        @if($currentUser)
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Add Song</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" name="user-dropdown">{{ $currentUser->first_name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>{{link_to_route('account', 'Update Account')}}</li>
                        <li class="divider"></li>
                        <li>{{link_to_route('logout', 'Logout')}}</li>
                    </ul>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>