@extends('admin.layouts.app')
@section('title','Dashboard Admin')
@section('content')
	@include('admin.components.dashboard.stat')
	@include('admin.components.dashboard.chart')
@endsection
