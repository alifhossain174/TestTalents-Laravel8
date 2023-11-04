{{--  @extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))  --}}

@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>429</h1>
        </div>
        <h2>Too Many Requests</h2>
        <p>User has sent too many requests in a given amount of time.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection