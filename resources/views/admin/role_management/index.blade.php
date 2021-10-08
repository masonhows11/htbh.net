@extends('admin.include.master')
@section('page_title')
    مدیریت نقش ها
@endsection
@section('main_content')
    <div class="container">

        @foreach($roles as $role)
            <p>{{ $role }}</p>
        @endforeach
    </div>
@endsection
@section('admin_scripts')
@endsection
