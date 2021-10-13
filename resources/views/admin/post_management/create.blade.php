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
                        <img src="" width="200" height="200"  class="img-thumbnail image-previewer" alt="post_image">
                    </div>
                    <div class="form-group">
                        <label for="">انتخاب تصویر:</label>
                        <input type="file" name="image" id="files">
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
    <script>
        $('#files').ijaboCropTool({
            preview : '.image-previewer',
            setRatio:1,
            allowedExtensions: ['jpg', 'jpeg','png'],
            buttonsText:['CROP','QUIT'],
            buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl:'{{ route("postImage") }}',
            withCSRF:['_token','{{ csrf_token() }}'],
            onSuccess:function(message,element, status){
                alert(message);

            },
            onError:function(message, element, status){
                alert(message);
            }
        });
    </script>
@endsection
