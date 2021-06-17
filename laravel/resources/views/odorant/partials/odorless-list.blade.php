<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th scope="col">Sr.No.</th>
        <th scope="col">Name</th>
        <th scope="col">SMILES</th>
        <th scope="col" nowrap>CAS No</th>
        <th scope="col" nowrap>Mol. Wt.</th>
        <th scope="col" nowrap>Mol. Formula</th>
        <th scope="col" nowrap>PubChem</th>
        <th scope="col" nowrap>ZINC</th>
        <th scope="col">Details</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($odorants) && $odorants->count())
        @foreach($odorants as $odorant)
            <tr>
                <td>{{ (($odorants->currentPage() - 1) * $odorants->perPage())+$loop->iteration }}</td>
                <td>{{ $odorant->common_name }}</td>
                <td>{{ $odorant->smiles }}</td>
                <td nowrap>{{ $odorant->casrn }}</td>
                <td nowrap>{{ $odorant->mol_weight }}</td>
                <td nowrap>{{ $odorant->mol_formula }}</td>
                <td nowrap>
                    <a href="{{ $odorant->pubchem_link }}" target="_blank">
                        {{ $odorant->pubchem_id }}
                    </a>
                </td>
                <td nowrap>
                    <a href="{{ $odorant->zinc_link }}" target="_blank">
                        {{ $odorant->zinc_id }}
                    </a>
                </td>
                <td><a href="{{ route('odorant.view', $odorant->id) }}">View</a></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="11" class="text-center"><em>No records found!</em></td>
        </tr>
    @endif
    </tbody>
</table>

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
