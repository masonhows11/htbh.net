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

        <div class="row admin-content-models">

            <div class="col-lg-6 col-md-6 col-xs-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if($role->name === 'admin')
                                @else
                                    <span>
                                 <a href="/admin/editRole?role={{ $role->id }}" class="text-info text-bold"><i class="fa fa-edit"></i></a>
                             </span>
                                    <span>
                                 <i class="fa fa-remove text-primary" data-role-id="{{ $role->id }}" id="deleteItem"></i>
                             </span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
