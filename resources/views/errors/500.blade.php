{{--  @extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))  --}}



@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>500</h1>
        </div>
        <h2>Internal Server Error</h2>
        <p>Server encountered an unexpected condition that prevented it from fulfilling the request.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection