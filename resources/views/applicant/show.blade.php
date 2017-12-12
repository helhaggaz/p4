@extends('layouts.master')

@section('title')
    {{ $applicant['last_name'].', '.$applicant['first_name'] }}
@endsection
@section('content')
    <div class="container">
        <h2>{{ $applicant['last_name'].', '.$applicant['first_name'] }}</h2>
        <br>
        <p><h4>Relocation:</h4>{{ $localOrRelocatable }}</p>
        <p><h4>Experience:</h4> {{ $experience }}</p>
        <p><h4>Skills:</h4>
          @for($x=0;$x<count($applicant['skills']);$x++)
            <ul>{{$applicant['skills'][$x]['name'] }}</ul>
            @endfor
        </p>
        <p><h4>Address:</h4> {{ $applicant['address_line_1'] }}</p>
        <p><h4>        </h4> {{ $applicant['city'].', '.$applicant['state'].' '.$applicant['zip'] }}</p>
        <p><h4>phone:</h4> {{ $applicant['phone'] }}</p>
        <p><h4>Email:</h4> {{ $applicant['email'] }}</p>
        <a href='/applicant'>Go back to Applicants list</a> |
        <a href='/applicant/{{ $applicant['id'] }}/edit'>Edit</a> |
        <a href='/applicant/{{ $applicant['id'] }}/delete'>Delete</a>
    </div>

@endsection
