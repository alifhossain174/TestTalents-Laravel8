{{--  @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))  --}}


@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Page Not Found</h2>
        <p>The page you are looking for might have been removed or had its name changed or is temporarily unavailable.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection




