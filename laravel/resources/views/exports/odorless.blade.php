<table>
    <thead>
    <tr>
        <th>Sr.No.</th>
        <th>Name</th>
        <th>SMILES</th>
        <th>CAS No</th>
        <th>Mol. Wt.</th>
        <th>Mol. Formula</th>
        <th>PubChem</th>
        <th>ZINC</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($odorants as $odorant)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $odorant->common_name }}</td>
            <td>{{ $odorant->smiles }}</td>
            <td>{{ $odorant->casrn }}</td>
            <td>{{ $odorant->mol_weight }}</td>
            <td>{{ $odorant->mol_formula }}</td>
            <td>
                <a href="{{ $odorant->pubchem_link }}" target="_blank">
                    {{ $odorant->pubchem_id }}
                </a>
            </td>
            <td>
                <a href="{{ $odorant->zinc_link }}" target="_blank">
                    {{ $odorant->zinc_id }}
                </a>
            </td>
            <td><a href="{{ route('odorant.view', $odorant->id) }}">View at OlfactionBase</a></td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
