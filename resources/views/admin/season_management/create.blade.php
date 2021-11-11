@extends('admin.include.master')
@section('page_title')
    ایجاد فصل جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row  alert-section-season">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row season_wrapper">


            <div class="col-lg-8 col-md-8 col-xs-8 create_season">
                <h3 class="course-title-form">{{ $course[0]->title }}</h3>
                <form action="{{ route('storeSeason') }}" method="post">
                    @csrf
                    <input type="hidden" name="course" id="course_id" value="{{ $course[0]->id }}">
                    <div class="form-group">
                        <label for="season">عنوان فصل به فارسی</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="season">
                    </div>

                    <div class="form-group">
                        <label for="season">نام فصل به انگلیسی</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror text-left"
                            id="season">
                    </div>

                    <button type="submit" class="btn btn-success">ذخیره</button>
                    <a href="{{ route('courses') }}" class="btn btn-default">بازگشت</a>
                </form>
            </div>

            <div class="col-lg-8 col-md-8 col-xs-8 list-season">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($course as $item )
                        @foreach($item->seasons as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                    <span><a href="{{route('editSeason',['season'=>$value->id])}}"
                                             class="text-info text-bold"><i class="fa fa-edit"></i></a></span>
                                    <span><i class="fa fa-remove text-primary" data-season-id="{{ $value->id }}"
                                             id="deleteItem"></i></span>
                                </td>
                            </tr>
                        @endforeach
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
            let season_id = event.target.getAttribute('data-season-id');
            let course_id = document.getElementById('course_id').value;
            let season_element = event.target.closest('tr');
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
                        url: '{{ route('deleteSeason') }}',
                        data: {season:season_id,course:course_id},
                    }).done(function (data) {
                        console.log(data);
                   if (data['status'] === 200) {
                            season_element.remove();
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
                                text: 'عملیات حذف انجام نشد.',
                            })
                        }
                    });// ajax scope end
                }// confirmed scope end
            });
        });
    </script>
@endsection
