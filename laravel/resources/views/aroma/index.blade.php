@extends('layouts.frontend')

@section('page-title', 'Aroma')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">

            <div class="row content">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Drinking Water wheel</h2>
                    </div>
                    <p class="text-center">Drinking water tastes and odor wheel. (Mel) Suffet I.H, Schweitzer L, Khiari, D. 2004. Environ. Sci. Bio/Technol. 3: 33.</p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Drinking-Water-Wheel.jpg') }}" class="img-fluid"></p>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row content">
                <div class="col-lg-12 text-center">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Wastewater Odor Wheel</h2>
                    </div>
                    <p class="text-center">The value of an odor-quality-wheel classification scheme for wastewater plants. Suffet M, Burlingame G, Rosenfeld P, Bruchet A. Water science and technology: a journal of the International Association on Water Pollution Research. 2004. 50: 25-32. </p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Wastewater-Odor-Wheel.png') }}" class="img-fluid"></p>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row content">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Compost wheel</h2>
                    </div>
                    <p class="text-center">Sensory assessment and characterization of odor nuisance emissions during the composting of wastewater biosolids. Suffet IH, Decottignies V, Senante E, Bruchet A. Water Environ Res. 2009. 81(7):670-9</p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Compost-Odor-Wheel.jpg') }}" class="img-fluid"></p>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row content">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Wine wheel</h2>
                    </div>
                    <p class="text-center">The Professional Language of Wine: Perception, Training and Dialogue. Herdenstam A, Hammarén M, Ahlström R, Wiktorsson PA. Journal of Wine Research. 2009. 20: 53-84. </p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Wine-Wheel.jpg') }}" class="img-fluid"></p>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row content">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Urban SmellScapes</h2>
                    </div>
                    <p class="text-center">Urban Smellscape Aroma Wheel by Aiello L, Mcleon K, Quercia D.</p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Urban-SmellScape.png') }}" class="img-fluid"></p>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row content">
                <div class="col-lg-12 text-center mb-5">
                    <div class="section-title" data-aos="fade-up">
                        <h2>Olfactory Classification</h2>
                    </div>
                    <p class="text-center">Olfactory Classifications map developed by Dr. Kate McLean. Available at <a href="https://sensorymaps.com" target="_blank">https://sensorymaps.com</a> </p>
                    <p class="text-center"><img src="{{ asset('assets/img/wheels/Olfactory-Classification.jpg') }}" class="img-fluid"></p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
@endpush

@push('footer')
@endpush

