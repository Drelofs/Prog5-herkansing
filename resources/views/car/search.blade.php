@extends('layouts.app-master')

@section('title')
    Search | Programmeren 5
@endsection
@section('content')
<div class="bg-dark text-white mt-5 p-5 rounded">
    <h1>Search results for "{{ request()->query('search') }}"</h1>
    @if($cars->isNotEmpty())
        @foreach ($cars as $car)
            <div class="rounded car-listitem bg-dark text-white my-4">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <img class="rounded" width="400" src="{{ asset('images/' . $car->image_path) }}">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 px-4">
                        {{-- <p>{{ $car->name }} {{ $car->model}} ({{ $car->year }})</p> --}}
                        <a class="text-decoration-none text-white" href="/car/{{ $car->id }}">
                            <h3><strong>{{ $car->name }}</strong> {{ $car->model}} ({{ $car->year }})</h3>
                        </a> 
                    </div>
                </div>           
            </div>
        @endforeach
    @else 
    <div>
        <h2>No car found</h2>
    </div>
    @endif
</div>
@endsection