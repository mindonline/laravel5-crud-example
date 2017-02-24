@extends('layouts.master')

@if(!$user->id)
    @section('pageTitle', __('users.titleCreate') )
@else
    @section('pageTitle', __('users.titleEdit'))
@endif

@section('content')

    <h1>@if(!$user->id)  @lang('users.titleCreate') @else @lang('users.titleEdit') @endif</h1>

    <p class="lead">@lang("users.userEditDescription")</p>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
            @if($errors->any())
                @foreach($errors->getMessages() as $this_error)
                    <li>{{$this_error[0]}}</li>
                @endforeach
            @endif
            </ul>
        </div>
    @endif


    @if(!$user->id)
        {{ Form::model($user, ['action' => 'UserController@store']) }}
    @else
        {{ Form::model($user, ['method'=>'PATCH','action' => ['UserController@update',$user->id]]) }}
    @endif

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', old("email") , ['class' => 'form-control']) }}
    </div>


    @if(!$user->id)
        <div class="form-group">
            {{ Form::label('password', __("users.fieldPassword")) }}
            {{ Form::password('password',  ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_confirmation', __("users.fieldPasswordAgain")) }}
            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </div>
    @endif

    <div class="form-group">
        {{ Form::label('firstname', __("users.fieldFirstname")) }}
        {{ Form::text('firstname', old("firstname"), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('lastname', __("users.fieldLastname")) }}
        {{ Form::text('lastname', old("lastname"), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('patname', __("users.fieldPatname")) }}
        {{ Form::text('patname', old("patname"), ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('birthday', __("users.fieldBirthday")) }}
        {{ Form::text('birthday', $user->birthday, ['class' => 'form-control', 'placeholder'=>__('users.fieldBirthdayPlaceholder')]) }}
    </div>

    <div class="form-group">
        {{ Form::label('city', __("users.fieldCity")) }}
        {{ Form::select('city', $cities, $user->id ? $user->city->id : "" , ['class' => 'form-control', 'placeholder' => __("users.fieldCityPlaceholder")]) }}
    </div>

    <div class="form-group">
        <strong>@lang("users.fieldRoles")</strong>
        <ol>
        @foreach( $roles as $role)
            <li>
                <label>
                    {{ Form::checkbox('roles[]', $role->id, $user->id && $user->roles->contains('id', $role->id) ) }}
                    {{ $role->name }}
                </label>
            </li>
        @endforeach
        </ol>
    </div>

    {{ Form::submit(!$user->id ? __("users.btnCreateUser") : __("users.btnUpdateUser") , ['class'=>'btn btn-success']) }}

    {{ Form::close() }}


@stop