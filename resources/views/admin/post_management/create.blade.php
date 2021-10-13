@extends('admin.include.master')
@section('page_title')
    مقاله جدید
@endsection
@section('main_content')
    <div class="container">

        <div class="row alert-section">
            <div class="col-lg-6 col-md-6 col-xs-6 alert-box">
                @include('admin.include.alert')
            </div>
        </div>

        <div class="row admin-content-models admin-add-post">
            <div class="col-lg-8 col-md-8">

                <form action="{{ route('storeNewArticle') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="title">عنوان مقاله به فارسی :</label>
                        <input type="text" name="title"  class="form-control" id="title">
                    </div>

                    <div class="form-group">
                        <label for="name">نام مقاله به انگلیسی :</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>


                    <div class="form-group">
                        <button class="btn btn-default" type="button" id="button-image">انتخاب عکس</button>
                    </div>
                    <div class="form-group">
                        <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image">
                    </div>

                    <div class="form-group">

                    </div>


                    <div class="form-group">
                        <label for="">توضیحات:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="editor-text"
                                  name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">ذخیره</button>
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
    </script>
@endsection
