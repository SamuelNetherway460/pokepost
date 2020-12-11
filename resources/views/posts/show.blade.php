@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
    <ul>
        <li>Title: {{$post->title}}</li>
        <li>Content: {{$post->content}}</li>
        <li>Image URL: {{$post->image}}</li>
    </ul>
@endsection
