@extends('admin.include.master')
@section('page_title')
    مدیریت مقالات
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>


        <div class="row category-dropdown-article">
            <div class="col-lg-6 col-md-6">
                <form action="{{route('listPostCategory')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="cat-dropdown">انتخاب یک دسته بندی :</label>
                        <select class="form-control input-sm"  name="category" id="cat-dropdown">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="دریافت مقالات">
                    </div>
                </form>
            </div>
        </div>

        <div class="row admin-content-models add-post-content">
            <div class="col-lg-6 col-md-6 col-xs-6 article-section">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
