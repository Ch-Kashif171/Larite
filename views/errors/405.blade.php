@extends('layouts.app')

@section('content')
    <!-- 405 Content -->
    <div class="hero-section">
        <div class="container text-center mt-5 mb-5">
            <h1 class="display-1 text-danger">405</h1>
            <h2 class="mb-3">Method Not Allowed</h2>
            <p class="lead">The method you used to access this resource is not allowed.</p>
            <a href="{{url('/')}}" class="btn btn-primary mt-3"><i class="fa fa-home"></i> Go Home</a>
        </div>
    </div>

@endsection