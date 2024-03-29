@extends('admin.include.master')
@section('page_title')
    مقاله جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row post-alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 post-alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-post">
            <div class="col-lg-8 col-md-8">

                <form action="{{ route('storeNewArticle') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="title">عنوان مقاله به فارسی :</label>
                        <input type="text" name="title"  class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">نام مقاله به انگلیسی :</label>
                        <input type="text" name="name" class="form-control text-left @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                    </div>


                    <div class="form-group">
                        <button class="btn btn-default" type="button" id="button-image">انتخاب عکس</button>
                    </div>
                    <div class="form-group">
                        <input type="text"
                               id="image_label"
                               class="form-control @error('image') is-invalid @enderror"
                               value="{{ old('image') }}"
                               name="image"
                               aria-label="Image"
                               aria-describedby="button-image"
                               readonly>
                    </div>


                    <div class="form-group">
                        <label for="">توضیحات:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="editor-text"
                                  name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">ذخیره</button>
                        <a href="{{ route('articles') }}" class="btn btn-default">انصراف</a>
                    </div>



                </form>

            </div>
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script type="text/javascript" src="{{ asset('dash/ckeditor/ckeditor.js') }}"></script>
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
@endsection
