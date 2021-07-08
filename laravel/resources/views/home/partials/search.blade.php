<section id="clients" class="clients clients">
    <div class="container">
        <div class="mt-2 mb-2" >
            <div class="row">
                <div class="col-lg-3 col-md-3 col-6">
                    <select name="category" id="category" class="form-select" @change="changeSearchType($event)">
                        <option value="">Select Search Type</option>
                        <option value="odor">Odor</option>
                        <option value="chemical">Chemical</option>
                        <option value="receptor">Receptor</option>
                        <option value="odp">Or-Odorant Pairs</option>
                        <option value="obp">OBP/PBP</option>
                    </select>
                </div>
                <div class="col-lg-9 col-md-9 col-12">
                    <odor-search
                        odor-data-url="{{ route('api.odor.list') }}"
                        sub-odor-data-url="{{ route('api.sub.odor.list') }}"
                        search-form-url="{{ route('odor') }}"
                        v-if="searchType === 'odor'"
                    ></odor-search>
                    <chemical-search
                        search-form-url="{{ route('odorant') }}"
                        v-else-if="searchType === 'chemical'"
                    ></chemical-search>
                    <receptor-search
                        search-form-url="{{ route('receptor') }}"
                        v-else-if="searchType === 'receptor'"
                    ></receptor-search>
                    <or-odorant-search
                        search-form-url="{{ route('or.odorant') }}"
                        v-else-if="searchType === 'odp'"
                    ></or-odorant-search>
                    <obp-search
                        organism-data-url="{{ route('api.obp.organism.list') }}"
                        search-form-url="{{ route('protein') }}"
                        v-else-if="searchType === 'obp'"
                    ></obp-search>
                    <div v-else>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-12">
                                <input type="text" name="key1" id="key1" class="form-control d-inline" placeholder="Search term..." style="width: 45%" >
                                <div id="opt" style="width: 10%; display: inline">-AND-</div>
                                <input type="text" name="key2" id="key2" class="form-control d-inline" placeholder="Another search term..." style="width: 45%">
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <button type="button" name="btnSearch" id="btnSearch" class="btn btn-primary w-100">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('footer')

@endpush
