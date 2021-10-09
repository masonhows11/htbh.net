@extends('admin.include.master')
@section('page_title')
    مدیریت دسته بندی ها
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
                <form action="{{ route('storeNewCategory') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">عنوان دسته بندی به فارسی</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror " id="title">
                    </div>
                    <div class="form-group">
                        <label for="name">نام دسته بندی به انگلیسی</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " id="name">
                    </div>
                    <div class="form-group">
                        <label for="parent">انتخاب دسته بندی والد</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value=""></option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title}}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>
            </div>

        </div>


    </div>
@endsection