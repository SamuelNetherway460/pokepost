@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<main class="container">
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between border-bottom mb-3">
                <h2 class="pb-2 mb-0">New Post</h2>
            </div>
            <div class="form-group input-group-lg mb-3">
                <textarea name="title" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Title" value="{{ old('title') }}"></textarea>
            </div>
            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control" id="chooseFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-primary" type="button" id="inputGroupFileAddon04">Button</button>
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content" value="{{ old('content') }}"></textarea>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="border-bottom mb-3">
                <h2 class="pb-2 mb-0">Tags</h2>
                <h4>Enter tags using the # key followed by the tag i.e., #PokemonGo #Event #News.
            </div>
        <div class="form-group mb-3">
            <textarea name="tags" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Tags" value="{{ old('tags') }}"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit Post">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
</main>
@endsection
