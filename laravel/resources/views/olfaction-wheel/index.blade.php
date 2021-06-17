@extends('layouts.frontend')

@section('page-title', 'Olfaction Wheel')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Olfaction Wheel</h2>
            </div>
        </div>
    </section>
    @include('partials.wheel-2')
@endsection

@push('header')
@endpush

@push('footer')
@endpush

