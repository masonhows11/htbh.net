@extends('admin.include.master')
@section('page_title')
    مدیریت دسته بندی ها
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
                <form action="{{ route('storeNewCategory') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">عنوان دسته بندی به فارسی</label>
                        <input type="text"
                               name="title"
                               class="form-control  @error('title') is-invalid @enderror"
                               id="title"
                               value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">نام دسته بندی به انگلیسی</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="parent">انتخاب دسته بندی والد</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value=""></option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title}}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-success">ذخیره</button>
                </form>
            </div>

        </div>
        <div class="row category-content-section">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <ul class="list-group">
                    @if(!$parent_categories->isEmpty())
                        @foreach($parent_categories as $cat)
                           <li>
                              <h5 class="parent ">{{ $cat->title }}</h5>
                               @if($cat->parent_id != null )
                                   <a href="/admin/category/edit?cat={{ $cat->id }}" class="label label-info">ویرایش</a>
                                   <a href="/admin/category/delete?cat={{ $cat->id }}" class="label label-danger">حذف</a>
                                   <a href="/admin/category/detachParent?cat={{ $cat->id  }}"
                                      class="label label-warning">حذف از والد </a>
                               @else
                                   <a href="/admin/category/edit?cat={{ $cat->id }}" class="label label-info ">ویرایش</a>
                                   <a href="/admin/category/delete?cat={{ $cat->id }}" class="label label-danger">حذف</a>
                               @endif

                               @if (count($cat->child))
                                   @include('admin.category_management.child',
                                      ['child'=>$cat->child])
                               @endif
                           </li>
                        @endforeach
                    @else
                        <p>دسته بندی وجود ندارد</p>
                    @endif
                </ul>
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

