{{--  @extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))  --}}


@extends('errors.master')

@section('content')
    <div class="notfound">
        <div class="notfound-404">
            <h1>403</h1>
        </div>
        <h2>Forbidden</h2>
        <p>Access to the requested resource is forbidden.</p>
        <a href="{{url('/')}}">Homepage</a>
    </div>
@endsection