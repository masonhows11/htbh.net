@component('mail::message')


    @component('mail::button',['url'=>route('',)])
        برای فعال سازی حساب کاربری خود کلیک کنید.
    @endcomponent


    {{ config('app.name') }}
@endcomponent
