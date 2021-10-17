@extends('admin.include.master')
@section('page_title')
    مشخصات دوره آموزشی
@endsection
@section('main_content')
    <div class="container">

        <div class="row page-header-course-details">
            <div class="page-header">
                <h3>دوره:</h3>
                <h2>{{ $course->title }}</h2>
            </div>
        </div>

        <div class="row course-details">

            <div class="col-lg-6 flex flex-column" style="">

                <div class="">
                    <label for="title">عنوان دوره:</label>
                    <input type="text"
                           id="title"
                           class="form-control"
                           value="{{ $course->title }}"
                           readonly>
                </div>
                <div class="">
                    <label for="description">توضیحات:</label>
                    <textarea id="description"
                              class="form-control details-textarea"
                              rows="7"
                              cols="5"
                              readonly>
                                    {{ strip_tags($course->description) }}
                         </textarea>
                </div>
                <div class="course-banner-detail">
                    <label for="image">بنر دوره:</label>
                    <img src="{{ asset($course->image) }}" id="image" class="img-rounded img-responsive"
                         alt="course-banner">
                </div>

            </div>
            <div class="col-lg-6 flex flex-column" style="">
                <div class="">
                    <label for="student_count">تعداد دانشجویان:</label>
                    <input type="text"
                           id="student_count"
                           class="form-control"
                           value="{{ $course->student_count }}"
                           readonly>
                </div>
                <div class="">
                    <label for="video_count">تعداد قسمت های دوره:</label>
                    <input type="text"
                           id="video_count"
                           class="form-control"
                           @isset($lessons_count)
                           value="{{ $lessons_count }}"
                           @endisset

                           readonly>
                </div>
                <div class="">
                    <label for="course_duration">مدت زمان دوره:</label>
                    <input type="text"
                           id="course_duration"
                           class="form-control"
                           @isset($course_time)
                           value="{{ $course_time }}"
                           @endisset

                           readonly>
                </div>
                <div>
                    <label for="status_paid">نوع پرداخت:</label>
                    <input type="text"
                           id="status_paid"
                           class="form-control"
                           value="{{ $course->status_paid == 1 ? 'رایگان' : 'نقدی' }}"
                           readonly>
                </div>
                @if( $course->status_paid == 2)
                    <div class="">
                        <label for="price">قیمت دوره:</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $course->price }}"
                               id="price"
                               readonly>
                    </div>
                @endif
                @if( $course->status_paid == 2)
                    <div>
                        <label for="Discount">تخفیف:</label>
                        <input type="text"
                               id="Discount"
                               class="form-control"
                               value="{{ $course->discount }}"
                               readonly>
                    </div>
                @endif
                <div>
                    <label for="views">تعداد بازدید:</label>
                    <input type="text"
                           id="views"
                           class="form-control"
                           value="{{ $course->views }}"
                           readonly>
                </div>
                <div>
                    <label for="level_course">سطح دوره:</label>
                    <input type="text"
                           id="level_course"
                           class="form-control"
                           value=""
                           readonly>
                </div>

                <div>
                    <label for="status_publish">وضعیت انتشار:</label>
                    <input type="text"
                           id="status_publish"
                           class="form-control"
                           value="{{ $course->status_publish == 0 ? 'منشر شده': 'منتشر نشده' }}"
                           readonly>
                </div>

                <div>
                    <label for="last_update">آخرین بروزرسانی:</label>
                    <input type="text"
                           id="last_update"
                           @if(isset($last_update))
                           value="{{ $last_update  }}"
                           @else
                           value=" "
                           @endif
                           class="form-control" readonly>
                </div>
                <a href="/admin/course/index" class="btn btn-default btn-return">بازگشت</a>
            </div>

        </div>

    </div>
@endsection
