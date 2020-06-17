@extends('project.project-interface')

@section('interface-api-content')
    <div class="bg-white p-2">
        @include('apis.api-form', ['current_module' => $current_module])
    </div>
@endsection
