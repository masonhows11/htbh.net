@extends('admin.include.master')
@section('page_title')
    لیست نظرات
@endsection
@section('main_content')
    <div class="container">

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
                                            class="btn btn-success"
                                            id="approved_comment"
                                            data-comment-id="{{ $item->id }}"
                                            value="تایید دیدگاه">
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
        


    </script>
@endsection
