@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <p>All Posts:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', $post) }}">{{ !empty($post->user->profile) ? $post->user->profile->firstname:'' }}</a></li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
