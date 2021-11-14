@extends('front.include.master_front')
@section('page_title')
    {{  $lesson[0]->title }}
@endsection
@section('main_content')
    <div class="container ">


        <div class="row d-flex flex-column align-content-center justify-content-center front-lesson-detail">


            {{-- lesson and course info section--}}
            <div class="col-lg-8 col-md-8 col-xs-8 mb-2 lesson-info-section">
                <h1 class="h4" class="lesson-title">{{ $lesson[0]->title }}</h1>
                <p class="course-title">{{ $lesson[0]->course->title }}</p>
                <div class="lesson-info d-flex justify-content-start mt-2">
                    <div class="lesson-date bg-secondary rounded-3 text-center text-white ">زمان قرارگیری: {{  jdate($lesson[0]->created_at)->format('%d %B %Y')  }}</div>

                    <div class="lesson-duration bg-secondary rounded-3 ms-2 text-center text-white">  مدت زمان این قسمت : {{ date('i:s',strtotime($lesson[0]->lesson_duration)) }} دقیقه </div>
                </div>

            </div>

            {{-- video section --}}
            <div class="col-lg-8 col-md-8 col-xs-8 video-section mt-3">

                <video id="player" class="mt-3" playsinline controls>
                    <source src="#" type="video/ogg" size="480" />
                    <source src="#" type="video/ogg" size="720" />
                    <source src="#" type="video/ogg" size="1080" />

                {{--   <source src="/path/to/video.webm" type="video/webm" />--}}

                <!-- Captions are optional -->
                    {{-- <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default />--}}
                </video>

            </div>

            {{-- download link section --}}
            <div class="col-lg-8 col-md-8 col-xs-8 mt-2 d-flex align-items-center bg-gray-600  rounded-lg justify-content-center download-section">
                <div>
                    <a href="{{ $lesson[0]->video_path }}" class="btn btn-primary">دانلود فایل ویدئو</a>
                </div>
            </div>

        </div>

        <div class="row col-lg-8 col-md-8 mt-5 mb-5 mx-auto col-xs-8 lesson-empty-section">

        </div>


    </div>
@endsection
@section('custom_script')
    <script type="text/javascript">
        const player = new Plyr('#player');
    </script>
@endsection
