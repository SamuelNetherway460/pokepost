@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="container">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between border-bottom">
                <h1 class="pb-2 mb-0">{{ Auth::user()->name }}}</h1>
            </div>
        </div>
    </main>
@endsection
