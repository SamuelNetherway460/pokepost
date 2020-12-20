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
                        <img src="{{ route('image.getProfileImage', $profile->profile_image_name) }}" alt="Post Image" title="Post Image" width="200" height="200">
                    @endif
                    <h2>{{ $profile->firstname }} {{ $profile->lastname }}</h2>
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom">
                    <h1 class="pb-2 mb-0">Your Details</h1>
                </div>
            </div>

            @if(Auth::user()->profile->profileable_type == App\Admin::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="d-flex justify-content-between border-bottom">
                        <h1 class="pb-2 mb-0">Admin Actions</h1>
                    </div>
                </div>
            @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="d-flex justify-content-between border-bottom">
                        <h1 class="pb-2 mb-0">Moderator Actions</h1>
                    </div>
                </div>
            @endif

            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom">
                    <h1 class="pb-2 mb-0">Your Posts</h1>
                </div>
            </div>
        </div>
    </main>
@endsection
