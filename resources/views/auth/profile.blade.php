@extends('front.include.master_auth')
@section('page_title')
    پروفایل کاربری
@endsection
@section('main_content')
    <div class="container">

        {{--<div class="container">--}}

            <div class="row mt-2 d-flex justify-content-center">

                <div class="col-lg-6 alert-wrapper">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <p class="text-center">{{ session('success')  }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            <p class="text-center">{{ session('error')  }}</p>
                        </div>
                    @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
            </div>
       {{-- </div>--}}

        <div class="row user-profile">

            <div class="col-md-3  border-right user-avatar">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="mt-2 img-rounded image-previewer"
                         src="{{  $user->avatar == '' ? asset('images/users/no-user.png')  : asset('images/users/'.$user->avatar)  }}"
                         id="profile-image"
                         width="280px"
                         height="240px"
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

            <div class="col-md-5 border-right user-info">
                <div class="p-3 py-5">
                    <form action="{{ route('updateProfile') }}" method="post">
                        @csrf
                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="labels first-name">نام</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels last-name">نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mt-2">
                                <label class="labels user-name">نام کاربری</label>
                                <input type="text" name="name" class="form-control" placeholder=""
                                       value="{{ $user->name }}">
                            </div>

                            <div class="col-md-12 mt-3 user-email-body">
                                <label class="labels user-email">ایمیل</label>
                                <p class="mt-3 user-email-text text-left">{{ $user->email }}</p>
                            </div>
                            <input type="hidden" name="email" value="{{ $user->email }}">
                        </div>
                      {{--  <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                              <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                        </div>--}}

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">ویرایش پروفایل</button>
                            <a href="/editEmailForm?user={{$user->email}}" class="btn btn-primary profile-button" type="button">تغییر آدرس ایمیل</a>
                        </div>
                    </form>
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
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route("imageStore") }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function (message, element, status) {
                alert(message);
            },
            onError: function (message, element, status) {
                alert(message);
            }
        });

    </script>

@endsection

