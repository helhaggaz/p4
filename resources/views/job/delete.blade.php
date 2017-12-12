@extends('layouts.master')



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
        <form method='POST' action='/job/{{ $job->id }}'>

            {{ method_field('delete') }}

            {{ csrf_field() }}

            <input type='submit' value='Are you sure you want to delete this job?' class='btn btn-primary btn-small'>
            <input type="button" value='Cancel' class='btn btn-primary btn-small' onclick="history.back();" />
        </form>
    </div>

@endsection
