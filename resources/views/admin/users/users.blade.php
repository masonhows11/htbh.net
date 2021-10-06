@extends('admin.include.master')
@section('page_title')
    پنل کاربران
@endsection
@section('main_content')
    <div class="container">

        <table class="table table-bordered users-table">
            <thead>
            <tr>
                <th>شناسه</th>
                <th>نام کاربری</th>
                <th>ایمیل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span><a href="#" class="text-primary text-bold"><i class="fa fa-remove"></i></a></span>
                    <span><a href="#" class="text-info text-bold"><i class="fa fa-edit"></i></a></span>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection
