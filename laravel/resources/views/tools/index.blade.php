@extends('layouts.frontend')

@section('page-title', 'Tools')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Tools</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12">
                    <h3>DeepOlf</h3>
                    <p>
                        DeepOlf is a deep neural network-based prediction model, developed on a large dataset of odorants, non-odorants and olfactory receptors (ORs), using a potential set of physiochemical properties and molecular fingerprints. It allows accurate inference of an odorant over a set of olfactory receptors.
                        <br />
                        <br />
                        <a href="https://bioserver.iiita.ac.in/DeepOlf/" target="_blank">https://bioserver.iiita.ac.in/DeepOlf/</a>
                    </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h3>Smiles2Smell</h3>
                    <p>
                        Smiles2Smell is an ensemble model which combines deep neural network with physiochemical properties and molecular fingerprints (PPMF) and the Convolution neural network with chemical structure images to predict the smells of chemicals using their SMILES notations. A dataset of 5185 chemical compounds with 104 smell percepts was used to develop the multilabel prediction models
                        <br />
                        <br />
                        <a href="https://bioserver.iiita.ac.in/Smiles2Smell" target="_blank">https://bioserver.iiita.ac.in/Smiles2Smell</a>
                    </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h3>OBPred</h3>
                    <p>
                        OBPred is a feature-fusion based deep neural network classifier for identifying odorant binding proteins.
                        <br />
                        <br />
                        <a href="https://bioserver.iiita.ac.in/OBPred" target="_blank">https://bioserver.iiita.ac.in/OBPred</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
@endpush

@push('footer')
@endpush

