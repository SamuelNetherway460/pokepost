@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex text-muted pt-3">
            <div>
                <h4 class="d-block">{{ $post->title }}</h4>
                @if($post->post_image_name != null)
                    <div class="text-center">
                        <img src="{{ route('image.getPostImage',$post->post_image_name) }}" alt="Post Image" title="Post Image">
                    </div>
                @endif
                <h6 class="d-block">{{ $post->content }}</h6>
            </div>
        </div>
    </div>
</main>

    <div class="d-flex justify-content-center">
        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Back</a>
    </div>
@endsection
