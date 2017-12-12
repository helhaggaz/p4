@extends('layouts.master')


@section('title')
    All jobs
@endsection

@section('content')

    <h1>Jobs</h1>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Job Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Minimum Experience Years</th>
                    <th scope="col">Required Skills</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <th scope="row">{{ $job['title'] }}</th>
                        <td>{{ $job['description'] }}</td>
                        <td>{{ $job['min_exp'] }}</td>
                        <td>
                          @for($x=0;$x<count($job['skills']);$x++)
                            <ul>{{$job['skills'][$x]['name'] }}</ul>
                            @endfor
                          </td>
                        <td>
                            <a href='/job/matchingapplicants/{{ $job['id'] }}'>List Matching Applicants</a> |
                            <a href='/job/{{ $job['id'] }}'>View</a> |
                            <a href='/job/{{ $job['id'] }}/edit'>Edit</a> |
                            <a href='/job/{{ $job['id'] }}/delete'>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
