@extends('layouts.app-master')

@section('title')
    Search | Programmeren 5
@endsection
@section('content')
<div class="bg-light p-5 rounded">
    <h1>Search results</h1>
    @if($cars->isNotEmpty())
        @foreach ($cars as $car)
            <div class="car-list">
                <p>{{ $car->name }} {{ $car->model}} ({{ $car->year }})</p>
                
            </div>
        @endforeach
    @else 
    <div>
        <h2>No car found</h2>
    </div>
    @endif
</div>
@endsection