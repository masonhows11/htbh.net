@extends('admin.include.master')
@section('page_title')
    مقاله جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-post">
            <div class="col-lg-6 col-md-6">

                <form action="{{ route('storeNewArticle') }}" method="post">
                @csrf

                </form>

            </div>
        </div>
    </div>
@endsection
