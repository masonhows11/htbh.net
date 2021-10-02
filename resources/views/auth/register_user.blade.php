@extends('front.include.master_auth')
@section('page_title')
    ثبت نام کاربر
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



            <div class="row d-flex  register-content justify-content-center">
                <div class="col-lg-4 d-flex justify-content-center login-image">
                    <img src="{{asset('/images/vector-register.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-4 user-reg-content">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">نام</label>
                            <input type="text" class="form-control text-right @error('first_name') is-invalid @enderror"
                                   name="first_name"
                                    value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">نام خانوادگی</label>
                            <input type="text" class="form-control text-right @error('last_name') is-invalid @enderror"
                                   name="last_name"
                                   value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">نام کاربری</label>
                            <input type="text" class="form-control text-right @error('name') is-invalid @enderror"
                                   name="name"
                                   id="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">ایمیل</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   id="email" value="{{ old('email')  }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="pass" class="mb-2">رمز عبور</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   id="pass">
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirmPass" class="mb-2">تکرار رمز عبور</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="confirmPass">
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

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">ثبت نام</button>
                            <a href="{{ route('resendVerifyEmailForm') }}"
                               class="btn btn-outline-info resend-button">ارسال مجدد لینک فعال سازی</a>
                        </div>

                    </form>
                </div>

        </div>
</div>

@endsection

