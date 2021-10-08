@extends('admin.include.master')
@section('page_title')
    تخصیص نقش
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

                <form action="/admin/roleAssign/assignRole" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="form-group">
                        <label for="user">نام کاربری</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly id="user">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="3" class="text-center">نام نقش</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($roles as $role)
                                <td>
                                    <label for="" class="checkbox-inline">
                                        <input type="checkbox"
                                               name="roles[]"
                                               class=""
                                               value="{{ $role->id }}"
                                            {{ in_array( $role->id,$user->getRoleIds()->toArray()) ? 'checked' : '' }} >
                                        {{ $role->name }}
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">ذخیره نقش ها</button>
                    <a href="{{ route('listUsers') }}" class="btn btn-default">انصراف</a>
                </form>

            </div>
        </div>

    </div>
@endsection
