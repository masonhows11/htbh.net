@extends('admin.include.master')
@section('page_title')
    ویرایش دوره
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-course">
            <div class="col-lg-8 col-md-8">

                <form action="{{ route('updateCourse') }}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="form-group">
                        <label for="title">عنوان دوره به فارسی:</label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ $course->title  }}"
                               id="title">
                    </div>

                    <div class="form-group">
                        <label for="name">نام  دوره به انگلیسی:</label>
                        <input type="text"
                               name="name"
                               value="{{ $course->name }}"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name">
                    </div>


                    <div class="form-group">
                        <label for="description">توضیحات:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="editor-text" rows="5"
                                  name="description">
                            {{ $course->description }}
                       </textarea>
                    </div>


                    <div class="form-group category-chosen">
                        <label for="category">انتخاب دسته بندی :</label>
                        <select name="category[]"
                                data-placeholder="دسته بندی های مورد نظر را انتخاب کنید.."
                                id="category"
                                multiple
                                class="form-control chosen-select @error('category') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id,$course->categories()->pluck('category_id')->toArray())?'selected':'' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level_course">سطح دوره:</label>
                        <select type="text" class="form-control @error('level_course') is-invalid @enderror"
                                name="level_course" value="{{ old('level_course') }}" id="level_course">
                            <option value="0">سطح دوره را انتخاب کنید..</option>
                            <option value="1" {{ ($course->level_course == 1) ? 'selected':'' }}>مقدماتی</option>
                            <option value="2" {{ ($course->level_course == 2) ? 'selected':'' }}>متوسط</option>
                            <option value="3" {{ ($course->level_course == 3) ? 'selected':'' }}>  پیشرفته</option>
                            <option value="4" {{ ($course->level_course == 4) ? 'selected':'' }}>حرفه ای</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="paid">نوع پرداخت:</label>
                        <select class="form-control  @error('status_paid') is-invalid @enderror"
                                name="status_paid"
                                id="paid">
                            <option value="0">نوع پرداخت راانتخاب کنید...</option>
                            <option value="1" {{ ($course->status_paid == 1) ? 'selected':'' }}>رایگان</option>
                            <option value="2" {{ ($course->status_paid == 2) ? 'selected':'' }}>خریدنی</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="price">قیمت دوره:</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                               name="price" value="{{ $course->price != null ? $course->price : ''  }}" id="price">
                    </div>

                    <div class="input-group">
                        <input type="text"
                               id="image_label"
                               class="form-control @error('image') is-invalid @enderror"
                               name="image"
                               value="{{ $course->image }}"
                               aria-label="Image" aria-describedby="button-image">
                        <div class="input-group-btn">
                            <button class="btn btn-default"
                                    type="button"
                                    id="button-image">انتخاب تصویر
                            </button>
                        </div>
                    </div>


                    <div class="form-group btn-save-model">
                        <button type="submit" class="btn btn-success">ذخیره</button>
                        <a href="/admin/course/index" class="btn btn-default">انصراف</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });
        // set file link
        function fmSetLink($url) {
            document.getElementById('image_label').value = $url;
        }
        $(".chosen-select").chosen({disable_search_threshold: 10,rtl:true});
    </script>
    <script type="text/javascript" src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor-text', {
            language: 'fa',
            removePlugins: 'image',
        });
    </script>
    <script>
        $(document).ready(function () {
            let paid = document.getElementById('paid');
            let price = document.getElementById('price');
            $(window).on('load',function () {
                let value = $('#paid option:selected').val();
                if(value == 1)
                {
                    price.disabled = true;
                }
                if(value == 2)
                {
                    price.disabled = false;
                }
            });
            paid.addEventListener("change",function (event) {
                if(event.target.value == 1)
                {
                    price.disabled = true;
                }

                if(event.target.value == 2){
                    price.disabled = false;
                }
            })
        });
    </script>
@endsection
