@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
    <h2>{{ $post->user->profile->firstname }} {{ $post->user->profile->lastname }} at {{ $post->created_at }}</h2>
    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Content: {{$post->content}}</li>
        <li>Image URL: <a href="{{$post->image}}">Post Image</a></li>
        @if ($post->updated_at > $post->created_at)
            <li>Changed: {{$post->updated_at}}</li>
        @endif
    </ul>
    <h2>Comments:</h2>
    @php $comments = $post->comments @endphp
    @foreach ($comments as $comment)
        <b>{{$comment->user->profile->firstname}} {{$comment->user->profile->lastname}} at {{$comment->created_at}}</b>
        <p>{{$comment->content}}</p>
    @endforeach
@endsection
