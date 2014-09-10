<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Song Suggest</title>

    <!-- CSS Files -->
    <link href="/assets/css/frontend.css<?php if($env != 'testing') echo '?' . filemtime('assets/css/frontend.css')?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    @include('layouts.partials.nav')
    <div class="container">
        @include('common.flash')
        <h1 class="page-header">@yield('pageTitle')</h1>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/assets/js/frontend.js<?php if($env != 'testing') echo '?' . filemtime('assets/js/frontend.js')?>" type="text/javascript"></script>
</body>
</html>
