@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <p>All Posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li>{{$post->title}}</li>
        @endforeach
    </ul>
@endsection
