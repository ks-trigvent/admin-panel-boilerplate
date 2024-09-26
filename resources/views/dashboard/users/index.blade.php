@extends('layouts.app_layout')
@section('Dashboard')
@section('content')
 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">All Users</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @can('is-admin')
            <button type="button" class=" h3 mb-2 text-white-800 text-white float-right btn btn-primary" data-toggle="modal" data-target="#addNewUser">Add new user</button>
        @endcan
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
                        @if(auth()->user()->can('is-admin') || auth()->user()->can('is-editor'))
                        <th>
                            @if(auth()->user()->can('is-admin') || auth()->user()->can('is-editor'))
                            <a href="{{route('edit.user', ['id' => Crypt::encrypt($user->id)])}}" class="btn btn-primary btn-circle">
                                <i class="fas fa-pen"></i>
                            </a>
                            @endif

                            @can('is-admin')
                            <a onclick="if(!confirm('Are you make sure to delete this user?')){ return false;}" href="{{route('delete.user-profile', ['id' => Crypt::encrypt($user->id)])}}" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                        </th>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Create new user modal -->
    <x-user-create-modal
      :roles=$roles
    /> 
</div>
@endsection