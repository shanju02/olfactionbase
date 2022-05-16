@extends('layouts.frontend')

@section('page-title', 'Odorants & Odorless Compounds')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Odorants & Odorless Compounds</h2>
            </div>

            <div class="row content">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        Odorants are volatile and largely hydrophobic organic compounds possessing odors while
                        odorless compounds are chemicals which do not possess or are associated with any odor.
                        OlfactionBase comprises of 3985 odorant molecules representing an array of odors and 1124
                        odorless compounds. Odorant molecules are classified by 30 functional groups such as (acid,
                        alcohol, aldehyde, alkane, cyclic, ether, ester, ketone, thiol, etc.). Each molecule entry
                        includes detail information about physicochemical properties, odor profile, pharmacokinetic
                        profile and drug likeness and cross-references to other biological databases. Among 3985
                        odorant molecules, 197 molecules are associated with 156 Olfactory receptors belonging to
                        two species (Human and Mus musculus). The user-friendly interface of Olfactionbase
                        facilitates exploration of chemicals in various ways: search chemical compounds with CAS
                        No., odor and sub-odors, functional group, SMILES notation and molecular weight.
                    </p>
                </div>
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div id="jsme_container" ></div>
                </div>
            </div>
        </div>
    </section>
    <main id="main">
        <form action="{{ route('odorant') }}" method="get">
            <section id="clients" class="clients">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <select class="form-control mb-2 mt-2" name="odor" id="odor"
                                    onchange="odorWiseSubOdors(this.value)">
                                <option value="">Select Odor</option>
                                @foreach($odors as $odor)
                                    <option value="{{ $odor->id }}" {{ \Request::get('odor') == $odor->id ? 'selected' : '' }}>{{ $odor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control mb-2 mt-2" name="sub_odor" id="sub_odor">
                                <option value="">Select Subodor</option>
                                @if($subOdors && count($subOdors))
                                    @foreach($subOdors as $subOdor)
                                        <option value="{{ $subOdor->id }}" {{ \Request::get('sub_odor') == $subOdor->id ? 'selected' : '' }}>{{ $subOdor->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-lg-4">
                            <select class="form-control mb-2 mt-2" name="functional_group" id="functional_group">
                                <option value="">Select Functional Group</option>
                                @foreach($functionalGroups as $functionalGroup)
                                    <option value="{{ $functionalGroup->id }}" {{ \Request::get('functional_group') == $functionalGroup->id ? 'selected' : '' }}>{{ $functionalGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <input type="text" class="form-control mb-2 mt-2" name="mol_wt_from" id="mol_wt_from"
                                   placeholder="Molecular weight from" value="{{ \Request::get('mol_wt_from') }}">
                        </div>

                        <div class="col-lg-4">
                            <input type="text" class="form-control mb-2 mt-2" name="mol_wt_to" id="mol_wt_to"
                                   placeholder="Molecular weight to" value="{{ \Request::get('mol_wt_to') }}">
                        </div>

                        <div class="col-lg-4">
                            <input type="text" class="form-control mb-2 mt-2" name="smiles" id="smiles"
                                   placeholder="Substructure" value="{{ \Request::get('smiles') }}">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control mb-2 mt-2" name="casrn" id="casrn"
                                   placeholder="CAS-NO" value="{{ \Request::get('casrn') }}">
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary w-100 mb-2 mt-2">Search</button>
                                </div>
                                <div class="col-lg-4">
                                    <a href="{{ route('odorant') }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100">Clear</a>
                                </div>
                                <div class="col-lg-4">
                                    @if($odorless)
                                    <a href="{{ asset('uploads/odorants.csv') }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100" style="background-color: #0d6efd">
                                        Download
                                    </a>
                                    @else
                                        <a href="{{ asset('uploads/odorants.csv') }}" class="btn btn-primary btn-clear mb-2 mt-2 w-100" style="background-color: #0d6efd">
                                            Download
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </form>
    </main>
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
                    <div class="row">
                        <div class="col-lg-6 list-items  {{ !$odorless ? 'active' : ''  }}">
                            <a href="{{ route('odorant') }}" title="View Odorant List">ODORANTS</a>
                        </div>
                        <div class="col-lg-6 list-items {{ $odorless ? 'active' : ''  }}">
                            <a href="{{ route('odorant', [
                                                    'odorless' => 'odorless',
                                                    'casrn' => request()->get('casrn'),
                                                    'smiles' => request()->get('smiles'),
                                                    'functional_group' => request()->get('functional_group'),
                                                    'mol_wt_from' => request()->get('mol_wt_from'),
                                                    'mol_wt_to' => request()->get('mol_wt_to'),
]                                           ) }}" title="View Odorless List">ODORLESS</a>
                        </div>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-md-12">
                    @if($odorless)
                        @include('odorant.partials.odorless-list')
                    @else
                        @include('odorant.partials.odorant-list')
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
    <style>
        .list-items {
            padding: 10px 0;
            text-align: center;
            background-color: #f3f9fd;
        }

        .list-items:hover {
            background-color: #0b5ed7;
        }

        .list-items:hover > a {
            color: #FFF;
        }

        .list-items.active {
            background-color: #0b5ed7;
        }

        .list-items.active a {
            color: #FFFFFF;
        }
    </style>
@endpush

@push('footer')
    <script type="text/javascript" language="javascript" src="{{ asset('assets/jsme/jsme.nocache.js') }}"></script>
    <script>
      function odorWiseSubOdors(odor_id) {
        $.get("{{ config('app.url') }}" + '/odor/' + odor_id + '/subodors').done(function(data) {
          $('#sub_odor').empty().append('<option value=\'\'>Select Subodor</option>');
          data.forEach(appendSubOdor);
        });
      }

      function appendSubOdor(item, index) {
        $('#sub_odor').append('<option value=\'' + item.id + '\'>' + item.name + '</option>');
      }

      function jsmeOnLoad() {
        const jsmeApplet = new JSApplet.JSME("jsme_container", "520px", "300px", {
          "options" : "oldlook,star"
        });
        jsmeApplet.setAfterStructureModifiedCallback(showEvent);
        //document.getElementById("smiles").value = "";
      }

      var patt=/\[([A-Za-z][a-z]?)H?\d*:\d+\]/g; //regexp pattern for numbered atom

      function showEvent(event) {
        const log = document.getElementById("smiles");
        log.value =  event.src.smiles()
      }
    </script>
@endpush

