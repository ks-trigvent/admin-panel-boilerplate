@extends('layouts.app_layout')
@section('title', 'Edit profile')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Update Profile</h1>
<!-- DataTales Example -->

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="p-5">
                    <form class="user" method="POST" action="{{route('update.user', ['id' => $userDetail->id])}}">
                        @csrf
                        <input type="hidden" name="role_id" value="{{$userDetail->role_id}}" >
                        <x-profile-form
                            userRoleType="{{$userDetail->userRole->name}}"
                            buttonName="Update profile"
                            :name="$userDetail->name"
                            :email="$userDetail->email" 
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection