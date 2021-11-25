@component('mail::message')
    <p style="text-align: right"> {{ $name }} کاربر گرامی  </p>
    @component('mail::button',['url'=>route('verifyEmail',[$id,$code])])
        برای فعال سازی حساب کاربری خود کلیک کنید
    @endcomponent
    <p>لینک فعال سازی رو در آدرس بار مرورگر خود بچسبانید</p>
    <p>{{route('verifyEmail',[$id,$code])}}</p>
    {{ config('app.name') }}
@endcomponent

{{--route('verifyEmail',[$id,$code])--}}

