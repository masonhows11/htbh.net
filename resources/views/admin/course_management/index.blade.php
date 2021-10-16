@extends('admin.include.master')
@section('page_title')
    لیست دوره های آموزشی
@endsection
@section('main_content')
<div class="container">

    <div class="row alert-section">
        <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
            @include('admin.include.alert')
        </div>
    </div>

    <div class="row category-dropdown-article">
        <div class="col-lg-6 col-md-6">
            <form action="{{route('listPostCategory')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="cat-dropdown">انتخاب یک دسته بندی :</label>
                    <select class="form-control input-sm" name="category" id="cat-dropdown">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="دریافت مقالات">
                </div>
            </form>
        </div>
    </div>

    <div class="row add-course-button">
        <a href="#" class="btn btn-success">ایجاد دوره جدید</a>
    </div>

    @isset($post)
        <div class="row admin-content-models list-post-content" >


            <div class="col-lg-8 col-md-8 col-xs-8 article-section" >
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td><span data-post-id="{{ $post->id }}" class="btn btn-default"
                                      id="approvePost">{{ $post->approved == 1 ? 'منتشر شده':'منتشر نشده' }}</span></td>
                            <td>
                            <span>
                                <a href="/admin/article/edit?post={{ $post->id }}" class="text-info text-bold"><i
                                        class="fa fa-edit"></i></a>
                            </span>
                                <span>
                                <i class="fa fa-remove text-primary" data-post-id="{{ $post->id }}" id="deleteItem"></i>
                            </span>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="paginate-sec">
                {{ $posts->onEachSide(3)->links() }}
            </div>

        </div>
    @else
        <p class="text-center">مقاله ای برای نمایش وجود ندارد.</p>
    @endisset



</div>
@endsection
