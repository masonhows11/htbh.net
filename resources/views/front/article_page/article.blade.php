@extends('front.include.master_front')
@section('page_title')
    {{ $article->title}}
@endsection
@section('main_content')
    <div class="container">


        <div class="row d-flex justify-content-center">

            <!--  start course body  -->
            <div class="col-md-6">
                <div class="card post-section">
                    <input type="hidden" id="post_id" value="{{ $article->id }}">
                    <input type="hidden" id="token" value="{{ csrf_token() }}">
                    <img src="{{ asset('storage/article/'.$article->image) }}" class="card-img-top" alt="...">
                    <div class="card-header">
                        {{$article->title}}
                    </div>

                    <!-------------------- card-body ------------------------->

                    <div class="card-body">
                        <p class="card-text">{{ strip_tags($article->description) }}</p>
                    </div>

                    <!---------------------- card-footer ---------------------->

                    <div class="card-footer">
                        <div class="row d-flex flex-row justify-content-evenly">
                            <div class="col-6">
                                <div class="created_date">
                                    {{ jdate($article->created_at)->format('%d %B %Y') }}
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">

                                <div class="d-flex flex-row-reverse">
                                    <div class="dislike_sec">
                                        @if(Auth::check())
                                            @if( Auth::user()->likes()->where('post_id','=',$article->id) &&
                                                 Auth::user()->likes()->where('post_id','=',$article->id)->where('like','=',0)->first())
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
                                            @if( Auth::user()->likes()->where('post_id','=',$article->id) &&
                                                 Auth::user()->likes()->where('post_id','=',$article->id)->where('like','=',1)->first())
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
        </div>




        <!-- comment course section -->
        <div class="row d-flex justify-content-center align-content-center mt-5">
            <div class="col-lg-8">
                <div class="row d-flex flex-column justify-content-center comments-sec">

                    <div class="col-lg-12 mt-5 list-comments">
                        @foreach($article->comments as $comment)
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
                            {{--{{ route('commentStore') }}--}}
                            <form action="#">
                                @csrf
                                <input type="hidden" id="post_id" value="{{ $article->id }}">
                                <div class="mb-5">
                                    <label for="subject-body" class="form-label mt-5">متن دیدگاه</label>
                                    <textarea class="form-control @error('description') is_invalid @enderror"
                                              name="description" wrap="physical" id="description" rows="6" cols="6">
                                    </textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary" id="add_comment">ارسال
                                        دیدگاه
                                    </button>
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
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function () {
            function load_likes() {
                let post_id = document.getElementById('post_id').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'GET',
                    url: '{{ route('get_post_likes') }}',
                    data: {post_id:post_id},
                }).done(function (data) {
                    document.getElementById('like_count').innerText = data['likes'];
                    document.getElementById('dislike_count').innerText = data['dislikes'];
                });
            }
            $(window).on('load', function () {
                load_likes();
            })
            $('.like').on('click', function (event) {
                event.preventDefault();
                let like = document.getElementById('like');
                let dis_like = document.getElementById('dislike');
                let is_like = '';
                if (event.target.id === 'dislike') {
                    is_like = false;
                } else {
                    is_like = true;
                }
                let post_id = document.getElementById('post_id').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '{{ route('add_post_Like') }}',
                    data: {is_like: is_like,post_id:post_id},
                }).done(function (data) {
                    if (data['like'] == null) {
                        dis_like.style.color = '';
                        like.style.color = '';
                    } else if (data['like'] === 0) {
                        dis_like.style.color = 'tomato';
                        like.style.color = '';
                    } else if (data['like'] === 1) {
                        like.style.color = 'green';
                        dis_like.style.color = '';
                    }
                    load_likes();
                });
            });
        });

        $('#add_comment').on('click', function (event) {
            event.preventDefault();
            let description = document.getElementById('description').value;
            let post_id = document.getElementById('post_id').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '{{ route('commentStore') }}',
                data: {description: description, post_id:post_id},
            }).done(function (data) {
                if (data['status'] == 403) {
                    Swal.fire({
                        icon: 'info',
                        text: data['message']['description'],
                    })
                } else if (data['status'] == 200) {
                    document.getElementById('description').value = ''
                    Swal.fire({
                        icon: 'success',
                        text: data['message'],
                    })
                } else if (data['status'] == 500) {
                    Swal.fire({
                        icon: 'error',
                        text: data['message'],
                    })
                }
            }).fail(function (data) {
                Swal.fire({
                    icon: 'error',
                    text: data['message'],
                })
            })
        })
    </script>
@endsection

