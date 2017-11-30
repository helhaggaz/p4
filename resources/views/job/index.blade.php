@extends('layouts.master')


@section('title')
    All jobs
@endsection

@section('content')

    <h1>Jobs</h1>

    @foreach($jobs as $job)
        <div class='job cf'>
            <h2>{{ $job['title'] }}</h2>
            <p>Description: {{ $job['description'] }}</p>
            <p>Category: {{ $job['name'] }}</p>
            <p>Require relocation: {{ $job['only_local'] }}</p>
            <p>Minimum experience: {{ $job['min_exp'] }} years</p>
            <p>Minimum experience: {{ $job['skills'] }}</p>
            <a href='/job/{{ $job['id'] }}'>View</a> |
            <a href='/job/{{ $job['id'] }}/edit'>Edit</a> |
            <a href='/job/{{ $job['id'] }}/delete'>Delete</a>
        </div>
    @endforeach

@endsection
