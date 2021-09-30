@extends('front.include.master_auth')
@section('page_title')
    فراموشی رمز عبور
@endsection
@section('main_content')
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
                <form action="{{ route('resetPassCheckEmail') }}" method="post" novalidate>
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
                        <button type="submit" class="btn btn-outline-primary">تایید ایمیل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

