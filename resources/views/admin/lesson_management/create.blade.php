@extends('admin.include.master')
@section('page_title')
     ایجاد درس جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="page-header">
            <h3>دوره آموزشی : {{ $course->title }}</h3>
        </div>

        <div class="row hr-row">
        </div>

        <div class="row row-add-lesson">
            <form action="{{ route('storeNewLesson') }}" method="post" >
                @csrf
                <input type="hidden" id="course_id" name="id" value="{{ $course->id }}">
                <div class="form-group">
                    <label for="title">عنوان درس به فارسی:</label>
                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           value="{{ old('title') }}">

                </div>

                <div class="form-group">
                    <label for="name">نام درس به انگلیسی:</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           value="{{ old('name') }}">

                </div>

                <div class="form-group">
                    <label for="lesson_duration">مدت زمان ویدئو:</label>
                    <input type="text"
                           name="lesson_duration"
                           class="form-control @error('lesson_duration') is-invalid @enderror"
                           id="lesson_duration"
                           value="{{ old('lesson_duration') }}">

                </div>

                <div class="form-group">
                    <label for="video_path">لینک فایل آموزشی:</label>
                    <input type="text" class="form-control @error('video_path') is-invalid @enderror"
                           name="video_path">

                </div>

                <div class="flex">
                    <button type="submit" class="btn btn-success btn-save-lesson">ذخیره</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default btn-cancel-lesson">انصراف</a>

                </div>

            </form>
        </div>
        <div id="app" class="row list-course-lesson">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>مدت زمان ویدئو</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->lesson_duration }}</td>
                        <td>
                            <span><a href="/admin/course/editLesson?lesson={{ $lesson->id }}&course={{$course->id}}"><i class="fa fa-edit"></i></a></span>


                            <span class="fa fa-remove text-primary" data-lesson-id="{{ $lesson->id }}" id="deleteItem"></span>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
        <div class="row row-paginate">
            <div
                class="col-lg-3 col-lg-offset-4 col-md-3 col-md-offset-4 col-sm-4 col-sm-offset-5 col-xs-4 col-xs-offset-4">
                {{ $lessons->appends(['course'=>$course->id])->links() }}
            </div>
        </div>

    </div>
@endsection
@section('admin_scripts')
    <script>
        $(document).on('click', '#deleteItem', function (event) {
            event.preventDefault();
            let lesson_id = event.target.getAttribute('data-lesson-id');
            let course_id = document.getElementById('course_id').value;
            let course_element = event.target.parentElement.parentElement;
            swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('deleteLesson') }}',
                        data: {course_id:course_id, lesson_id:lesson_id},
                    }).done(function (data) {
                        if (data['status'] === 200) {
                            course_element.remove();
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
                    });
                }
            });
        });
    </script>
@endsection
