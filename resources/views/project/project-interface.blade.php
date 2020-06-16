@extends('project.show')

@section('project-content')

    <div class="container-fluid mt-3">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                @include('project.interface-api.interface-menu', ['project' => $project, 'modules' => $modules])
            </div>
            <div class="col-lg-9">
                @yield('interface-api-content')
            </div>
        </div>
    </div>

@endsection