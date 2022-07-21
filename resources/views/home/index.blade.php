@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            {{-- <h2>Admin motherfucker</h2> --}}
        @endauth

        @auth
        <h1>Dashboard</h1>

        

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection