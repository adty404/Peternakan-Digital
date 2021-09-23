@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('content')
@if (auth()->user()->role == 'master')
    @include('pages.admin.dashboard.master')
@endif

@if (auth()->user()->role == 'super-admin')
    @include('pages.admin.dashboard.super-admin')
@endif

@if (auth()->user()->role == 'admin')
    @include('pages.admin.dashboard.admin')
@endif

@if (auth()->user()->role == 'operator')
    @include('pages.admin.dashboard.operator')
@endif
@endsection