@extends('front.include.master_auth')
@section('page_title')
    ثبت نام کاربر
@endsection
@section('main_content')

    <div class="container">
        <div class="row">
            <div class="offset-lg-3 offset-md-3 offset-sm-6 col-lg-6 col-md-6 col-sm-6 mb-3 mt-3 login-msg-wrapper">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <p class="text-center">{{ session('success')  }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="offset-lg-4 offset-md-4 offset-sm-4 col-lg-5 col-md-5 col-sm-5 user-reg-wrapper">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name" class="mb-2">نام کاربری</label>
                        <input type="text" class="form-control text-left @error('user_name') is-invalid @enderror" name="user_name"
                               id="name" value="{{ old('name') }}">
                        @error('user_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="email" class="mb-2">ایمیل</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               id="email" value="{{ old('email')  }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="pass" class="mb-2">رمز عبور</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                               id="pass">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="confirmPass" class="mb-2">تکرار رمز عبور</label>
                        <input type="password" name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPass">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
                    @if( Session::has('g-recaptcha-response-error'))
                        <p class="alert alert-danger text-center" role="alert">
                            {{ Session::get('g-recaptcha-response-error')  }}
                        </p>
                    @endif
                    <br/>

                    <button type="submit" class="btn btn-outline-primary">ثبت نام</button>
                </form>
            </div>


        </div>
    </div>


@endsection

