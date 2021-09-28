@extends('front.include.master_auth')
@section('page_title')
    ثبت نام کاربر
@endsection
@section('main_content')

    <div class="container mt-4 msg-wrapper">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 ">

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
        </div>
    </div>

    <div class="container user-reg-wrapper">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 user-reg-content">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">نام کاربری</label>
                        <input type="text" class="form-control text-right @error('name') is-invalid @enderror" name="name"
                               id="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">ایمیل</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               id="email" value="{{ old('email')  }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="pass" class="mb-2">رمز عبور</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                               id="pass">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirmPass" class="mb-2">تکرار رمز عبور</label>
                        <input type="password" name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPass">
                        @error('password_confirmation')
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


                    <button type="submit" class="btn btn-outline-primary">ثبت نام</button>
                </form>
            </div>


        </div>
    </div>


@endsection

