@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            @include('home.content-menu')
        </div>
        <div class="col-lg-9 bg-white">
            @yield('main-content')
        </div>
    </div>
</div>
@endsection
