@component('mail::message')
    <p style="text-align: right"> {{ $name }} کاربر گرامی  </p>
    @component('mail::button',['url'=>route('confirmEditEmail',[$id,$code])])
        برای تایید ایمیل کاربری خود کلیک کنید.
    @endcomponent
    {{ config('app.name') }}
@endcomponent

