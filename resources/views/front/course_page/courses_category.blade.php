@extends('front.include.master_front')
@section('page_title')
@endsection
@section('main_content')
    <div class="p-5 latest-course">
        <div class="container">
            <div class="row rows-cols-1 row-cols-md-4 rows-col-lg-4 g-4">




                @foreach($courses as $course)
                    <div class="col-lg">
                        <div class="card">
                            <img src="{{ asset('storage/course/'.$course->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <div class="teacher mt-2"> مدرس : <span>{{ $course->user->name}}</span></div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <div class="paid-status"><a href="#">{{ $course->status_paid == 1 ? 'رایگان' : number_format($course->price) . '     تومان' }}</a></div>
                                <div class="continue-link"><a href="{{route('course',[$course->slug])}}">ادامه....</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
