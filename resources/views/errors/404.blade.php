@extends('errors::minimal')

@section('title', __('Not Found') . ' | ' . config('app.name'))
@section('code', '404')
@section('message', __('Not Found'))
