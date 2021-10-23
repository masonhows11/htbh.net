@include('front.include.header')
@include('front.include.nav-bar')
@include('front.include.category')
@include('front.include.hero')
@include('front.include.boxes')
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
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div class="writer"><i class="bi-person"></i> <span>{{ $article->user->name }}</span></div>
                            <div class="continue"><a href="#">ادامه...</a></div>
                        </div>

                    </div>
                </div>
                @endforeach




            </div>
        </div>

    </div>

    @include('front.include.road_map')
    @include('front.include.footer')
    @include('front.include.footer_scripts')
    
