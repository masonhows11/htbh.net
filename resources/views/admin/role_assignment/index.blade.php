@extends('admin.include.master')
@section('page_title')
    تخصیص نقش ها
@endsection
@section('main_content')
    <div class="container">


        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models">

            <div class="col-lg-6 col-md-6 col-xs-6">
                <table class="table table-bordered users-table">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th>تخصیص</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="/admin/roleAssign/assignRoleForm?user={{ $user->id }}" class="btn btn-primary">تخصیص</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
