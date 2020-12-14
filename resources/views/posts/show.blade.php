@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
    <h2>{{ $post->user->name }} at {{ $post->created_at }}</h2>
    <h2>Title: {{$post->title}}</h2>
    <img src="{{ route('image.displayImage',$post->image_name) }}" alt="Post Image" title="Post Image">
    <p>Content: {{$post->content}}</p>
    @if ($post->updated_at > $post->created_at)
        <p>Changed: {{$post->updated_at}}</p>
    @endif

    <a href="{{ route('posts.index') }}">Back</a>

    @if($post->user->id == Auth::user()->id)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @elseif(Auth::user()->profile->profileable_type == App\Admin::class)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
        <form method="POST" action="{{ route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endif

    <h2>Comments:</h2>
    @php $comments = $post->comments @endphp
    @foreach ($comments as $comment)
        <b>{{$comment->user->name}} at {{$comment->created_at}}</b>
        <p>{{$comment->content}}</p>
    @endforeach
@endsection
