{{--  @extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))  --}}


@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>503</h1>
        </div>
        <h2>Service Unavailable</h2>
        <p>Server is temporarily unable to handle the request.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection