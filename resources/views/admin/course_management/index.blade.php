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

        @if(count($courses) == 0)
            <p class="text-center">دوره ای برای نمایش وجود ندارد.</p>
        @else
            <div class="row admin-content-models list-course-content">

                <div class="col-lg-8 col-md-8 col-xs-8 course-section">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">نام دوره</th>
                            <th class="text-center">مشخصات دوره</th>
                            <th class="text-center">وضعیت انتشار</th>
                            <th class="text-center">ایجاد قسمت جدید</th>
                            <th class="text-center">عملیات</th>

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

                                <td>
                                    <span><a href="/admin/course/edit?course={{ $course->id }}" class="text-info text-bold"><i class="fa fa-edit"></i></a></span>
                                    <span><i class="fa fa-remove text-primary" data-course-id="{{ $course->id }}" id="deleteItem"></i></span>
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
        @endif


    </div>
@endsection
@section('admin_scripts')
    <script>
        $(document).on('click', '#deleteItem', function (event) {
            event.preventDefault();
            let post_id = event.target.getAttribute('data-post-id');
            let post_element = event.target.closest('tr');
            swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                // confirmed scope start
                if (result.isConfirmed) {
                    // ajax scope start
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('deleteArticle') }}',
                        data: {post_id: post_id},
                    }).done(function (data) {
                        if (data['status'] === 200) {
                            post_element.remove();
                            swal.fire({
                                icon: 'success',
                                text: data['success'],
                            })
                        }
                        if (data['status'] === 404) {
                            swal.fire({
                                icon: 'warning',
                                text: data['warning'],
                            })
                        }
                    }).fail(function (data) {
                        if (data['status'] === 500) {
                            swal.fire({
                                icon: 'error',
                                text: data['error'],
                            })
                        }
                    });// ajax scope end
                }// confirmed scope end
            });
        });
    </script>
    <script>
        $(document).on('click', '#approvePost', function (event) {
            event.preventDefault();
            let post_id = event.target.getAttribute('data-post-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '{{ route('approveArticle') }}',
                data: {post_id: post_id},
            }).done(function (data) {
                console.log(data);
                if (data['status'] === 200) {
                    if (data['publish'] == 0) {
                        event.target.innerText = 'منتشر نشده';
                    }
                    if (data['publish'] == 1) {
                        event.target.innerText = 'منتشر شده';
                    }
                    swal.fire({
                        icon: 'success',
                        text: data['success'],
                    })
                }
                if (data['status'] === 500) {
                    swal.fire({
                        icon: 'error',
                        text: data['error'],
                    })
                }
            }).fail(function (data) {
                console.log(data);
            });
        });
    </script>
@endsection
