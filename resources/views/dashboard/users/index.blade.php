@extends('layouts.app_layout')
@section('Dashboard')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">All Users</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>email</th>
                        @if(auth()->user()->can('is-admin') || auth()->user()->can('is-editor'))
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersList as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @can('is-admin')
                        <th>
                            @if(auth()->user()->can('is-admin') || auth()->user()->can('is-editor'))
                                <a href="{{route('edit.user', ['id' => $user->id])}}" class="btn btn-primary btn-circle">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endif

                            @can('is-admin')
                                <a href="#" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                        </th>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection