<?php

View::share('currentUser', Auth::user());
View::share('totalUsers', \Ss\Repositories\User\User::all()->count());