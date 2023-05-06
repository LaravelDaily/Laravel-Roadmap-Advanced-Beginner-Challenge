@component('mail::message')
    welcome to our newsletter

    @component('mail::button', ['url' => '/'])
       go to application home page
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
