@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@php $user = Auth::user() @endphp
@php $profile = Auth::user()->profile @endphp
    <main class="container">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="text-center">
                <h1 class="pb-2 mb-0">{{ $user->name }}</h1>
                <img src="{{ route('image.getProfileImage', $profile->profile_image_name) }}" alt="Post Image" title="Post Image" width="200" height="200">
                <h2>{{ $profile->firstname }} {{ $profile->lastname }}</h2>
            </div>
        </div>
    </main>
@endsection
