@extends('layouts.app')
@section('content')
    @include('project.project-nav', ['project' => $project])

    @yield('project-content')

@endsection

