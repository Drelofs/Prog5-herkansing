@extends('layouts.app-master')

@section('title')
    Admin Panel
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-dark text-white mt-5">
            <div class="card-header">
                <h4 class="card-title"> Manage accounts</h4>
            </div>
            <div class="card-body">
                <div>
                    <table class="table" id="user_table">
                        <thead class="text-white">
                            <th>
                                Username
                            </th>
                            <th>
                                E-mail
                            </th>
                            <th>
                                User Type
                            </th>
                            <th>
                                Created At
                            </th>
                       
                            <th class="text-right">
                                Status
                            </th>
                        </thead>
                        <tbody class="text-white">
                            @if($users->isNotEmpty())
                                @foreach ($users as $row)
                                <tr>
                                    <td>
                                        {{ $row->username }}
                                    </td>
                                    <td>
                                        {{ $row->email }}
                                    </td>
                                    <td>
                                        {{ $row->user_type }}
                                    </td>
                                    <td>
                                        {{ $row->created_at }}
                                    </td>
                                    <td class="text-right action_buttons">
                                        <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->status ? 'checked' : '' }}>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @csrf
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td><span>You have no users on your website...</span></td>
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