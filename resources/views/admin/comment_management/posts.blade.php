@extends('admin.include.master')
@section('page_title')
مدیریت دیدگاه های مقالات
@endsection
@section('main_content')
<div class="container">
        <div class="row posts-section">

            <div class="col-lg-10 list-courses" id="list_courses">

                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">نام دوره</th>
                        <th class="text-center">لیست نظرات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="text-center">{{ $post->id }}</td>
                            <td class="text-center">{{ $post->title  }}</td>
                            <td class="text-center"><a href="{{ route('getPostComments',['post'=>$post->id]) }}">لیست نظرات</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
</div>
@endsection
@section('admin_scripts')
@endsection
