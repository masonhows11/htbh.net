@extends('admin.include.master')
@section('page_title')
    ایجاد دوره آموزشی جدید
@endsection
@section('main_content')
    <div class="container">


        <div class="row course-create-alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 course-create-alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-course">
            <div class="col-lg-8 col-md-8">

                <form action="{{ route('storeNewCourse') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="title">عنوان دوره به فارسی:</label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               id="title">
                    </div>

                    <div class="form-group">
                        <label for="name">نام  دوره به انگلیسی:</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control text-left @error('name') is-invalid @enderror"
                               id="name">
                    </div>


                    <div class="form-group">
                        <label for="description">توضیحات:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="editor-text" rows="5"
                                  name="description">
                            {{ old('description') }}
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
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level_course">سطح دوره:</label>
                        <select type="text" class="form-control @error('level_course') is-invalid @enderror"
                               name="level_course" value="{{ old('level_course') }}" id="level_course">
                            <option value=""></option>
                            <option value="1">مقدماتی</option>
                            <option value="2">متوسط</option>
                            <option value="3">پیشرفته</option>
                            <option value="4">حرفه ای</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="paid">نوع پرداخت:</label>
                        <select class="form-control  @error('status_paid') is-invalid @enderror"
                                name="status_paid"
                                id="paid">
                            <option value="0">نوع پرداخت راانتخاب کنید...</option>
                            <option value="1">رایگان</option>
                            <option value="2">خریدنی</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="price">قیمت دوره:</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                               name="price" value="{{ old('price') }}" id="price">
                    </div>

                    <div class="input-group">
                        <input type="text"
                               id="image_label"
                               class="form-control @error('image') is-invalid @enderror"
                               name="image"
                               value="{{ old('image') }}"
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
    <script type="text/javascript" src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor-text', {
            language: 'fa',
            removePlugins: 'image',
        });
    </script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
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
    <script>
        $(document).ready(function () {

            let paid = document.getElementById('paid');
            let price = document.getElementById('price');
            paid.addEventListener("change",function (event) {
                if(event.target.value == 1)
                {
                    price.disabled = true;
                }

                if(event.target.value == 2){
                    price.disabled = false;
                }
            })

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

        });
    </script>
@endsection
