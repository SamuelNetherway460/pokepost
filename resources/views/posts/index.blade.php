@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <p>All Posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
@endsection
