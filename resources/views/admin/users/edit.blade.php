@extends('admin.include.master')
@section('page_title')
    مدیریت کاربران
@endsection
@section('main_content')
    <div class="container edit-user-wrapper">

        <div class="row alert-section">
            <div class="col-lg-6 alert-box" style="border: 1px solid red">

            </div>
        </div>

        <div class="row edit-user-section">
            <div>
                <form action="/admin/update" method="post">
                    <div class="form-group">
                        <label for="name">نام کاربری:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <button type="submit" class="btn btn-default">ذخیره</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('admin_scripts')

@endsection

