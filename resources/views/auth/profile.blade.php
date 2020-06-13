@extends('layouts.app')

@section('content')
    <div class="container bg-white p-4 rounded">
        <div class="row justify-content-between">
            <div class="col-lg-6 col-md-12">
                <h4 class="text-muted pb-2 border-bottom">{{ __('common.profile_menu') }}</h4>
                <form action="{{ url('/profile') }}" method="POST" id="profile-form" class="mt-2">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('auth.username') }}</label>
                        @include('form.text', ['name' => 'name', 'value' => $user->name])
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('auth.email') }}</label>
                        @include('form.text', ['name' => 'email', 'value' => $user->email])
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('auth.password') }}</label>
                        @include('form.password', ['name' => 'user_password', 'placeholder' => '请输入密码进行身份验证' ])
                    </div>

                    <div class="form-group">
                        <label for="create-at">{{ __('auth.register_time') }}:</label>
                        <span class="ml-2 text-muted">{{ $user->created_at }}</span>
                    </div>

                    <div class="pl-2">
                        <button class="btn btn-primary">{{ __('common.save') }}</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-12">
                <h4 class="text-muted pb-2 border-bottom">{{ __('auth.password') }}</h4>
                <form action="{{ url('/profile_pwd') }}" method="POST" id="password-form" class="mt-2">
                    @csrf
                    <div class="form-group">
                        <label for="password">{{ __('auth.password') }}</label>
                        @include('form.password', ['name' => 'password'])
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">{{ __('auth.password_confirm') }}</label>
                        @include('form.password', ['name' => 'password_confirmation'])
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{ __('auth.password_new') }}</label>
                        @include('form.password', ['name' => 'new_password'])
                    </div>

                    <div class="pl-2">
                        <button class="btn btn-primary">{{ __('common.save') }}</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
