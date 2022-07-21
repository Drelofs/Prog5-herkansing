@extends('layouts.app-master')

@section('title')
    Cars
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Product</h4>
            </div>
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