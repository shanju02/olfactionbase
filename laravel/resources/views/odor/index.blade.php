@extends('layouts.frontend')

@section('page-title', 'Odors')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Odors</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        Odors are emotive, irrefutably powerful, deceptive in nature, contribute to our emotional behaviour, influence our mood and thoughts, virtually transport us to various locations and times in our memories. Odors are too complex, do not appear to be sufficiently ‘real' since they do not exist in the absence of a perceiving substance. The odors are encoded in the structural moiety of chemicals. When a substance releases chemical into the air, it gives off a distinct odor. Odors are too complex and have an insubstantial nature, a complex molecular basis, and are perceived individually. A molecule can have more than one odor associated with it.
                    </p>
                    <p>
                        OlfactionBase houses 106 primary odors, which are further classified into 572 subodors based on nine known aroma-classification systems (Wine, Perfumes, Urban odor, Drinking water, Waste water, Compost, Fragrance, City smell, Human Perception).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="clients" class="clients clients">
        <form action="{{ route('odor') }}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div style="float: left; margin-bottom: 10px">Primary Odor</div>
                        <select class="form-control" name="odor" id="odor" onchange="odorWiseSubOdors(this.value)" required>
                            @foreach($odors as $odor)
                                <option value="{{ $odor->id }}" {{ \Request::get('odor') == $odor->id ? 'selected' : '' }}>{{ $odor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <div style="float: left; margin-bottom: 10px">Sub-Odor</div>
                        <select class="form-control" name="subodor" id="subodor">
                            <option value="">Select Sub Odor</option>
                            @if(isset($subOdors) && count($subOdors))
                                @foreach($subOdors as $subOdor)
                                    <option value="{{ $subOdor->id }}" {{ \Request::get('subodor') == $subOdor->id ? 'selected' : '' }}>{{ $subOdor->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary w-100" style="margin-top: 35px;">Search</button>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{ route('odor') }}" class="btn btn-primary btn-clear w-100" style="margin-top: 35px">
                            Clear
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <a href="{{ route('odor.export', request()->getQueryString()) }}" class="btn btn-primary btn-clear w-100" style="margin-top: 35px; background-color: #0d6efd">
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    @if(isset($odorants))
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th width="10%">Sr.No.</th>
                            <th width="20%">Primary Odor</th>
                            <th width="20%">Sub Odor</th>
                            <th width="15%">CAS-ID’s</th>
                            <th>Chemical Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($odorants))
                            @foreach($odorants as $odorant)
                            <tr>
                                <th scope="row">{{ (($odorants->currentPage() - 1) * $odorants->perPage())+$loop->iteration }}</th>
                                <td>{{ $primaryOrderName }}</td>
                                <td>{{ $odorant->name }}</td>
                                <td><a href="{{ route('odorant.view', $odorant->odorant_id) }}">{{ $odorant->casrn }}</a></td>
                                <td>{{ $odorant->common_name }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center"><em>No records found!</em></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
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
        </div>
    </section>
    @else
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        Please select the Odor and Sub Odor to search the Odorant.
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('header')
@endpush

@push('footer')
    <script>
        function odorWiseSubOdors(odor_id)
        {
            $.get( "{{ config('app.url') }}" + '/odor/'+odor_id+'/subodors')
                .done(function (data) {
                    $("#subodor").empty().append("<option value=''>Select Subodor</option>");
                    data.forEach(appendSubOdor)
                });
        }

        function appendSubOdor(item, index) {
            $("#subodor").append("<option value='"+item.id+"'>"+item.name+"</option>");
        }
    </script>
@endpush

