@extends('project.project-interface')

@section('interface-api-content')
    <div class="bg-white px-2">
        <div class="container-fluid ">
            <div class="row justify-content-between align-content-center py-2">
                <div>{{ $current_module->name }}共(12)个接口</div>
                <a href="{{ $current_module->getUrl('create-api') }}" class="btn btn-sm btn-primary">添加接口</a>
            </div>
        </div>
    </div>
@endsection
