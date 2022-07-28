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
<div class="car_info">
    <h3>{{ $car->name }} {{ $car->model }}</h3>
    <div class="car_details">
        <span>Year: </span><span>{{ $car->year }}</span>
        <span>Price: </span><span>€ {{ $car->price }}</span>
        <span>Description: </span><span>{{ $car->description }}</span>
    </div>
</div>
@endsection