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

        <div class="container">



        </div>

    </div>
@endsection
