@extends('layouts.app-master')

@section('title')
    Search | Programmeren 5
@endsection
@section('content')
<div class="bg-light p-5 rounded">
    <h1>Search results for "{{ request()->query('search') }}"</h1>
    <?php print_r($cars); ?>
    @if($cars->isNotEmpty())
        @foreach ($cars as $car)
            <div class="shadow-sm rounded car-listitem bg-white py-2 px-2 my-2">
                <p>{{ $car->name }} {{ $car->model}} ({{ $car->year }})</p>
                <a class="btn btn-dark float-right" href="/car/{{ $car->id }}">Show</a>            
            </div>
        @endforeach
    @else 
    <div>
        <h2>No car found</h2>
    </div>
    @endif
</div>
@endsection