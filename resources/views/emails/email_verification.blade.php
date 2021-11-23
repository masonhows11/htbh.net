@component('mail::message')
    <p style="text-align: right"> {{ $name }} کاربر گرامی  </p>
    @component('mail::button',['url'=>route('htbh.edu'.'verifyEmail',[$id,$code])])
        برای فعال سازی حساب کاربری خود کلیک کنید
    @endcomponent
    {{ config('app.name') }}
@endcomponent
