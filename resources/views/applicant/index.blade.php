@extends('layouts.master')


@section('title')
    All applicants
@endsection

@section('content')

    <h1>Applicants</h1>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Applicant Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Experience Years</th>
                    <th scope="col">Skills</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applicants as $applicant)
                    <tr>
                        <th scope="row">{{ $applicant['last_name'].', '.$applicant['first_name'] }}</th>
                        <td>{{ $applicant['email'] }}</td>
                        <td>{{ $applicant['experience'] }}</td>
                        <td>
                          @for($x=0;$x<count($applicant['skills']);$x++)
                            <ul>{{$applicant['skills'][$x]['name'] }}</ul>
                            @endfor
                          </td>
                        <td>
                            <a href='/applicant/matchingjobs/{{ $applicant['id'] }}'>List Matching Jobs</a> |
                            <a href='/applicant/{{ $applicant['id'] }}'>View</a> |
                            <a href='/applicant/{{ $applicant['id'] }}/edit'>Edit</a> |
                            <a href='/applicant/{{ $applicant['id'] }}/delete'>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
