@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <p>Title: <input type="text" name="title"
                value="{{ old('title') }}"></p>
        </div>
        <div class="form-group">
            <p>Content: <input type="text" name="content"
                value="{{ old('content') }}"></p>
        </div>
        <div class="form-group">
            <p>Image: <input type="file" name="file"
                value="{{ old('file') }}"></p>
        </div>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
