@extends('errors.minimal')

@section('title', __('Not Found'))
@section('code')
    <span style="color: darkred">Query Exception :( </span>
@endsection

@section('message')
    <h4 style="color: red">{{ $error }}</h4>
@endsection
