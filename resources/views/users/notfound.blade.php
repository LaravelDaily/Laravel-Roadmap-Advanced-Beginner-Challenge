@extends('errors.minimal')

@section('title', __('Not Found'))
@section('code')
    <span style="color: darkred">404</span>
@endsection

@section('message')
    <h4 style="color: red">{{ $error }}</h4>
@endsection
