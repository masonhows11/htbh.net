<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>
    @include('front.include.header_style')
</head>
<body>
@include('front.include.nav-bar')
@include('front.include.category')
@include('front.include.hero')
@include('front.include.boxes')
@include('front.include.road_map')

@yield('main-content')

@include('front.include.footer')
@include('front.include.footer-scripts')
</body>
</html>
