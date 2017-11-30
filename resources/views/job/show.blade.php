@extends('layouts.master')

@push('head')
    <link href='/css/book/show.css' rel='stylesheet'>
@endpush

@section('title')
    {{ $job->title }}
@endsection
@section('content')

    <h2>{{  $job->title }}</h2>
    <p>Description: {{ $job['description'] }}</p>
    <p>Category: {{ $job['name'] }}</p>
    <p>Require relocation: {{ $job['only_local'] }}</p>
    <p>Minimum experience: {{ $job['min_exp'] }} years</p>
    <p>Minimum experience: {{ $job['skills'] }}</p>
    <a href='/job/{{ $job['id'] }}'>View</a> |
    <a href='/job/{{ $job['id'] }}/edit'>Edit</a> |
    <a href='/job/{{ $job['id'] }}/delete'>Delete</a>


@endsection
