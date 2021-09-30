@extends('front.include.master_auth')
@section('page_title')
    تغییر رمز عبور
@endsection
@section('main_content')
    <div class="container">

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-lg-6 alert-wrapper">
                @if ($errors->any())
                    <div class="alert alert-danger validation-error" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row  d-flex login-content justify-content-center align-items-center">
            <div class="col-lg-4 login-form">
                <form action="{{ route('resetPassHandle') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
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

                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">تغییر رمز</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

