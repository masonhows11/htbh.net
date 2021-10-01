@extends('front.include.master_auth')
@section('page_title')
    پروفایل کاربری
@endsection
@section('main_content')
    <div class="container">

        <div class="row user-profile">

            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="mt-5 img-thumbnail image-previewer"
                         src=""
                         id="profile-image"
                         alt="image_user">
                    <div class="form-group p-3">
                        <label for="">یک عکس انتخاب کنید...</label>
                        <input type="file" name="avatar" id="avatar" value="">
                    </div>
                   {{-- <span class="font-weight-bold mt-2">
                        <button type="button" id="submit_image" class="btn btn-primary profile-button">آپلود عکس</button>
                    </span>--}}
                </div>
            </div>

            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-center h4">تنظیمات پروفایل</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels first-name">نام</label>
                            <input type="text" class="form-control"  value="">
                        </div>
                        <div class="col-md-6">
                            <label class="labels last-name">نام خانوادگی</label>
                            <input type="text" class="form-control" value="" >
                        </div>
                    </div>
                    <div class="row mt-3">

                        <div class="col-md-12 mt-2">
                            <label class="labels user-name">نام کاربری</label>
                            <input type="text" class="form-control" placeholder="" value="{{ $user->name }}">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="labels user-email">ایمیل</label>
                            <input type="text" class="form-control" placeholder="" value="{{ $user->email }}">
                        </div>

                    </div>
                    <div class="row mt-3">
                      {{--  <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                        <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>--}}
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">ذخیره پروفایل</button></div>
                </div>
            </div>

           {{-- <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                    <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>--}}
        </div>

    </div>
@endsection
@section('custom_script')
    <script type="text/javascript">

        $('#avatar').ijaboCropTool({
            preview : '.image-previewer',
            setRatio:1,
            allowedExtensions: ['jpg', 'jpeg','png'],
            buttonsText:['CROP','QUIT'],
            buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl:'{{ route("imageStore") }}',
            withCSRF:['_token','{{ csrf_token() }}'],
            onSuccess:function(message, element, status){
                alert(message);
            },
            onError:function(message, element, status){
                alert(message);
            }
        });

    </script>

@endsection

