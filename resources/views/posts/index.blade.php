@extends('layouts.appcustom')

@section('title', 'Posts')

@section('content')
    <a href="{{ route('posts.create') }}">Create Post</a>
    <h1>All Posts:</h1>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', $post) }}">{{ $post->user->name }} posted at {{ $post->created_at }}</a></li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
