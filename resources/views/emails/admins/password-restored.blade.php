@component('mail::message')
# Introduction

Your password restored.
Your password is: {{ $password }}.

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
