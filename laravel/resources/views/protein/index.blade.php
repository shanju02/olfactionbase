@extends('layouts.frontend')

@section('page-title', 'Odorant/Pheromone Binding Proteins')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Odorant/Pheromone Binding Proteins</h2>
            </div>

            <div class="row content">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        OBPs, members of lipocalin protein family, are highly diverse, small, water-soluble, globular, ligand specific proteins present in the mucus fluid produced by nasal glands in vertebrates and in the sensillar lymph in insects. OBPs act a “carrier” to transport odorants across the hydrophilic mucus layer and release them in vicinity of their respective ORs. OBPs are highly selective, as they have unique ligand binding profile.  OBPs functionality and expression are not limited to olfaction mechanism and olfactory organs. They are found to be involved in various other functions like measuring odorant concentration, deactivating odorants, etc. and found in taste organs, venom glands, sex hormone glands, etc of insects. Structurally OBPs are made up of eight antiparallel β-sheets folded into a continuous hydrogen-bonded β-barrel and a α-helical domain at the carboxyl terminal. OlfactionBase comprises of 2481 Odorant binding proteins, 417 Pheromone Binding proteins and 14 receptors from 189 species.
                    </p>
                </div>
                <div class="col-lg-5 pt-4 pt-lg-0 text-center" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{ asset('assets/img/olfaction/obp.png') }}" alt="obp" class="img-fluid" style="width: 80%;">
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="clients">
        <form action="{{ route('protein') }}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <input name="name" id="name" placeholder="UniProt Id" value="{{ \Request::get('name') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control mb-2 mt-2" name="organism" id="organism">
                            <option value="">Select Organism</option>
                            @foreach($organisms as $key => $organism)
                                <option value="{{ $organism->organism }}" {{ \Request::get('organism') == $organism->organism ? 'selected' : '' }}>{{ $organism->organism }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input name="length_from" id="length_from" placeholder="Length From" value="{{ \Request::get('length_from') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-2">
                        <input name="length_to" id="length_to" placeholder="Length To" value="{{ \Request::get('length_to') }}" type="text" class="form-control mb-2 mt-2">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mb-2 mt-2 w-100">Search</button>
                    </div>
                    <div class="col-lg-1">
                        <a href="{{ route('protein') }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100">Clear</a>
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
                            <th nowrap="">Sr. No</th>
                            <th>UniProt</th>
                            <th>Organism</th>
                            <th>Type</th>
                            <th>Length</th>
                            <th>Sequence</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($proteins) && $proteins->count())
                            @foreach($proteins as $protein)
                                <tr>
                                    <td>{{ (($proteins->currentPage() - 1) * $proteins->perPage())+$loop->iteration }}</td>
                                    <td nowrap>
                                        <a href="{{ $protein->Uniprot }}" target="_blank">
                                            {{ $protein->name }}
                                        </a>
                                    </td>
                                    <td nowrap>{{ $protein->organism }}</td>
                                    <td nowrap>{{ $protein->Type }}</td>
                                    <td>{{ $protein->length }}</td>
                                    <td class="text-wrap">{{ $protein->sequence }}</td>
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
            @if(isset($proteins) && $proteins->count())
                <div class="row">
                    <div class="col-md-4">Showing {{ $proteins->firstItem() }} to {{ $proteins->lastItem() }} of total {{ $proteins->total() }} entries
                    </div>
                    <div class="col-md-8">
                        <div class="float-end">
                            <?php $paginaParam = ['entries' => \Request::get('entries'), 'search' => \Request::get('search')];?>
                            {{ $proteins->appends($paginaParam)->links('vendor.pagination.bootstrap-4') }}
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

