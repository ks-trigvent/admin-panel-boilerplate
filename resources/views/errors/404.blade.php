@extends('layouts.error_layout')
@section('title', '498 - Token Invalid')
@section('content')
<div class="container-fluid error-page">
    <x-error-content 
        statusCode="404"
        errorMessage="Oops! Page not found."
        buttonText="Back to Home"
        buttonLink="/"
    />
</div>
@endsection