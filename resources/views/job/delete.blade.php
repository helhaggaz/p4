@extends('layouts.master')

@section('title')
    Delete book {{ $book->title }}
@endsection

@section('content')

    <h2>{{ $book['title'] }}</h2>
    <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>

    <p>By {{ $book['author'] }}</p>
    <p>Published in {{ $book['published'] }}</p>

    <form method='POST' action='/book/{{ $book->id }}'>

        {{ method_field('delete') }}

        {{ csrf_field() }}

        <input type='submit' value='Are you sure you want to delete this book?' class='btn btn-primary btn-small'>
    </form>

@endsection
