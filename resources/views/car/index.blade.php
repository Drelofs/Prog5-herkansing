@extends('layouts.app-master')

@section('title')
    Cars | Programmeren 5
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Cars</h4>
            </div>
            <a href="{{ route('car.create') }}" title="Create">
                <i class="material-icons">create</i>
            </a>
            <div class="card-body">
                <div>
                    <table class="table" id="product_table">
                        <thead class=" text-primary">
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
                            </th>
                        </thead>
                        <tbody>
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
                                        <a href="{{ route('car.show', $row->id) }}" title="Show Car">
                                            <i class="material-icons">preview</i>
                                        </a>
                                        <a href="{{ route('car.edit', $row->id) }}" title="Edit">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <form action="{{ url('car' , $row->id ) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection