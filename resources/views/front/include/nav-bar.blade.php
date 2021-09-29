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
                    <a class="nav-link  text-white" aria-current="page" href="{{ route('home') }}">خانه</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::check())
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('loginForm') }}">ورود</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('registerForm') }}">ثبت نام</a>
                    </li>
                @endif

            </ul>

                <ul class="navbar-nav">
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item dropdown d-flex align-items-start">
                        <a class="nav-link text-white" role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false"
                           id="navbarDropdownLink"
                           href="#">
                            {{\Illuminate\Support\Facades\Auth::user()->name }}
                        </a>
                        <ul class="dropdown dropdown-menu" aria-labelledby="navbarDropdownLink">
                            <li><a class="dropdown-item text-center" href="{{ route('profile') }}">پروفایل</a></li>
                            <li><a class="dropdown-item text-center" href="{{  route('logout') }}">خروج</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>



        </div>

    </div>
</nav>
