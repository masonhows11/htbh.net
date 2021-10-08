
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
                <form action="{{ route('updatePerm') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $perm->id }}">
                    <div class="form-group">
                        <label for="perm">نام مجوز</label>
                        <input type="text" name="name" value="{{ $perm->name }}" class="form-control" id="perm">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                    <a href="{{ route('perms') }}" class="btn btn-default">انصراف</a>
                </form>
            </div>


        </div>



    </div>
@endsection
@section('admin_scripts')
@endsection

