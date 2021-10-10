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
                <form action="{{ route('storeNewCategory') }}" class="category-form" method="post">
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
                              <h5 class="parent well well-sm">{{ $cat->title }}</h5>
                               @if($cat->parent_id != null )
                                   <a href="/admin/category/edit?cat={{ $cat->id }}" class="label label-info">ویرایش</a>
                                   <a href="/admin/category/delete?cat={{ $cat->id }}" id="deleteItem" class="label label-danger">حذف</a>
                                   <a href="/admin/category/detachParent?cat={{ $cat->id  }}" class="label label-warning">حذف از والد </a>
                               @else
                                   <a href="/admin/category/edit?cat={{ $cat->id }}" class="label label-info ">ویرایش</a>
                                   <a href="/admin/category/delete?cat={{ $cat->id }}"  class="label label-danger">حذف</a>
                               @endif

                               @if (count($cat->child))
                                   @include('admin.category_management.child',
                                      ['child'=>$cat->child])
                               @endif
                           </li>
                        @endforeach
                    @else
                        <div class="alert alert-danger no-categories">
                            <p class="text-center ">دسته بندی وجود ندارد</p>
                        </div>

                    @endif
                </ul>
            </div>
        </div>


    </div>
@endsection
