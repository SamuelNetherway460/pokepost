@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <p>All Posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', $post) }}">{{ $post->user->profile->firstname }} {{ $post->user->profile->lastname }} posted at {{ $post->created_at }}</a></li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
