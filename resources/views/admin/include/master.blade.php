<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('admin.include.header_styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    @include('admin.include.header')
    @include('admin.include.sidebar')
    <div class="content-wrapper">
        @include('admin.include.content_header')

        <section class="content">
            @yield('main_content')
        </section>

    </div>
    @include('admin.include.footer')

    @include('admin.include.control_sidebar')
    <div class="control-sidebar-bg"></div>
</div>


@include('admin.include.footer_scripts')
@yield('admin_scripts')


</body>
</html>
