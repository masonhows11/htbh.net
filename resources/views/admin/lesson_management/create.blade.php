@extends('admin.include.master')
@section('page_title')
     ایجاد جلسه جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row  alert-section-lesson">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>

        </div>

        @foreach($course as $item)
        <div class="course-title">
            <h3>دوره آموزشی : {{ $item->title }}</h3>
        </div>

        <div class="row row-add-lesson">

            <div class="col-lg-6 col-md-6 col-xs-6">
                <form action="{{ route('storeNewLesson') }}" method="post" >
                    @csrf
                    <input type="hidden" id="course_id" name="id" value="{{ $item->id }}">

                    <div class="form-group">
                        <label for="select_season">فصل:</label>
                        <select class="form-control  @error('season') is-invalid @enderror" name="season" id="select_season">
                            <option></option>
                            @foreach($item->seasons as $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>

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
                               class="form-control @error('name') is-invalid @enderror text-left"
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
                        <label for="buy_able">نوع پرداخت:</label>
                        <select class="form-control  @error('buy_able') is-invalid @enderror" name="buy_able" id="buy_able">
                            <option></option>
                            <option value="0">رایگان</option>
                            <option value="1">نقدی</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="video_path">لینک فایل آموزشی:</label>
                        <input type="text" class="form-control @error('video_path') is-invalid @enderror"
                               name="video_path">
                    </div>

                    <div class="flex">
                        <button type="submit" class="btn btn-success btn-save-lesson">ذخیره</button>
                        <a href="{{route('courses') }}" class="btn btn-default btn-cancel-lesson">انصراف</a>
                    </div>

                </form>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6 list-lessons" style="border:1px solid red">

            </div>

        </div>
        @endforeach



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
                        data: {course_id:course_id,lesson_id:lesson_id},
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
                                text: 'عملیات حذف انجام نشد.',
                            })
                        }
                    });
                }
            });
        });
    </script>
@endsection
