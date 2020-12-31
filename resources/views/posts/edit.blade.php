@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <main class="container">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom mb-3">
                    <h2 class="pb-2 mb-0">Edit Post</h2>
                </div>
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
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex border-bottom">
                    <h2 class="pb-2 mb-0">Current Tags</h2>
                </div>
                <div class="row ml-1 mr-1 mt-2">
                    @foreach ($tags as $tag)
                        <div class="col-sm-1 m-1 p-0 btn btn-info">
                            {{ $tag->name }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="border-bottom mb-3">
                    <h2 class="pb-2 mb-0">New Tags</h2>
                    <h4>Enter tags using the # key followed by the tag i.e., #PokemonGo #Event #News.
                </div>
                <div class="form-group mb-3">
                    <textarea name="tags" class="form-control @error('tags') is-invalid @enderror" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Tags">{{ old('tags') }}</textarea>
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Update">
            <a href="{{ route('posts.show', $post) }}">Cancel</a>
        </form>
    </main>
@endsection
