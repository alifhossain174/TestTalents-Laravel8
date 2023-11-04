{{--  @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))  --}}

@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>419</h1>
        </div>
        <h2>CSRF token failure</h2>
        <p>Cross-site request forgery token is missing.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection