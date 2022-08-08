@extends('layouts.app-master')

@section('content')
    <div class="bg-dark text-white p-5 rounded mt-4">

        @auth
        <h1>Dashboard</h1>

        

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection