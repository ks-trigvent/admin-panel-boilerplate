@extends('layouts.auth_layout')

@section('title', 'registration')

@section('content')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <img class="auth-form-image" height="400" width="400" src="{{asset('assets/img/login.jpg')}}" alt="registration" srcset="">
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{route('auth.user.register')}}">
                            @csrf
                            <x-auth-form type="registration" buttonName="Create Account" />
                        </form>
                        <hr />
                        <div class="text-center">
                            <a class="small mx-4" href="/">Already a member</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection