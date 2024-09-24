@extends('layouts.app_layout')
@section('Edit User')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit User</h1>
<!-- DataTales Example -->

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="p-5">
                    <form class="user" method="POST" action="{{route('auth.user.register')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-user" name="name" id="name"
                                    placeholder="Name" value="{{$userDetail->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" name="email" id="email"
                                placeholder="Email Address" value="{{$userDetail->email}}">
                        </div>

                        <div class="form-group">
                            @foreach($roles as $key => $role)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="rolecheckbox{{$key}}" value="{{$role->id}}">
                                <label class="form-check-label" for="rolecheckbox{{$key}}">{{$role->name}}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rolesRadioBox" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                            </div>
                            @endforeach
                        </div>
                        <input value="Update User" type="submit" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection