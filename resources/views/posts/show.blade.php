@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Content: {{$post->content}}</li>
        <li>Image URL: <a href="{{$post->image}}">Post Image</a></li>
    </ul>
    <p>Commets:</p>
@endsection
