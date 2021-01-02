@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')

<main class="container">
    <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 rounded shadow-sm" style="background-color: #fffdd4">
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
                    <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" placeholder="First name" required="true" value="{{ old('firstname') }}">
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mt-1">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" placeholder="Last name" required="true" value="{{ old('lastname') }}">
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" placeholder="Phone Number" required="true" value="{{ old('phoneNumber') }}">
                    @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label for="file" class="form-label">Profile Image</label>
                    <input name="file" type="file" class="form-control @error('file') is-invalid @enderror" id="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label for="favoritePokemon" class="form-label">Favorite Pokemon</label>
                    <input name="favoritePokemon" class="form-control @error('favoritePokemon') is-invalid @enderror" id="favoritePokemon" placeholder="Favorite Pokemon" required="true" value="{{ old('favoritePokemon') }}">
                    @error('favoritePokemon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input class="btn btn-success btn-block mt-3 ml-3 mr-3" type="submit" value="Create">
            </div>
        </div>
    </form>
</main>
@endsection
