@extends('layouts.app')

@section('content')
    <div class="container bg-white">
        <h5 class="p-2 border-bottom">{{ $group->name }}</h5>

        <form action="{{ $group->getUrl() . '/' . 'create-project' }}" method="POST" class="mb-3 pb-3 border-bottom">
            @csrf
            <div class="form-group">
                <label for="name">项目名称</label>
                @include('form.text', ['name' => 'name'])
            </div>
            <div class="form-group">
                <label for="introduction">项目介绍</label>
                @include('form.textarea', ['name' => 'introduction'])
            </div>

            <div class="pl-2">
                <button class="btn btn-primary">{{ __('common.save') }}</button>
            </div>
        </form>
        @include('partials.back-button', ['path' => url($group->getUrl()) ])
        
    </div>
@endsection