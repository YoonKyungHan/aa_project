@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to the admin dashboard.</p>
    @can('edit articles')
    <p>You can edit articles.</p>
    @endcan
    @can('delete articles')
    <p>You can delete articles.</p>
    @endcan
@stop