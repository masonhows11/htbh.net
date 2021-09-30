@component('mail::message')
    <p style="text-align: right"> {{ $name }} کاربر گرامی  </p>
    @component('mail::button',['url'=>route('verifyEmail',[$id,$code])])
        برای تغییر رمز عبور خود کلیک کنید
    @endcomponent
    {{ config('app.name') }}
@endcomponent
