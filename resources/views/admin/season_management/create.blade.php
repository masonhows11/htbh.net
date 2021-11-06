@extends('admin.include.master')
@section('page_title')
    ایجاد فصل جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row  alert-section-season">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row season_wrapper">

            <div class="col-lg-8 col-md-8 col-xs-8 create_season">
                <h3 class="course-title-form">{{ $course[0]->title }}</h3>
                <form action="{{ route('storeSeason') }}" method="post">
                    @csrf
                    <input type="hidden" name="course" value="{{ $course[0]->id }}">
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

            <div class="col-lg-8 col-md-8 col-xs-8 list-season" style="border: 1px solid red">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($course as $item )
                        @foreach($item->seasons as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                    <span><a href="/admin/course/edit?course={{ $course->id }}"
                                             class="text-info text-bold"><i class="fa fa-edit"></i></a></span>
                                    <span><i class="fa fa-remove text-primary" data-course-id="{{ $course->id }}"
                                             id="deleteItem"></i></span>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
