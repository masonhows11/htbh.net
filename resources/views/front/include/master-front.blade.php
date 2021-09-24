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
<!-------------------------------------- navbar section -------------------------------->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- logo  -->
        <a class="navbar-brand" href="#"><span class="text-red-500  text-2xl font-bold">Hack</span> <span
                class="text-red-500 font-black">Learn</span></a>
        <!-- toggler button  -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- nav item -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link  text-white" aria-current="page" href="#">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">ورود</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">ثبت نام</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-flex align-items-start">
                    <a class="nav-link text-white" href="#"> پروفایل کاربری</a>
                </li>
            </ul>

        </div>

    </div>
</nav>
<!------------------------- search section --------------------->
<header class="py-3 mb-3  search-section">

    <div class="container ">

        <form action="#" class="row d-flex justify-content-center row-cols-lg-auto g-1 align-items-center">

            <div class="col-lg-6">
                <input type="search" class="form-control" placeholder="دنبال چی هستی...." aria-label="Search">
            </div>

            <div class="col-lg-2 d-flex search-btn">
                <button type="submit" class="btn btn-outline-danger mt">بگرد..</button>
            </div>

        </form>
    </div>

</header>

{{--@include('front.include.nav-bar')--}}
@include('front.include.category')
@include('front.include.hero')
@include('front.include.boxes')
@include('front.include.road_map')

@yield('main-content')

@include('front.include.footer')
@include('front.include.footer-scripts')
</body>
</html>
