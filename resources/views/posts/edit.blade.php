@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex justify-content-between border-bottom mb-3">
            <h2 class="pb-2 mb-0">Edit Post</h2>
        </div>
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group input-group-lg mb-3">
                <textarea name="title" class="form-control @error('title') is-invalid @enderror" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Title">{{ $post->title }}</textarea>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if($post->post_image_name != null)
                <div class="text-center">
                    <img src="{{ route('image.getPostImage',$post->post_image_name) }}" alt="Post Image" title="Post Image">
                </div>
            @endif
            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control @error('file') is-invalid @enderror" id="chooseFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content">{{ $post->content }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input class="btn btn-primary" type="submit" value="Update">
            <a href="{{ route('posts.show', $post) }}">Cancel</a>
        </form>
    </div>
</main>
@endsection
