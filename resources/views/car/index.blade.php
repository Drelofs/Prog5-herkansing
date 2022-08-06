@extends('layouts.app-master')

@section('title')
    Your cars
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title"> Your cars</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('car.create') }}" title="Create" class="btn btn-success">Add new car</a>
                <div>
                    <table class="table" id="product_table">
                        <thead class=" text-dark">
                            <th>
                                Name
                            </th>
                            <th>
                                Model
                            </th>
                            <th>
                                Year
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Created At
                            </th>
                       
                            <th class="text-right">
                                Actions
                            </th>
                        </thead>
                        <tbody>
                            @if($cars->isNotEmpty())
                                @foreach ($cars as $row)
                                <tr>
                                    <td>
                                        {{ $row->name }}
                                    </td>
                                    <td>
                                        {{ $row->model }}
                                    </td>
                                    <td>
                                        {{ $row->year }}
                                    </td>
                                    <td>
                                        {{ $row->price }}
                                    </td>
                            
                                    <td>
                                        {{ $row->created_at }}
                                    </td>
                                    <td class="text-right action_buttons">
                                        <a href="{{ route('car.show', $row->id) }}" title="Show Car" class="btn btn-dark">Open</a>
                                        <a href="{{ route('car.edit', $row->id) }}" title="Edit" class="btn btn-dark">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <form action="{{ url('car' , $row->id ) }}" method="POST" class="d-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td><span>You have no cars in your collection...</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection