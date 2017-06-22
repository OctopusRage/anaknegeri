
@extends('layouts.app')
@section('title','Detail Campaign')
@section('content')
    @include('components.jumbotron-donate')
    <div class="container pt-0 pb-5" style="top:-50px !important;">
        @include('components.campaign-report')
    </div>
@endsection