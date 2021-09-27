@component('mail::message')
    <p style="text-align: right"> {{ $name }} کاربر گرامی  </p>
    @component('mail::button',['url'=>route('verifyEmail',$activation_code)])
        برای فعال سازی حساب کاربری خود کلیک کنید
    @endcomponent
    {{ config('app.name') }}
@endcomponent
