@extends('project.show')

@section('project-content')

    <div class="container-fluid mt-3">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                @include('project.interface-api.interface-menu', ['project' => $project])
            </div>
            <div class="col-lg-9">
                @include('project.interface-api.interface-api-list')
            </div>
        </div>
    </div>

@endsection