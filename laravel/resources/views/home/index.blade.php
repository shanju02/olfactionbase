@extends('layouts.frontend')

@section('page-title', 'Home')

@section('content')
    @include('home.partials.banner')

    @include('home.partials.search')

    @include('home.partials.chart')


@endsection

@push('header')
    <link rel="stylesheet" href="{{ asset('assets/plugin/circle-chart/circle-chart.css') }}">
@endpush

@push('footer')
    <script src="{{ asset('assets/plugin/circle-chart/circle-chart.js') }}"></script>
@endpush
