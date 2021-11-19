<!-------------------------------------- navbar section -------------------------------->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- logo  -->
        <a class="navbar-brand" href="{{ route('home') }}"><span class="text-red-500  text-2xl font-bold">Hack</span> <span
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
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logOut') }}">خروج</a>
                    </li>
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
                    <li class="nav-item d-flex align-items-center">
                        <div class="basket-content d-flex justify-content-around">

                            <div>
                                <span class="basket-count text-dark" id="basket-count"> @isset($basket_count) {{ $basket_count  }} @else 0 @endisset</span>
                            </div>

                            <div>
                                <a href="{{ route('basket')  }}" class="fa fa-shopping-basket"></a>
                            </div>
                        </div>
                    </li>
                   @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item dropdown d-flex align-items-start">
                        <a class="nav-link text-white"
                           role="button"
                           aria-expanded="false"
                           id="navbarDropdownLink"
                           href="{{ route('profile') }}">
                            {{\Illuminate\Support\Facades\Auth::user()->name }}
                        </a>
                    </li>
                    @endif

                </ul>



        </div>

    </div>
</nav>
