@component('mail::message')

@lang('users.emailIntro')

@lang('users.emailFullname'): {{ $firstname  }} {{ $lastname}} {{ $patname }}
@lang('users.emailId'): {{ $id }}
@lang('users.emailEmail'): {{ $email }}
@lang('users.emailRoles'):
@foreach($roles as $role)
    {{$role['name']}} @if (!$loop->last) , @endif
@endforeach

@lang('users.emailCity'): {{ $city }}

@lang('users.emailThanks'),<br>
{{ config('app.name') }}
@endcomponent
