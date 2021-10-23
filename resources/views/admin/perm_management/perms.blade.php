
@extends('admin.include.master')
@section('page_title')
    مدیریت مجوزها
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
                <form action="{{ route('storeNewPerm') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="perm">نام مجوز</label>
                        <input type="text" name="name" class="form-control" id="perm">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6">
                <table class="table table-bordered users-table">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام مجوز</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($perms as $perm)
                        <tr>
                            <td>{{ $perm->id }}</td>
                            <td>{{ $perm->name }}</td>
                            <td>
                             <span><a href="/admin/editPerm?perm={{ $perm->id }}" class="text-info text-bold"><i
                                         class="fa fa-edit"></i></a></span>

                                <span><i class="fa fa-remove text-primary" data-perm-id="{{ $perm->id }}"
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
    <script>
        $(document).on('click', '#deleteItem', function (event) {
            event.preventDefault();
            let perm_id = event.target.getAttribute('data-perm-id');
            let perm_element = event.target.closest('tr');
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
                        url: '{{ route('deletePerm') }}',
                        data: {perm_id:perm_id},
                    }).done(function (data) {
                        if (data['status'] === 200) {
                            perm_element.remove();
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
