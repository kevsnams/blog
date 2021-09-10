<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="author" content="{{ env('BLOG_META_AUTHOR') }}">
    <mete name="keywords" content="{{ env('BLOG_META_KEYWORDS') }}">
    <meta name="description" content="{{ env('BLOG_META_DESCRIPTION') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- TODO -->
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>
<body>
    @yield('content')
</body>
</html>
