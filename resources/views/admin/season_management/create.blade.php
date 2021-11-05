@extends('admin.include.master')
@section('page_title')
    ایجاد فصل جدید
@endsection
@section('main_content')
<div class="container">

    <div class="row  alert-section-season">
        <div class="col-lg-6 col-md-6 col-xs-6 alert-box" >
            @include('admin.include.alert')
        </div>
    </div>

    <div class="row season_list">

        <div class="col-lg-8 col-md-8 col-xs-8">
            <form action="{{ route('storeSeason') }}" method="post">
                @csrf
                <input type="hidden" name="course" value="{{ $course->id }}">
                <div class="form-group">
                    <label for="season">عنوان فصل به فارسی</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        id="season">
                </div>

                <div class="form-group">
                    <label for="season">نام فصل به انگلیسی</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        id="season">
                </div>

                <button type="submit" class="btn btn-success">ذخیره</button>
            </form>
        </div>

    </div>

</div>
@endsection
