@extends('admin.include.master')
@section('page_title')
    مدیریت نظرات دوره ها
@endsection
@section('main_content')
    <div class="container">

        <div class="row courses-comments">
            <div class="col-lg-10 select-category-comment">


                <div class="form-group">
                    <label for="se_cat">یک دسته بندی انتخاب کنید.</label>
                    <select id="se_cat" class="select_category" name="select_category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-lg-10 list-courses">

                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">نام دوره</th>
                        <th class="text-center">لیست نظرات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->title  }}</td>
                            <td><a href="#">لیست نظرات</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">


        </div>
    </div>
@endsection
@section('admin_scripts')

@endsection


