@extends('admin.include.master')
@section('page_title')
  ویرایش کاربر
@endsection
@section('main_content')
    <div class="container edit-user-wrapper">

        <div class="row alert-section">
            <div class="col-lg-6 alert-box">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row edit-user-section">
            <div class="col-lg-6">
                <form action="{{ route('userUpdate') }}" method="post">
                    @csrf
                    <input type="hidden" name="user" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="name">نام کاربری:</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="email">
                    </div>
                    <button type="submit" class="btn btn-default">ذخیره</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('admin_scripts')

@endsection

