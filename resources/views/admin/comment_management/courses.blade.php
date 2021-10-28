@extends('admin.include.master')
@section('page_title')
    مدیریت دیدگاه های دوره ها
@endsection
@section('main_content')
    <div class="container">

        <div class="row category-comments">
            <div class="col-lg-10 select-category-comment" style="border:1px solid red;height:100px">

                    <div class="form-group">
                        <label for="se_cat">یک دسته بندی انتخاب کنید.</label>
                        <select id="se_cat" class="select_category" name="select_category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
               

            </div>
        </div>


        <div class="row">


        </div>
    </div>
@endsection
@section('admin_scripts')

@endsection


