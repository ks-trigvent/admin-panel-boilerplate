@extends('layouts.error_layout')
@section('title', '498 - Token Invalid')
@section('content')
<div class="container-fluid error-page">
    <x-error-content 
        statusCode="498"
        errorMessage="Oops! Token is not valid."
        buttonText="Back to Home"
        buttonLink="/"
    />
</div>
@endsection