@extends('layouts.master')

@section('title')
    {{ $job->title }}
@endsection
@section('content')
    <div class="container">
        <h2>{{  $job->title }}</h2>
        <br>
        <p><h4>Description:</h4> {{ $job['description'] }}</p>
        <p><h4>Category:</h4> {{ $job['category'] }}</p>
        <p><h4>Require relocation:</h4> {{ $requireRelocation }}</p>
        <p><h4>Minimum experience:</h4> {{ $minmumExperience }}</p>
        <p><h4>Required Skills:</h4>
          @for($x=0;$x<count($job['skills']);$x++)
            <ul>{{$job['skills'][$x]['name'] }}</ul>
            @endfor
        </p>
        <a href='/job'>Go back to Jobs list</a> |
        <a href='/job/{{ $job['id'] }}/edit'>Edit</a> |
        <a href='/job/{{ $job['id'] }}/delete'>Delete</a>
    </div>

@endsection
