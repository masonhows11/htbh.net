@extends('front.include.master_auth')
@section('page_title')
    ورود کاربر
@endsection
@section('main_content')
    <div class="container  login">


        <div class="container">

            <div class="row mt-2 d-flex justify-content-center">

                <div class="col-lg-6 alert-wrapper">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <p class="text-center">{{ session('success')  }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            <p class="text-center">{{ session('error')  }}</p>
                        </div>
                    @endif

                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>


        <div class="row d-flex login-content justify-content-center align-items-center">

            <div class="col-lg-4 d-flex justify-content-center login-image">
                <img src="{{asset('/images/vector-login.png')}}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-4 login-form">
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل:</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror text-right"
                            id="email"
                            value="{{ old('email')  }}"
                            placeholder="...ایمیل خود را وارد کنید">

                    </div>

                    <div class="mt-3">
                        <label for="password" class="form-label">رمز عبور:</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               placeholder="رمز عبور را وارد کنید..">

                    </div>


                    <div class="mt-3">
                        <label>
                            <input type="checkbox" name="remember"> مرا بخاطر بسپار
                        </label>
                        @error('remember')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                        @if( Session::has('g-recaptcha-response-error'))
                            <p class="alert alert-danger text-center" role="alert">
                                {{ Session::get('g-recaptcha-response-error')  }}
                            </p>
                        @endif
                        <br/>
                    </div>


                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">ورود</button>
                        <a href="#" class="btn btn-outline-info forget-button">فراموشی رمز عبور !</a>
                    </div>
                </form>

            </div>

        </div>


    </div>

@endsection
