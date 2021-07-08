<section id="clients" class="clients clients">
    <div class="container">
        <form method="get" class="mt-2 mb-2" id="formSearch" name="formSearch" >
            <div class="row">
                <div class="col-lg-3 col-md-3 col-6">
                    <select name="category" id="category" class="form-select">
                        <option value="">Select Search Type</option>
                        <option value="odor">Odor</option>
                        <option value="chemical">Chemical</option>
                        <option value="receptor">Receptor</option>
                        <option value="odp">Or-Odorant Pairs</option>
                        <option value="obp">OBP/PBP</option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <input type="text" name="key1" id="key1" class="form-control d-inline" placeholder="Search term..." style="width: 45%" >
                    <div id="opt" style="width: 10%; display: inline">-OR-</div>
                    <input type="text" name="key2" id="key2" class="form-control d-inline" placeholder="Another search term..." style="width: 45%">
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <button type="submit" name="btnSearch" id="btnSearch" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>

@push('footer')
    <script>
        $(document).ready(function() {
            const searchForm = $('#formSearch')
            const key1 = $('#key1')
            const key2 = $('#key2')
            const opt = $('#opt')

            searchForm.on('submit', function(e) {
                return $('#category').val() !== '';
            })

            $('#category').on('change', function(e) {
                switch (e.target.value) {
                    case 'odor':
                        searchOdor()
                        break
                    case 'chemical':
                        searchChemical()
                        break
                    case 'receptor':
                        searchReceptor()
                        break
                    case 'odp':
                        searchOdp()
                        break
                    case 'obp':
                        searchObp()
                        break
                    default:
                        return null
                }
            })

            function searchOdor() {
                searchForm.attr('action', "{{ config('app.url') }}/odor")
                key1.attr('name', 'odor')
                key1.attr('placeholder', 'Odor name')

                key2.attr('name', 'subodor')
                key2.attr('placeholder', 'Subodor name')

                opt.html('-AND-')
            }
            function searchChemical() {
                searchForm.attr('action', "{{ config('app.url') }}/chemical")
                key1.attr('name', 'smiles')
                key1.attr('placeholder', 'Structure')

                key2.attr('name', 'casrn')
                key2.attr('placeholder', 'CAS-NO')

                opt.html('-OR-')
            }
            function searchReceptor() {
                searchForm.attr('action', "{{ config('app.url') }}/receptor")
                key1.attr('name', 'gen_bank')
                key1.attr('placeholder', 'GenBank Accession No')

                key2.attr('name', 'family')
                key2.attr('placeholder', 'Family')

                opt.html('-OR-')
            }
            function searchOdp() {
                searchForm.attr('action', "{{ config('app.url') }}/or-odorant-pairs")
                key1.attr('name', 'casrn')
                key1.attr('placeholder', 'CAS NO.')

                key2.attr('name', 'pubchem_id')
                key2.attr('placeholder', 'PubChem Id')

                opt.html('-OR-')
            }
            function searchObp() {
                searchForm.attr('action', "{{ config('app.url') }}/odorant-binding-protein")
                key1.attr('name', 'name')
                key1.attr('placeholder', 'UniProt Id')

                key2.attr('name', 'organism')
                key2.attr('placeholder', 'Organism')

                opt.html('-OR-')
            }
        })
    </script>
@endpush
