@extends('layouts.master')



@section('pageTitle',  __('users.titleList'))

@section('content')

<h1>@lang('users.userList')</h1>

<p class="lead">@lang('users.userListDescription')</p>

<div class="btn-group">
    <a href="{{action('UserController@create')}}" class="btn btn-primary">
        @lang('users.btnCreateUser')
    </a>
</div>

<hr>

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif






@if (count($users))

<table class="table table-bordered">
    <thead>
        <th>@lang('users.fieldEmail')</th>
        <th>@lang('users.fieldFirstname')</th>
        <th>@lang('users.fieldLastname')</th>
        <th>@lang('users.fieldPatname')</th>
        <th>@lang('users.fieldBirthday')</th>
        <th>@lang('users.fieldCity')</th>
        <th>@lang('users.fieldRoles')</th>
        <th>@lang('users.fieldActions')</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->firstname }}
                </td>
                <td>
                    {{ $user->lastname }}
                </td>
                <td>
                    {{ $user->patname }}
                </td>
                <td>
                    {{ $user->birthday }}
                </td>
                <td>
                    {{ $user->city->name }}
                </td>
                <td>
                    <ol>
                    @foreach ($user->roles as $role)
                        <li><span class="label label-default">{{$role->name}}</span></li>
                    @endforeach
                    </ol>
                </td>
                <td>

                        <a href="{{action('UserController@edit', [$user])}}" class="btn btn-info pull-left">@lang('users.btnEditUser')</a>

                        {{ Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user], "class"=>"pull-left"]) }}
                        {{ Form::submit(__('users.btnDeleteUser'), ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <h2>@lang("users.userListEmpty")</h2>
@endif

@stop