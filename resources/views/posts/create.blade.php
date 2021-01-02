@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<main class="container">
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
            <div class="d-flex justify-content-between border-bottom mb-3">
                <h2 class="pb-2 mb-0">New Post</h2>
            </div>
            <div class="form-group input-group-lg mb-3">
                <textarea name="title" class="form-control @error('title') is-invalid @enderror" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Title">{{ old('title') }}</textarea>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control @error('file') is-invalid @enderror" id="chooseFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                 @enderror
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content">{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
            <div class="border-bottom mb-3">
                <h2 class="pb-2 mb-0">Tags</h2>
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
        <input class="btn btn-primary" type="submit" value="Submit Post">
        <a href="{{ route('posts.index') }}" class="ml-3" style="color: #ff0000">Cancel</a>
    </form>
</main>
@endsection
