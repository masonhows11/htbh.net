@extends('admin.include.master')
@section('page_title')
   ویرایش درس
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>



        <div class="row hr-row">
        </div>

        <div class="row row-add-lesson">
            <form action="{{ route('updateLesson') }}" method="post" >
                @csrf
                <input type="hidden"  name="lesson_id" value="{{ $lesson->id }}">
                <input type="hidden"  name="course_id" value="{{ $course_id }}">
                <div class="form-group">
                    <label for="title">عنوان درس به فارسی:</label>
                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           value="{{ $lesson->title }}">

                </div>

                <div class="form-group">
                    <label for="name">نام  در به انگلیسی:</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           value="{{ $lesson->name }}">

                </div>

                <div class="form-group">
                    <label for="lesson_duration">مدت زمان ویدئو:</label>
                    <input type="text"
                           name="lesson_duration"
                           class="form-control @error('lesson_duration') is-invalid @enderror"
                           id="lesson_duration"
                           value="{{ $lesson->lesson_duration }}">

                </div>


                <div class="form-group">
                    <label for="video_path">لینک فایل آموزشی:</label>
                    <input type="text" value="{{ $lesson->video_path }}" class="form-control @error('video_path') is-invalid @enderror"
                           name="video_path">

                </div>

                <div class="flex">
                    <button type="submit" class="btn btn-success btn-save-lesson">ذخیره</button>
                    <a href="{{ route('newLesson') }}" class="btn btn-default btn-cancel-lesson">انصراف</a>
                </div>

            </form>
        </div>


    </div>
@endsection
