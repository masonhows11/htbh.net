@extends('admin.include.master')
@section('page_title')
     مدیریت کاربران
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
                <div class="col-lg-6 alert-box" style="border: 1px solid red">

                </div>
        </div>
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
                    <span><a href="/admin/edit?user={{ $user->id }}" class="text-info text-bold"><i class="fa fa-edit"></i></a></span>
                    <span><i class="fa fa-remove text-primary" data-user-id="{{ $user->id }}" id="deleteItem"></i></span>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('admin_scripts')

@endsection
