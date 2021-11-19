@extends('admin.include.master')
@section('page_title')
   ویرایش فصل
@endsection
@section('main_content')
    <div class="container">

        <div class="row season_wrapper">

            <div class="col-lg-8 col-md-8 col-xs-8 create_season">

                <form action="{{ route('updateSeason') }}" method="post">
                    @csrf
                    <input type="hidden" name="season" value="{{ $season->id }}">

                    <div class="form-group">
                        <label for="season">عنوان فصل به فارسی</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ $season->title }}"
                            id="season">
                    </div>

                    <div class="form-group">
                        <label for="season">نام فصل به انگلیسی</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ $season->name }}"
                            id="season">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                    <a href="{{ route('courses') }}" class="btn btn-default">بازگشت</a>
                </form>
            </div>
        </div>

    </div>
@endsection
