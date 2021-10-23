@extends('admin.include.master')
@section('page_title')
    ویرایش نقش ها
@endsection
@section('main_content')
    <div class="container">


        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models">

            <div class="col-lg-6 col-md-6 col-xs-6">
                <form action="{{ route('updateRole') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="form-group">
                        <label for="role">نام نقش</label>
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" id="role">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                    <a href="{{ route('roles') }}" class="btn btn-default">انصراف</a>
                </form>
            </div>


        </div>



    </div>
@endsection
@section('admin_scripts')
@endsection

