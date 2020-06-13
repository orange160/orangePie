@extends('home.home')

@section('main-content')
    <div class="col-lg-8 pb-4">
        <h5 class="py-2 border-bottom">{{ __('group.create_group') }}</h5>
        <form action="{{ url('/group') }}" method="POST" class="py-2 border-bottom mb-3">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('common.name') }}</label>
                @include('form.text', ['name' => 'name'])
            </div>

            <div class="form-group">
                <label for="introduction">{{ __('common.description') }}</label>
                @include('form.textarea', ['name' => 'introduction'])
            </div>

            <div class="pl-2">
                <button class="btn btn-primary mr-4">{{ __('common.save') }}</button>
            </div>
        </form>
        @include('partials.back-button', ['path' => url('/')])

    </div>
@endsection