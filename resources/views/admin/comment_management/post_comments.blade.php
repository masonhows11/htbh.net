@extends('admin.include.master')
@section('page_title')
    لیست نظرات
@endsection
@section('main_content')
    <div class="container">

        <div class="row">

            <div class="form-group">
                <a href="{{ route('getPosts') }}" class="btn btn-default">بازگشت</a>
            </div>
        </div>
        <div class="row comments-wrapper">
            @foreach($comments as $comment)
                <div class="col-lg-10 course">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $comment->title }}</div>
                        <div class="panel-body">{{ strip_tags($comment->description) }}</div>
                    </div>
                </div>

                <div class="col-lg-10 list-comments">
                    @foreach($comment->comments as $item)
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ $item->user_name }}</div>
                            <div class="panel-body">{{ $item->description }}</div>
                            <div class="panel-footer">
                                <div class="form-inline">

                                    <div class="form-group">
                                        <button
                                            type="button"
                                            class="btn btn-default"
                                            id="approved_comment"
                                            data-comment-id="{{ $item->id }}">
                                            {{ $item->approved == 1 ? 'منتشر شده' : 'منتشر نشده' }}
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            id="delete_comment"
                                            data-comment-id="{{ $item->id }}">
                                            حذف دیدگاه
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="button"
                                            class="btn btn-primary"
                                            id="response_comment"
                                            data-comment-id="{{ $item->id }}"
                                            value="پاسخ دادن">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach


        </div>

    </div>
@endsection
@section('admin_scripts')
    <script type="text/javascript">

        $(document).on('click','#approved_comment',function (event) {
            event.preventDefault();
            let comment_id = event.target.getAttribute('data-comment-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url:'{{ route('approvedComment') }}',
                data: {post_id:comment_id},
            }).done(function (data) {
                console.log(data);
                if(data['status'] === 404){
                    swal.fire({
                        icon: 'info',
                        text: data['error'],
                    })
                }
                if(data['status'] === 200){
                    if(data['publish'] === 0){
                        event.target.innerText = 'منتشر نشده';
                    }
                    if(data['publish'] === 1){
                        event.target.innerText = 'منتشر شده';
                    }
                    swal.fire({
                        icon: 'success',
                        text: data['success'],
                    })
                }
                if (data['status'] === 500) {
                    swal.fire({
                        icon: 'error',
                        text: data['error'],
                    })
                }
            }).fail(function (data) {
                console.log(data);
                swal.fire({
                    icon: 'error',
                    text: data['error'],
                })
            })

        });

        $(document).on('click','#delete_comment',function (event) {
            event.preventDefault();
            let comment_id = event.target.getAttribute('data-comment-id');
            let comment_element =event.target.closest('.panel');
            swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                // confirmed scope start
                if (result.isConfirmed) {
                    // ajax scope start
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('deleteComment') }}',
                        data: {post_id:comment_id},
                    }).done(function (data) {
                      if (data['status'] === 404) {
                            swal.fire({
                                icon: 'warning',
                                text: data['warning'],
                            })
                        }
                        if (data['status'] === 200) {
                            comment_element.remove();
                            swal.fire({
                                icon: 'success',
                                text: data['success'],
                            })
                        }
                    }).fail(function (data) {
                        if (data['status'] === 500) {
                            swal.fire({
                                icon: 'error',
                                text: data['error'],
                            })
                        }
                    });// ajax scope end
                }// confirmed scope end
            });
        })


    </script>
@endsection

