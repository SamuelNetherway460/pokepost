@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<main class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex justify-content-between border-bottom mb-3">
            <h2 class="pb-2 mb-0">New Post</h2>
        </div>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group input-group-lg mb-3">
                <textarea name="title" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Title" value="{{ old('title') }}"></textarea>
            </div>
            <div class="input-group mb-3">
                <input name="file" type="file" class="form-control" id="chooseFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
            </div>
            <div class="form-group mb-3">
                <textarea name="content" class="form-control" aria-label="With textarea" aria-describedby="inputGroup-sizing-lg" placeholder="Content" value="{{ old('content') }}"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
            <a href="{{ route('posts.index') }}">Cancel</a>
        </form>
    </div>
</main>
@endsection
