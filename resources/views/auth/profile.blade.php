@extends('layouts.app')

@section('content')
    <div class="container bg-white p-4 rounded">
        <h4 class="text-muted">个人设置</h4>
        <div class="row justify-content-between mt-4">
            <div class="col-lg-6 col-md-12">
                <form action="{{ url('/profile') }}" method="POST" id="profile-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('用户名') }}</label>
                        @include('form.text', ['name' => 'name', 'value' => $user->name])
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('邮箱') }}</label>
                        @include('form.text', ['name' => 'email', 'value' => $user->email])
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('密码') }}</label>
                        @include('form.password', ['name' => 'user_password', 'placeholder' => '请输入密码进行身份验证'])
                    </div>

                    <div class="form-group">
                        <label for="create-at">注册时间</label>
                        <span class="ml-2 text-muted">{{ $user->created_at }}</span>
                    </div>

                    <div class="pl-2">
                        <button class="btn btn-primary">提 交</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 col-md-12">
                <form action="{{ url('/profile_pwd') }}" method="POST" id="password-form">
                    @csrf
                    <div class="form-group">
                        <label for="password">{{ __('旧密码') }}</label>
                        @include('form.password', ['name' => 'password'])
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">{{ __('确认密码') }}</label>
                        @include('form.password', ['name' => 'password_confirmation'])
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{ __('新密码') }}</label>
                        @include('form.password', ['name' => 'new_password'])
                    </div>

                    <div class="pl-2">
                        <button class="btn btn-primary">修改密码</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
