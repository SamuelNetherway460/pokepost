@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@php $user = Auth::user() @endphp
@php $profile = Auth::user()->profile @endphp
    <main class="container">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            @if ($profile->cover_image_name != null)
                <img class="img-fluid" src="{{ route('image.getCoverImage', $profile->cover_image_name) }}" alt="Profile Cover Image" title="Profile Cover Image">
            @endif
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="text-center">
                    <h1 class="pb-2 mb-0">{{ $user->name }}</h1>
                    @if ($profile->cover_image_name != null)
                        <img src="{{ route('image.getProfileImage', $profile->profile_image_name) }}" alt="Profile Image" title="Profile Image" width="100" height="100">
                    @endif
                    <h3>{{ $profile->firstname }} {{ $profile->lastname }}</h3>
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom">
                    <h2 class="pb-2 mb-0">Your Details</h2>
                </div>
            </div>

            @if(Auth::user()->profile->profileable_type == App\Admin::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2 class="pb-2 mb-0">Admin Actions</h2>
                    </div>
                </div>
            @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2 class="pb-2 mb-0">Moderator Actions</h2>
                    </div>
                </div>
            @endif

            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom">
                    <h2 class="pb-2 mb-0">Your Posts</h2>
                </div>
                @foreach ($posts as $post)
                <div class="d-flex text-muted pt-3">
                    <img class="me-3 p-2" src="{{ route('image.getProfileImage', $post->user->profile->profile_image_name) }}" alt width="45" height="45">
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <p>
                                <strong class="text-dark">{{ $post->user->name }}</strong>
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
        </div>
    </main>
@endsection
