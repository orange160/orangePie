@extends('home.home')

@section('main-content')
    <div class="col-lg-6 ">
        <h5 class="py-2 border-bottom">创建分组</h5>
        <form action="{{ url('/group') }}" method="POST" class="py-2 border-bottom mb-3">
            @csrf
            <div class="form-group">
                <label for="name">分组名称</label>
                @include('form.text', ['name' => 'name'])
            </div>

            <div class="form-group">
                <label for="introduction">分组简介</label>
                @include('form.textarea', ['name' => 'introduction'])
            </div>

            <div class="pl-2">
                <button class="btn btn-primary mr-4">保存</button>
            </div>
        </form>
        @include('partials.back-button', ['path' => url('/')])

    </div>
@endsection