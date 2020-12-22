@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
@php $user = Auth::user() @endphp
@php $profile = Auth::user()->profile @endphp
    <main class="container">

            <div class="my-3 p-3 bg-white rounded shadow-sm">
                @if ($profile->cover_image_name != null)
                    <div class="text-center">
                        <img class="img-fluid" src="{{ route('image.getCoverImage', $profile->cover_image_name) }}" alt="Profile Cover Image" title="Profile Cover Image">
                    </div>
                @endif
                <div class="text-center">
                    <h1 class="pb-2 mb-0">{{ $user->name }}</h1>
                    @if ($profile->profile_image_name != null)
                        <img src="{{ route('image.getProfileImage', $profile->profile_image_name) }}" alt="Profile Image" title="Profile Image" width="100" height="100">
                    @endif
                    <h3>{{ $profile->firstname }} {{ $profile->lastname }}</h3>
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between border-bottom">
                    <h2 class="pb-2 mb-0">Your Stats</h2>
                </div>
                <div class="card-deck mt-3 text-center">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Posts</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-info">{{ $numPosts }}</h1>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Comments</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-info">{{ $numComments }}</h1>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Days Active</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-info">{{ $numDaysActive }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="border-bottom">
                    <h2 class="pb-2 mt-0">Your Details</h2>
                </div>
                <div class="mt-3">
                    <h5>Title: {{ $profile->title }}</h5>
                    <h5>First Name: {{ $profile->firstname }}</h5>
                    <h5>Last Name: {{ $profile->lastname }}</h5>
                    <h5>Phone Number: {{ $profile->phone_number }}</h5>
                </div>
            </div>
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="border-bottom">
                    <h2 class="pb-2 mb-0">Favorite Pokemon</h2>
                </div>
                <div class="mt-3 text-center">
                    <h3>{{ $profile->favorite_pokemon }}</h3>
                    <h4>Base Experience: {{ $favoritePokemon->get_base_experience() }}</h4>
                    <h4>Height: {{ $favoritePokemon->get_height() }}</h4>
                </div>
            </div>
            @if(Auth::user()->profile->profileable_type == App\Admin::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="border-bottom mb-3">
                        <h2 class="pb-2 mb-0">Admin Actions</h2>
                    </div>
                    <div class="mt-3">

                    </div>
                </div>
            @elseif(Auth::user()->profile->profileable_type == App\Moderator::class)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2 class="pb-2 mb-0">Moderator Actions</h2>
                    </div>
                    <div class="mt-3">

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
