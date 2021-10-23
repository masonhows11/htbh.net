@extends('admin.include.master')
@section('page_title')
    تخصیص مجوز
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

                <form action="/admin/permAssign/assignPerm" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">

                    <div class="form-group">
                        <label for="role">نام نقش</label>
                        <input type="text" class="form-control" value="{{ $role->name }}" readonly id="role">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="3" class="text-center">نام نقش</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($perms as $perm)
                                <td>
                                    <label for="" class="checkbox-inline">
                                        <input type="checkbox"
                                               name="perms[]"
                                               class=""
                                               value="{{ $perm->id }}"
                                            {{ in_array( $perm->id,$role->getPermissionIds()->toArray()) ? 'checked' : '' }} >
                                        {{ $perm->name }}
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">ذخیره نقش ها</button>
                    <a href="{{ route('listRoles') }}" class="btn btn-default">انصراف</a>
                </form>

            </div>
        </div>

    </div>
@endsection

