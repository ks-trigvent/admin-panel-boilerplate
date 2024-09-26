@extends('layouts.email_layout')

@section('content')
<div class="email-container">
    <div class="email-header">
        <h2>Reset Your Password</h2>
    </div>
    <div class="email-body">
        <p>Hi {{$name}},</p>
        <p>We received a request to reset your password. Click the button below to reset it:</p>
        <div class="text-center">
            <a href="{{$link}}" class="btn-reset">Reset Password</a>
        </div>
    </div>
</div>
@endsection