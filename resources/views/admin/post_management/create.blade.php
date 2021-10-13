@extends('admin.include.master')
@section('page_title')
    مقاله جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-post">
            <div class="col-lg-6 col-md-6">

                <form action="{{ route('storeNewArticle') }}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="title">عنوان مقاله به فارسی :</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="name">نام مقاله به انگلیسی :</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>


                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>

            </div>
        </div>
    </div>
@endsection
