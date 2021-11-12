@extends('front.include.master_front')
@section('page_title')

@endsection
@section('main_content')
    <div class="container ">


        <div class="row d-flex flex-column align-content-center justify-content-center front-lesson-detail">



            <div class="col-lg-8 col-md-8 col-xs-8 mb-2 video-section">
                <h1 class="h4" class="lesson-title">{{ $lesson[0]->title }}</h1>
                <p class="course-title">{{ $lesson[0]->course->title }}</p>
                <div class="lesson-info d-flex justify-content-start mt-2">
                    <div class="lesson-date bg-secondary rounded-3 text-center ">زمان قرارگیری: {{  jdate($lesson[0]->created_at)->format('%d %B %Y')  }}</div>

                    <div class="lesson-duration bg-secondary rounded-3 ms-2 text-center">  مدت زمان این قسمت : {{ date('i:s',strtotime($lesson[0]->lesson_duration)) }} دقیقه </div>
                </div>

            </div>


            <div class="col-lg-8 col-md-8 col-xs-8 video-section" style="border:2px solid tomato;height:600px">

            </div>

            <div class="col-lg-8 col-md-8 col-xs-8 mt-2 download-section" style="border:2px solid tomato;height:100px">

            </div>

        </div>

        <div class="row col-lg-8 col-md-8 mt-5 mb-5 mx-auto col-xs-8" style="border:2px solid tomato;height: 200px">

        </div>


    </div>
@endsection
