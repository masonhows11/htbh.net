@extends('admin.include.master')
@section('page_title')
    مدیریت نقش ها
@endsection
@section('main_content')
    <div class="container">


        <div class="row alert-section">
            <div class="col-lg-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models">

            <div class="col-lg-6">
                <form action="#" method="post">

                    <div class="form-group">
                        <label for="role">نام نقش</label>
                        <input type="text" name="name" class="form-control" id="role">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>
            </div>

            <div class="col-lg-6">
                <table class="table table-bordered users-table">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام نقش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                        <span><a href="#={{ $role->id }}" class="text-info text-bold"><i
                                    class="fa fa-edit"></i></a></span>

                                <span><i class="fa fa-remove text-primary" data-user-id="{{ $role->id }}"
                                         id="deleteItem"></i></span>

                            </td>
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
