@extends('front.include.master_auth')
@section('page_title')
    ویرایش ایمیل کاربر
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


        <div class="container edit-email-wrapper">
            <form action="{{ route('editEmail') }}" method="post">
                @csrf
                <div class="row d-flex justify-content-center mt-2">
                    <div class="col-md-4">
                        <label class="labels first-name text-lg font-medium">ایمیل :</label>
                        <input type="email" name="email" class="form-control @error('email') is_invalid @enderror " value="{{ $user->email }}">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary" type="submit">ذخیره</button>
                </div>
            </form>
        </div>



    </div>
@endsection
