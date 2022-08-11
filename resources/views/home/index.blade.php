@extends('layouts.app-master')

@section('content')
    <div class="bg-dark text-white p-5 rounded mt-4">
        <div class="container">
            <div class="row">
                @if($cars->isNotEmpty())
                    @foreach ($cars as $car)
                    <div class="col-xs-12 col-sm-12 col-md-4 my-3">
                        <div class="card h-100 bg-black">
                            <img src="{{ asset('images/' . $car->image_path) }}" class="card-img-top" alt="{{ $car->name}}">
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{ $car->name }}</strong> {{ $car->model }} ({{$car->year}})</h5>
                                <span class="text-info">Added by {{ $car->user->username}}</span>
                                <p class="card-text">{{ $car->description }}</p>
                                <a href="/car/{{ $car->id }}" class="btn btn-light">Show</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else 
                <div>
                    <h2>No cars found</h2>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection