@extends('layouts.app-master')

@section('title')
    Details | Programmeren 5
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row d-flex justify-content-center mt-4 py-2">
    <div class="back-link">
        <i class="fa-solid fa-arrow-left text-white"></i><a class="text-decoration-none text-white mx-1" href="{{ url()->previous() }}">Go Back</a>
    </div>
    <div class="card bg-dark text-white col-xs-12 col-sm-12 col-md-12 mt-2 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1><strong>{{ $car->name }}</strong> {{ $car->model }}</h1>
            <span class="fs-5">Added by @if (auth()->user()->id === $car->user_id) you @else{{ $car->user->username}} @endif</span>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <img class="rounded img-fluid" src="{{ asset('images/' . $car->image_path) }}">
                    <div class="actions-buttons w-100 py-2">
                        <a href="{{ route('car.edit', $car->id) }}" title="Edit" class="btn btn-light col-12 mb-2">Edit car</a>
                        @csrf
                        @method('DELETE')
                        <form action="{{ url('car' , $car->id ) }}" method="POST" class="">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger col-12">Delete car</button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <h2>Info</h2>
                    <div class="d-block">
                        <strong>Year: </strong><span>{{ $car->year }}</span>
                    </div>
                    <div class="d-block">
                        <strong>Type: </strong><span>{{ $car->type }}</span>
                    </div>
                    <div class="d-block">
                        <strong>Price: </strong><span>€{{ number_format($car->price) }}</span>
                    </div>
                    <div class="d-block mt-4">
                        {{-- <strong>Description: </strong><span>{{ $car->description }}</span> --}}
                        <h3>Description</h3>
                        {{ $car->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection