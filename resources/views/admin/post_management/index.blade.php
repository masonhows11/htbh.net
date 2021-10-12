@extends('admin.include.master')
@section('page_title')
    مقالات
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row category-article">

            <ul class="nav nav-tabs nav-justified">
                @if(!$parent_categories->isEmpty())
                    @foreach($parent_categories as $cat)
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle category-item" data-toggle="dropdown" href="#">
                                {{ $cat->title }}
                                <span class="caret"></span></a>
                            @if(count($cat->child))
                                <ul class="dropdown-menu">
                                 @include('admin.post_management.child',['child'=>$cat->child])
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="row admin-content-models">
            <div class="col-lg-6 col-md-6 col-xs-6 article-section">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
