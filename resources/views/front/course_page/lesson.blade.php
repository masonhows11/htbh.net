@extends('front.include.master_front')
@section('page_title')

@endsection
@section('main_content')
    <div class="container ">

        @foreach($lesson as $item)
        <div class="row d-flex flex-column align-content-center justify-content-center front-lesson-detail">


            <div class="col-lg-8 col-md-8 col-xs-8 mb-2 video-section" style="border:2px solid tomato;height:100px">
                <p>{{ $ }}</p>
                <p></p>
                <div>
                    <span></span>
                    <span></span>
                </div>

            </div>

            <div class="col-lg-8 col-md-8 col-xs-8 video-section" style="border:2px solid tomato;height:600px">

            </div>

            <div class="col-lg-8 col-md-8 col-xs-8 mt-2 download-section" style="border:2px solid tomato;height:100px">

            </div>

        </div>

        <div class="row col-lg-8 col-md-8 mt-5 mb-5 mx-auto col-xs-8" style="border:2px solid tomato;height: 200px">

        </div>
        @endforeach

    </div>
@endsection
