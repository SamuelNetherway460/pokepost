@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')

<main class="container">
    <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between border-bottom mb-3">
                <h2 class="pb-2 mb-0">Create a Profile</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-10">
                    <label for="title" class="form-label">Title</label>
                    <select class="form-select" id="title" name="title" required="" value="{{ old('title') }}">
                        <option value="">Choose...</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Miss</option>
                        <option>Dr</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid title.
                    </div>
                </div>
                <div class="col-md-6 mt-1">
                    <label for="firstname" class="form-label">First Name</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First name" required="true" value="{{ old('firstname') }}">
                </div>
                <div class="col-md-6 mt-1">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last name" required="true" value="{{ old('lastname') }}">
                </div>
                <div class="col-md-12 mt-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number" required="true" value="{{ old('phoneNumber') }}">
                </div>
                <div class="col-md-12 mt-3 input-group">
                    <label for="file" class="form-label">Profile Image</label>
                    <input name="file" type="file" class="form-control" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                </div>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between border-bottom mb-3">
                <h2 class="pb-2 mb-0">Choose a Favorite Pokemon</h2>
            </div>
            <div class="card-deck mt-3 text-center">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Eevee</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ route('profile.pokemonImage', 'eevee.png') }}" width="150" height="150">
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Charmander</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ route('profile.pokemonImage', 'charmander.png') }}" width="150" height="150">
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Larvitar</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ route('profile.pokemonImage', 'larvitar.png') }}" width="150" height="150">
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Pikachu</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ route('profile.pokemonImage', 'pikachu.png') }}" width="150" height="150">
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <input class="btn btn-primary" type="submit" value="Create">
            </div>
        </div>
    </form>
</main>
@endsection
