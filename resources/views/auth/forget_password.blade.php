@extends('layouts.auth_layout')

@section('title', 'login');

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img class="auth-form-image" height="400" width="400" src="{{asset('assets/img/login.jpg')}}" alt="registration" srcset="">
                        </div>
                        <div class="col-lg-6 mt-5">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                                </div>
                                @if(!$id)
                                <form method="POST" action="{{route('auth.user.send.email')}}" class="user">
                                    @csrf
                                    <x-auth-form type="forget_password" buttonName="Update password" />
                                </form>
                                @else
                                <form method="POST" action="{{route('auth.user.update.password', ['id'=> $id, 'token' => $token])}}" class="user">
                                    @csrf
                                    <x-auth-form type="update_password" buttonName="Update password" />
                                </form>
                                @endif
                                <hr>
                                <div class="text-center">
                                    <a class="small mx-4" href="/">Go back</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection