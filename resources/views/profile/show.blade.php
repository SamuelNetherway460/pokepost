@extends('layouts.app')

@section('title', 'Show Profile')

@section('content')
    <main class="container">

            <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
                @if ($user->profile->cover_image_name != null)
                    <img src="{{ route('image.getCoverImage', $user->profile->cover_image_name) }}" alt="Profile Cover Image" title="Profile Cover Image" style="width:100%">
                @endif
                <div class="text-center mt-4">
                    <h1 class="pb-2 mb-0">{{ $user->name }}</h1>
                    @if ($user->profile->profile_image_name != null)
                        <img src="{{ route('image.getProfileImage', $user->profile->profile_image_name) }}" alt="Profile Image" title="Profile Image" width="100" height="100" class="mt-2">
                    @endif
                </div>
            </div>
            <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
                <div class="d-flex justify-content-between border-bottom">
                    <h2 class="pb-2 mb-0">Your Stats</h2>
                </div>
                <div class="card-deck mt-3 text-center">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #fffa98">
                            <h4 class="my-0 font-weight-normal">Posts</h4>
                        </div>
                        <div class="card-body" style="background-color: #fffdd4">
                            <h1 class="card-title" style="color: #3b4cca">{{ $numPosts }}</h1>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #fffa98">
                            <h4 class="my-0 font-weight-normal">Comments</h4>
                        </div>
                        <div class="card-body" style="background-color: #fffdd4">
                            <h1 class="card-title" style="color: #3b4cca">{{ $numComments }}</h1>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #fffa98">
                            <h4 class="my-0 font-weight-normal">Days Active</h4>
                        </div>
                        <div class="card-body" style="background-color: #fffdd4">
                            <h1 class="card-title" style="color: #3b4cca">{{ $numDaysActive }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id='pokemonShow' class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
                <div class="border-bottom">
                    <h2 class="pb-2 mb-0">Favorite Pokemon</h2>
                </div>
                <div v-if="pokemon != null" class="mt-3">
                    <div class="d-flex mx-auto card w-50 shadow-sm">
                        <div class="card-header text-center" style="background-color: #fffa98">
                            <h4 class="my-0 font-weight-normal">@{{ pokemon.name }}</h4>
                        </div>
                        <img class="card-img-top" style="background-color: #fffdd4" src="{{ route('profile.pokemonImage', $user->profile->favorite_pokemon.'.png') }}">
                        <div class="p-3 card-text" style="background-color: #fffdd4">
                            <div class="d-flex justify-content-between border-bottom">
                                <h5>Height</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.height }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Weight</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.weight }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>HP</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.hp }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Speed</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.speed }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Attack</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.attack }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Special Attack</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.specialAttack }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Defense</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.defence }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Special Defense</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.specialDefence }}</h5>
                            </div>
                            <div class="d-flex justify-content-between border-bottom mt-2">
                                <h5>Base Experience</h5>
                                <h5 style="color: #3b4cca">@{{ pokemon.baseExperience }}</h5>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color: #fffdd4">
                        <div class="d-flex justify-content-between">
                            <h5>Abilities:
                                <div class="mt-3" v-for="ability in pokemon.abilities">
                                    <p>- @{{ ability }}</p>
                                </div>
                            </h5>
                        </div>
                        </div>
                    </div>
                </div>
                <div v-if="pokemon == null" class="mt-3">
                    <h5 class="text-danger">Error - Cannot get favorite pokemon information!</h5>
                </div>
            </div>

            <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
                <div class="d-flex justify-content-between border-bottom">
                    <h2 class="pb-2 mb-0">{{ $user->name }}'s Posts</h2>
                </div>
                @foreach ($posts as $post)
                <div class="d-flex text-muted pt-3">
                    @if ($post->user->profile->profile_image_name != null)
                        <img class="me-3 p-2" src="{{ route('image.getProfileImage', $post->user->profile->profile_image_name) }}" alt width="45" height="45">
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
            @if (count($posts) == 0)
                    <h5 class="mt-3">No posts yet!</h5>
            @endif
            </div>
    </main>

    <script>
        var pokemonShow = new Vue({
            el: '#pokemonShow',
            data: {
                pokemon: null,
            },
            mounted(){
                axios.get("{{ route('api.pokemon.get', $user->profile->favorite_pokemon) }}")
                .then( response => {
                    this.pokemon = response.data;
                })
                .catch( response=> {
                    console.log(response);
                })
            },
        });
    </script>
@endsection

@section('pagination')
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
