@extends('front.include.master_front')
@section('page_title')
    خانه
@endsection
@section('main_content')
    <!---- latest course title ---->
    <div>
        <div class="container mt-5 latest-course-title">
            <div class="row">
                <div class="col-lg-2">
                    <h4 class="h4">آخرین دوره ها......</h4>
                </div>
            </div>
        </div>
    </div>

    <!---- latest course content ---->

    <div class="p-5 latest-course">

        <div class="container">

            <div class="row rows-cols-1 row-cols-md-4 rows-col-lg-4 g-4">


                @foreach($courses as $course)
                <div class="col-lg">
                    <div class="card">
                        <img src="{{ asset('storage/course/'.$course->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>
                @endforeach


               {{-- <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>--}}


            </div>
        </div>


    </div>

    <!---- most visited-course title ---->
    <div>
        <div class="container mt-5 most-visited-title">
            <div class="row">
                <div class="col-lg-2">
                    <h4 class="h4">پربازدیدترین ها......</h4>
                </div>
            </div>
        </div>
    </div>

    <!----most-visited-course content ---->

    <div class="p-5 most-visited-course">
        <div class="container">
            <div class="row rows-cols-1 row-cols-md-4 rows-col-lg-4 g-4">

                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">300.000</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">250.000</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان دوره</h5>
                            <div class="teacher mt-2"> مدرس : <span>mason</span></div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="paid-status"><a href="#">رایگان</a></div>
                            <div class="continue-link"><a href="#">ادامه....</a></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>


    <!---- article-title ---->
    <div>
        <div class="container mt-5 article-title">
            <div class="row">
                <div class="col-lg-2">
                    <h4 class="h4">آخرین مقالات......</h4>
                </div>
            </div>
        </div>
    </div>

    <!----latest-article content ---->

    <div class="p-5 article-content">
        <div class="container">
            <div class="row rows-cols-1 row-cols-md-4 rows-col-lg-4 g-4">

                @foreach($articles as $article)
                <div class="col-lg">
                    <div class="card h-100">
                        <img src="{{ asset('storage/article/'.$article->image) }}" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ strip_tags($article->description) }}</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div class="writer"><i class="bi-person"></i> <span>mason</span></div>
                            <div class="continue"><a href="#">ادامه...</a></div>
                        </div>

                    </div>
                </div>
                @endforeach

              {{--  <div class="col-lg">
                    <div class="card h-100">
                        <img src="{{ asset('images/image-course-test.jpg') }}" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان مقاله</h5>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                طراحان گرافیک است.</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div class="writer"><i class="bi-person"></i> <span>mason</span></div>
                            <div class="continue"><a href="#">ادامه...</a></div>
                        </div>

                    </div>
                </div>

                <div class="col-lg">
                    <div class="card h-100">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان مقاله</h5>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                طراحان گرافیک است.</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div class="writer"><i class="bi-person"></i> <span>mason</span></div>
                            <div class="continue"><a href="#">ادامه...</a></div>
                        </div>

                    </div>
                </div>

                <div class="col-lg">
                    <div class="card h-100">
                        <img src="images/image-course-test.jpg" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">عنوان مقاله</h5>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                طراحان گرافیک است.</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div class="writer"><i class="bi-person"></i> <span>mason</span></div>
                            <div class="continue"><a href="#">ادامه...</a></div>
                        </div>

                    </div>
                </div>--}}


            </div>
        </div>

    </div>

@endsection
