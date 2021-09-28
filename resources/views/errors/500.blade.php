@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
<h2>{{ $exception->getMessage() }}</h2>

