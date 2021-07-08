<table>
    <thead>
    <tr>
        <th>Sr. No</th>
        <th>Odorant</th>
        <th>PubChem</th>
        <th>Receptor</th>
        <th>UniProt</th>
        <th>GenBank</th>
        <th>Organism</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($odorants as $odorant)
        <tr>
            <td>{{ $i }}</td>
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
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
