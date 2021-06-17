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

        <div class="container">
            <div class="row" id="def">
                <div class="col-md-3">
                    <span class="dot" style="background-color: rgb(232, 52, 84)"></span>
                    Aromatic Classification Systems
                </div>
                <div class="col-md-3">
                    <span class="dot" style="background-color: rgb(26, 35, 126)"></span>
                    Primary Odors
                </div>
                <div class="col-md-3">
                    <span class="dot" style="background-color: rgb(27, 94, 32)"></span>
                    Sub-Odors
                </div>
                <div class="col-md-3">
                    <span class="dot" style="background-color: rgb(78, 52, 46)"></span>
                    Chemicals
                </div>
                <div class="col-md-3">
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('assets/img/mouse/mouse-move.png') }}" alt="mose move"  style="height: 45px">
                        </div>
                        <div class="col-md-10">
                            Highlights relation between nodes (many to many)
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('assets/img/mouse/single-click.jpg') }}" alt="single click" style="height: 45px">
                        </div>
                        <div class="col-md-10">
                            Click to view specific relations
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img src="{{ asset('assets/img/mouse/double-click.png') }}" alt="double click"  style="height: 45px">
                        </div>
                        <div class="col-md-10">
                            Double Click to view details
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('partials.wheel-2')
@endsection

@push('header')
    <style>
        #def .dot {
            height: 25px;
            width: 25px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endpush

@push('footer')

@endpush

