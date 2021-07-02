@extends('layouts.frontend')

@section('page-title', 'Receptors')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Receptors</h2>
            </div>

            <div class="row content">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="150">
                    <p style="text-align: justify">
                        Olfactory Receptors (ORs) are the physical barriers between the environment and the brain.
                        ORs are members of the GPCR-rhodopsin family, which is involved in cell recognition,
                        signal transduction activation, and sense mediation. OR is made up of seven transmembrane
                        (TM) helical domains bound by three putative extracellular loops (EL) and three putative
                        intracellular loops (IL), an extracellular N-terminus, and an intracellular C-terminus. At the
                        intersection of TM3 and IL2, the intracellular loop includes a conserved sequence motif, the
                        aspartate-arginine-tyrosine (DRY) amino acid motif, which is a hallmark of GPCRs. The
                        TM1, TM2, and TM7 are all conserved. The binding site specificity is determined by the
                        amino acid side chains of the central TM domains, which are structurally diverse. The
                        binding pocket of ORs has a hydrophobic environment, indicative of hydrophobic
                        interactions between odorants and ORs. The binding specificity of ORs is influenced not only
                        by the central TM-domains hyper-variable region, but also by the N-termini and C-termini.
                        Both terminals are small, with only about 20 amino acids each. The conserved cysteine
                        residues in the EL1 and EL2-loops are involved in inter- and intramolecular disulphide
                        linkages. One of the three cysteine restudies in EL2-loop has a specific role. A metal binding
                        site is formed by the sequence motif (HXXC[DE]) in EL2-loop. On binding with Zn(II) or
                        Cu, the EL2-loop transforms into a -helical structure confirmation (eighth helix) (II).When an
                        odorant with a high affinity for metal ions replaces one of the metal-ligated amino acids in
                        the EL2-loop, ORs undergo structural rearrangement, which is necessary for the activation of
                        G-olf proteins attached to OR receptors. On the cytoplasmic side of the TM domains, the
                        sequence motifs KAFSTC, PMYFFL, and YRDYAM play a role in OR folding and
                        activation. The amino acid residues on the extracellular side of TM domains are variable,
                        indicating a wide range of possible odorant recognition sites.
                    </p>
                    <p>OlfactionBase lists 2067 ORs from two species (Human (851) and Mus musculus (1216)).</p>
                </div>
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
                    <img src="{{ asset('assets/img/olfaction/receptors.png') }}" alt="receptors" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="clients">
        <form action="{{ route('receptor') }}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <input name="gen_bank" id="gen_bank" placeholder="GenBank Accession No" value="{{ \Request::get('gen_bank') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-4">
                        <select name="organism" id="organism" class="form-control mb-2 mt-2">
                            <option value="">Select Organism</option>
                            <option value="Human" {{ \Request::get('organism') == 'Human' ? 'selected' : '' }}>Human</option>
                            <option value="Mus musculus" {{ \Request::get('organism') == 'Mus musculus' ? 'selected' : '' }}>Mus musculus</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <input name="chromosome" id="chromosome" placeholder="Chromosome" value="{{ \Request::get('chromosome') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-4">
                        <input name="family" id="family" placeholder="Family" value="{{ \Request::get('family') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-2">
                        <input name="seq_length_from" id="seq_length_from" placeholder="Seq. Length From" value="{{ request()->get('seq_length_from') }}" type="number" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-2">
                        <input name="seq_length_to" id="seq_length_to" placeholder="Seq. Length To" value="{{ \Request::get('seq_length_to') }}" type="number" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mb-2 mt-2 w-100">Search</button>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{ route('receptor') }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100">Clear</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.alerts')
            </div>
        </div>
    </div>
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Receptor</th>
                            <th>Organism</th>
                            <th>Length</th>
                            <th>Chromosome</th>
                            <th>Family</th>
                            <th>Sub Family</th>
                            <th>UniProt</th>
                            <th>GenBank</th>
                            <th>#Odorants</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($receptors) && $receptors->count())
                            @foreach($receptors as $receptor)
                                <tr>
                                    <td>{{ (($receptors->currentPage() - 1) * $receptors->perPage())+$loop->iteration }}</td>
                                    <td>{{ $receptor->name }}</td>
                                    <td>{{ $receptor->organism }}</td>
                                    <td>{{ $receptor->length }}</td>
                                    <td>{{ $receptor->chromosome }}</td>
                                    <td>{{ $receptor->family }}</td>
                                    <td>{{ $receptor->subfamily }}</td>
                                    <td>
                                        <a href="{{ $receptor->uniprot_link}}" target="_blank">
                                            {{ $receptor->uniprot_accn}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $receptor->genbank_link }}" target="_blank">
                                            {{ $receptor->genbank_accn }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $receptor->interactingOdorants->count() }}</td>
                                    <td class="text-center"><a href="{{ route('receptor.view', $receptor->id) }}">View</a></td>
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
            @if(isset($receptors) && $receptors->count())
                <div class="row">
                    <div class="col-md-4">Showing {{ $receptors->firstItem() }} to {{ $receptors->lastItem() }} of total {{ $receptors->total() }} entries
                    </div>
                    <div class="col-md-8">
                        <div class="float-end">
                            <?php $paginaParam = ['entries' => \Request::get('entries'), 'search' => \Request::get('search')];?>
                            {{ $receptors->appends($paginaParam)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('header')
@endpush

@push('footer')
@endpush

