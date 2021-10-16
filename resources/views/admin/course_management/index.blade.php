@extends('admin.include.master')
@section('page_title')
    لیست دوره های آموزشی
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
            <form action="{{--{{route('listCourseCategory')}}--}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="cat-dropdown">انتخاب یک دسته بندی :</label>
                    <select class="form-control input-sm" name="category" id="cat-dropdown">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="دریافت دوره ها">
                </div>
            </form>
        </div>
    </div>

    <div class="row add-course-button">
        <a href="{{ route('newCourse') }}" class="btn btn-success">ایجاد دوره جدید</a>
    </div>

    @isset($courses)
        <div class="row admin-content-models list-course-content" >

            <div class="col-lg-8 col-md-8 col-xs-8 course-section">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">نام دوره</th>
                        <th class="text-center">مشخصات دوره</th>
                        <th class="text-center">وضعیت انتشار</th>
                        <th class="text-center">ایجاد قسمت جدید</th>
                        <th class="text-center">ویرایش</th>
                        <th class="text-center">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="text-center">{{ $course->id }}</td>
                            <td class="text-center">{{ $course->title }}</td>
                            <td class="text-center"><a href="/admin/course/detail?course={{$course->id}}"><i class="fa fa-list-alt"></i></a></td>
                            <td class="text-center"><button data-course-id="{{$course->id}}" id="publish_course">{{ $course->status_publish == 1 ? 'منتشر شده': 'منتشر نشده' }}</button></td>
                            <td class="text-center"><a href="/admin/course/newLesson?course={{ $course->id }}"><i class="fa fa-save"></i></a></td>
                            <td class="text-center"><a href="/admin/course/edit?course={{$course->id}}"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center"><button  data-course-id="{{ $course->id }}" class="fa fa-remove" id="deleteItem"></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="paginate-sec">
                {{ $courses->onEachSide(3)->links() }}
            </div>

        </div>
    @else
        <p class="text-center">n,vi ای برای نمایش وجود ندارد.</p>
    @endisset



</div>
@endsection
