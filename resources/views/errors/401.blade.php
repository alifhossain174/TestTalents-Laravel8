{{--  @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))  --}}

@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>401</h1>
        </div>
        <h2>Unauthorized Client</h2>
        <p>The request has not been applied because it lacks valid authentication credentials for the target resource.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection