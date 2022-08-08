@extends('layouts.app-master')

@section('title')
    Edit | Programmeren 5
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
<div class="row d-flex justify-content-center mt-4">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <i class="fa-solid fa-arrow-left text-white"></i> <a class="text-decoration-none text-white" href="{{ url()->previous() }}">Go Back</a>
        <div class="card bg-dark text-white mt-2 p-4">
            <h1>Edit car</h1>
            <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" value="{{ $car->name }}" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Model:</label>
                            <input type="text" value="{{ $car->model }}" name="model" class="form-control" placeholder="Model">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Year:</label>
                            <input type="number" value="{{ $car->year }}" name="year" class="form-control" placeholder="Year">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="number" value="{{ $car->price }}" step='0.01' name="price" class="form-control"
                                placeholder="Put the price">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" style="height:50px" name="description"
                                placeholder="Description">{{ $car->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <label>Image:</label>
                            <input class="d-block" type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-2 text-center">
                        <button type="submit" class="btn btn-light btn-block">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection