@extends('home.home')

@section('main-content')
    @include('partials.back-button', ['path' => url('/')])
    <div class="row">
        <form action="{{ url('/group') }}" method="POST" class="py-2 col-lg-6">
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
    </div>
@endsection