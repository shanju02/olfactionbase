@extends('layouts.frontend')

@section('page-title', 'Or-Odorant Pairs')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>OR-ODORANT PAIRS</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="150">
                    <p style="text-align: justify">
                        Interactions between ORs and odorants are perplexed. A single OR can bind to multiple
                        odorants, on the other hand a single odorant can provoke a response from more than one OR,
                        thus leading to a unique combination of ORs for each odorant.
                    </p>
                    <p style="text-align: justify">
                        OlfactionBase contains 875 OR-odorant interaction pairs for Humans and Mus musculus. The odorant-OR pairs in OlfactionBase include 197 odorants, 69 receptors and 409 associations among Humans and 133 ligands, 81 receptors and 466 associations among Mus musculus.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="clients">
        <form action="{{ route('or.odorant') }}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3" style="text-align: left">
                        <h4>Search Odorants</h4>
                    </div>
                    <div class="col-lg-5">
                        <input name="casrn" id="casrn" placeholder="CAS NO." value="{{ \Request::get('casrn') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-4">
                        <input name="pubchem_id" id="pubchem_id" placeholder="PubChem Id" value="{{ \Request::get('pubchem_id') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="text-align: left">
                        <h4>Search Receptors</h4>
                    </div>
                    <div class="col-lg-3">
                        <input name="receptor_name" id="receptor_name" placeholder="Receptor Name" value="{{ \Request::get('receptor_name') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-3">
                        <input name="uniprot_accn" id="uniprot_accn" placeholder="UniProt Id" value="{{ \Request::get('uniprot_accn') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-3">
                        <input name="genbank_accn" id="genbank_accn" placeholder="GenBank Id" value="{{ \Request::get('genbank_accn') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">&nbsp;</div>
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary mb-2 mt-2" style="background: #3498db; width: 100%">Search</button>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('or.odorant') }}">
                            <button type="button" class="btn btn-primary mb-2 mt-2" style="background: #1a1f21; width: 100%">Clear</button>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('or.odorant.export', request()->getQueryString()) }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100" style="background-color: #0d6efd">
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Odorant</th>
                            <th>PubChem</th>
                            <th>Receptor</th>
                            <th>UniProt</th>
                            <th>GenBank</th>
                            <th>Organism</th>
                            <th>Evidence</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($odorants) && $odorants->count())
                            @foreach($odorants as $odorant)
                                <tr>
                                    <td>{{ (($odorants->currentPage() - 1) * $odorants->perPage())+$loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('odorant.view', $odorant->odorant_id) }}">
                                            {{ $odorant->casrn }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $odorant->pubchem_link }}" target="_blank">
                                            {{ $odorant->pubchem_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('receptor.view', $odorant->receptor_id) }}">
                                            {{ $odorant->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $odorant->uniprot_link }}" target="_blank">
                                            {{ $odorant->uniprot_accn }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $odorant->genbank_link }}" target="_blank">
                                            {{ $odorant->genbank_accn }}
                                        </a>
                                    </td>
                                    <td>{{ $odorant->organism }}</td>
                                    <td >
                                        <button type="button" class="btn btn-sm btn-primary" id="open-modal" onclick="openModal({{ $odorant->odorant_id }}, {{ $odorant->receptor_id }})" style="background: #3498db">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 25px 0">No records found!</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            @if(isset($odorants) && $odorants->count())
                <div class="row">
                    <div class="col-md-4">Showing {{ $odorants->firstItem() }} to {{ $odorants->lastItem() }} of total {{ $odorants->total() }} entries
                    </div>
                    <div class="col-md-8">
                        <div class="float-end">
                            <?php $paginaParam = ['entries' => \Request::get('entries'), 'search' => \Request::get('search')];?>
                            {{ $odorants->appends($paginaParam)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="close" style="float: right !important;"></div>
                <table>
                    <thead>
                        <tr>
                            <td style="width: 10%; font-weight: bold">PMID</td>
                            <td style="font-weight: bold">Publication</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody id="evidenceData">
                    </tbody>
                </table>

            </div>

        </div>
    </section>

    </div>
@endsection

@push('header')
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush

@push('footer')
    <script>
        function openModal(odorant_id, receptor_id) {
            $("#evidenceData").html("")
            let modal = document.getElementById("myModal");

            let btn = document.getElementById("open-modal");

            let span = document.getElementsByClassName("close")[0];

            modal.style.display = "block";

            span.onclick = function() { modal.style.display = "none"; }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            fetchEvidences(odorant_id, receptor_id)
        }

        function fetchEvidences(odorant_id, receptor_id) {
            axios.post("{{ route('or.odorant.get.evidences') }}", {
                'odorant_id': odorant_id,
                'receptor_id': receptor_id
            }).then(function (response) {
                const evidences = response.data

                evidences.forEach((evidence) => {
                    appendEvidences(evidence)
                })
            })
        }

        function appendEvidences(evidence) {
            $("#evidenceData").append(
                "<tr><td><a href='"+evidence.article_url+"' target='_blank'>"+evidence.pmid+"</a></td><td>"+evidence.article_detail+"</td></tr>"
            )
        }
    </script>
@endpush

