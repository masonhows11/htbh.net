@extends('front.include.master_front')
@section('page_title')
   {{ $course[0]->title}}
@endsection
@section('main_content')
    <div class="container">


        <div class="row">

                <!--  start course body  -->
                <div class="col-md-6">
                    <div class="card">
                        <input type="hidden" id="course_id" value="{{ $course[0]->id }}">
                        <input type="hidden" id="token" value="{{ csrf_token() }}">
                        <img src="{{ asset('storage/course/'.$course[0]->image) }}" class="card-img-top" alt="...">
                        <div class="card-header">
                            {{$course[0]->title}}
                        </div>
                        <!--  card-body                       -->
                        <div class="card-body">
                            <p class="card-text">{{ strip_tags($course[0]->description) }}</p>
                        </div>
                        <!-- card-footer                       -->
                        <div class="card-footer">
                            <div class="row d-flex flex-row justify-content-evenly">
                                <div class="col-6">
                                    <div class="created_date">
                                        {{ jdate($course[0]->created_at)->format('%d %B %Y') }}
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">

                                    <div class="d-flex flex-row-reverse">
                                        <div class="dislike_sec">
                                            @if(Auth::check())
                                                @if( Auth::user()->likes()->where('course_id','=',$course[0]->id) &&
                                                     Auth::user()->likes()->where('course_id','=',$course[0]->id)->where('like','=',0)->first())
                                                    <span id="dislike_count" class="dislike_count"></span>
                                                    <i class="far fa-thumbs-down like" style="color:tomato"
                                                       id="dislike"></i>
                                                @else
                                                    <span id="dislike_count" class="dislike_count"></span>
                                                    <i class="far fa-thumbs-down like" id="dislike"></i>
                                                @endif
                                            @else
                                                <span id="dislike_count" class="dislike_count"></span>
                                                <i class="far fa-thumbs-down like_un_auth" id="dislike"></i>
                                            @endif
                                        </div>
                                        <div class="like_sec mx-2">
                                            @if(Auth::check())
                                                @if( Auth::user()->likes()->where('course_id','=',$course[0]->id) &&
                                                     Auth::user()->likes()->where('course_id','=',$course[0]->id)->where('like','=',1)->first())
                                                    <span id="like_count" class="like_count"></span>
                                                    <i class="far fa-thumbs-up like" style="color:green" id="like"></i>
                                                @else
                                                    <span id="like_count" class="like_count"></span>
                                                    <i class="far fa-thumbs-up like" id="like"></i>
                                                @endif
                                            @else
                                                <span id="like_count" class="like_count"></span>
                                                <i class="far fa-thumbs-up like_un_auth" id="like"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end course body -->

                <!--  start course properties and add by user     -->
                <div class="col-md-3 mt-2 course-detail">
                    <div class="row d-flex flex-column align-content-center">
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> {{ $course[0]->title }}</p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> مدرس : {{ $course[0]->user->name }} </p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> تعداد دانشجویان : {{ $course[0]->student_count }}</p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> تعداد ویدئو ها : {{ $course[0]->video_count }} </p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> سطح دوره : {{ $course[0]->level_course }}</p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> مدت زمان دوره : {{ $course[0]->course_duration }} </p>
                        </div>
                        <div class="col-lg-10 mt-2">
                            <p class="text-center mt-2"> وضعیت دوره
                                : {{ $course[0]->course_status == 1 ? 'در حال برگزاری' : 'پایان دوره' }} </p>
                        </div>
                        <div class="col-lg-10 d-flex justify-content-center align-content-center mt-2">
                            <div class="d-flex flex-column mt-2 mb-2">
                                @if(\App\Models\CourseUser::checkAddOrNot(\Illuminate\Support\Facades\Auth::id(),$course[0]->id))
                                    <p class="course-added w3-flat-turquoise">شما در این دوره ثبت نام کرده اید.</p>
                                @else
                                    @if($course[0]->status_paid == 1 )
                                        <form action="/addCourse/add" method="post">
                                            @csrf
                                            <div class="mb-2 btn btn-danger add-course">
                                                <input type="hidden" name="course_id" value="{{ $course[0]->id }}">
                                                <input type="submit" class="btn btn-danger" value="ثبت نام رایگان در دوره"
                                                       id="price">
                                            </div>
                                        </form>
                                    @elseif($course[0]->status_paid == 2)
                                        <form action="#" method="post">
                                            <div class="mb-2"><p class="price "> {{ number_format($course[0]->price) }} تومان </p>
                                            </div>
                                            <div class="mb-2"><a href="#" class="btn btn-danger" id="price">خرید دروه</a></div>
                                        </form>
                                    @endif

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!--  end course properties and add by user   -->
        </div>


        <!-- course lessons section -->
        <div class="row d-flex flex-column align-content-center mt-5 course-lessons">
            @foreach($course[0]->lessons as $lesson)
            <div class="col-md-6 mt-2 mb-2" style="">
                <p class="text-center">
                    <a  class="btn btn-primary"
                        data-bs-toggle="collapse"
                        href="#collapseExample{{$lesson->id}}"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseExample">
                        {{ $lesson->title }}
                    </a>
                </p>
                <div class="collapse"
                     id="collapseExample{{$lesson->id}}">
                    <div class="card card-body">
                        <a class="text-center" href="{{ $lesson->video_path }}">{{$lesson->video_path}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- end course lessons section -->

        <!-- comment course section -->
        <div class="row d-flex justify-content-center align-content-center mt-5">
            <div class="col-lg-8">
                <div class="row d-flex flex-column justify-content-center comments-sec">

                    <div class="col-lg-12 mt-5 list-comments">
                        @foreach($course[0]->comments as $comment)
                            <div class="card mt-5">
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $comment->description }}
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div><span class="users_comment">{{ $comment->user_name }}</span></div>
                                    <div><span
                                            class="date_comment">{{ jdate($comment->created_at)->format('%d %B %Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(Auth::check())
                        <div class="col-lg-12 mt-5 mb-5 rounded-3 add-comment">

                            <form action="/comment/store" method="post">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course[0]->id }}">
                                <div class="mb-5">
                                    <label for="subject-body" class="form-label mt-5">متن دیدگاه</label>
                                    <textarea class="form-control @error('description') is_invalid @enderror"
                                              name="description" wrap="physical" id="subject-body" rows="6" cols="6">
                            </textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-outline-primary">ارسال دیدگاه</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="col-lg-9 mt-5 mb-5  message_auth">
                            <p class="text-center">کاربر گرامی برای ثبت دیدگاه خود ابتدا <a href="/loginForm"
                                                                                            class="text-center">وارد</a>
                                سایت شوید با تشکر.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--end comment course section -->


    </div>
@endsection
