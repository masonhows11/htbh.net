@extends('admin.include.master')
@section('page_title')
    مدیریت نظرات دوره ها
@endsection
@section('main_content')
    <div class="container">

        <div class="row courses-comments">

            <div class="col-lg-10 select-category-comment">

                <form action="{{ route('getCoursesCategory') }}" method="get">

                    <div class="form-group">
                        <label for="se_cat">یک دسته بندی انتخاب کنید.</label>
                        <select id="se_cat" class="select_category" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="دریافت مقالات">
                    </div>

                </form>

            </div>

            <div class="col-lg-10 list-courses" id="list_courses">

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
                            <td class="text-center">{{ $course->id }}</td>
                            <td class="text-center">{{ $course->title  }}</td>
                            <td class="text-center"><a href="#">لیست نظرات</a></td>
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


