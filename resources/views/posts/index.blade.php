@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <main class="container">
        <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
            <div class="d-flex justify-content-between border-bottom">
                <h1 class="pb-2 mb-0">Recent Posts</h1>
                <div class="p-1">
                    <a href="{{ URL::route('posts.create') }}" class="btn btn-primary">Create Post</a>
                </div>
            </div>
            @foreach ($posts as $post)
                <div class="d-flex text-muted pt-3">
                    @if ($post->user->profile->profile_image_name != null)
                        <img class="me-3 p-2" src="{{ route('image.getProfileImage', $post->user->profile->profile_image_name) }}" width="45" height="45">
                    @endif
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <p>
                                <a href="{{ route('profile.show', $post->user->profile) }}">{{ $post->user->name }}</a>
                                <strong>&middot {{ $post->created_at->diffForHumans() }}</strong>
                                @if($post->updated_at > $post->created_at)
                                    <strong>&middot updated {{ $post->updated_at->diffForHumans() }}</strong>
                                @endif
                            </p>
                            <p>
                                <a href="{{ route('posts.show', $post) }}">View</a>
                            </p>
                        </div>
                        <h6>{{ $post->title }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@section('pagination')
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
