@extends('admin.include.master')
@section('page_title')
    لیست نظرات
@endsection
@section('main_content')
    <div class="container">

        <div class="row">

            <div class="form-group">
                <a href="{{ route('getCourses') }}" class="btn btn-default">بازگشت</a>
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
                                        <input
                                            type="button"
                                            class="btn btn-default"
                                            id="approved_comment"
                                            data-comment-id="{{ $item->id }}"
                                            value="تایید نشده">
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="button"
                                            class="btn btn-danger"
                                            id="delete_comment"
                                            data-comment-id="{{ $item->id }}"
                                            value="حذف دیدگاه">
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
                data: {comment_id:comment_id},
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                console.log(data);
            })

        });

        $(document).on('click','#delete_comment',function (event) {
            event.preventDefault();
            let comment_id = event.target.getAttribute('data-comment-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'GET',
                url:'{{ route('deleteComment') }}',
                data: {comment_id:comment_id},
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                console.log(data);
            })
        })


    </script>
@endsection
