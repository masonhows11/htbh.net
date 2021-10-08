@extends('admin.include.master')
@section('page_title')
    مدیریت کاربران
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
                        <span><a href="/admin/edit?user={{ $user->id }}" class="text-info text-bold"><i
                                    class="fa fa-edit"></i></a></span>
                                @if($user->hasRole('admin'))
                                @else
                                    <span><i class="fa fa-remove text-primary" data-user-id="{{ $user->id }}"
                                             id="deleteItem"></i></span>
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
            let user_id = event.target.getAttribute('data-user-id');
            let user_element = event.target.closest('tr');
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
                        url: '{{ route('deleteUser') }}',
                        data: {user_id: user_id},
                    }).done(function (data) {
                        if (data['status'] === 200) {
                            user_element.remove();
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
