@extends('layouts.app')

@section('content')
<h1>{{ $project->name }}</h1>
<h1>{{ $project->slug }}</h1>
<h1>{{ $project->introduction }}</h1>
<h1>{{ $project->created_at }}</h1>
<h1>{{ $project->updated_at }}</h1>
@endsection

