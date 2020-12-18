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
                <textarea name="title" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Title" value="{{ old('title') }}">{{ $post->title }}</textarea>
            </div>
            <img id="output" width="200" />
            <div class="text-center">
                <img src="{{ route('image.getPostImage',$post->post_image_name) }}" alt="Post Image" title="Post Image">
            </div>
            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control" id="chooseFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-primary" type="button" id="inputGroupFileAddon04">Upload</button>
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content" value="{{ old('content') }}">{{ $post->content }}</textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="Update">
            <a href="{{ route('posts.show', $post) }}">Cancel</a>
        </form>
    </div>
</main>
@endsection
