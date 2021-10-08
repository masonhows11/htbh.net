@extends('admin.include.master')
@section('page_title')
    مدیریت نقش ها
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
                <form action="{{ route('storeNewRole') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="role">نام نقش</label>
                        <input type="text" name="name" class="form-control" id="role">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6">
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
@section('admin_scripts')
    <script>
        $(document).on('click', '#deleteItem', function (event) {
            event.preventDefault();
            let role_id = event.target.getAttribute('data-role-id');
            let role_element = event.target.closest('tr');
            swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                // confirmed scope start
                if (result.isConfirmed) {
                    // ajax scope start
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('deleteRole') }}',
                        data: {role_id: role_id},
                    }).done(function (data) {
                        if (data['status'] === 200) {
                            role_element.remove();
                            swal.fire({
                                icon: 'success',
                                text: data['success'],
                            })
                        }
                        if (data['status'] === 404) {
                            swal.fire({
                                icon: 'warning',
                                text: data['warning'],
                            })
                        }
                    }).fail(function (data) {
                        if (data['status'] === 500) {
                            swal.fire({
                                icon: 'error',
                                text: data['error'],
                            })
                        }
                    });
                    // ajax scope end
                }
                // confirmed scope end
            });
        });
    </script>
@endsection
