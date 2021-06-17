<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td><strong>Common Name</strong>:</td>
                <td class="px-3">{{ $odorant->common_name }}</td>
            </tr>
            <tr>
                <td><strong>IUPAC Name</strong>:</td>
                <td class="px-3">{{ $odorant->iupac_name }}</td>
            </tr>
            <tr>
                <td><strong>Molecular Formula</strong>:</td>
                <td class="px-3">{{ $odorant->mol_formula }}</td>
            </tr>
            <tr>
                <td><strong>SMILES</strong>:</td>
                <td class="px-3">{{ $odorant->smiles }}</td>
            </tr>
            <tr>
                <td><strong>Inchi</strong>:</td>
                <td class="px-3">{{ $odorant->inchi }}</td>
            </tr>
            <tr>
                <td><strong>Inchi Key</strong>:</td>
                <td class="px-3">{{ $odorant->inchi_key }}</td>
            </tr>
            <tr>
                <td><strong>Cas No</strong>:</td>
                <td class="px-3">{{ $odorant->casrn }}</td>
            </tr>
        </table>
    </div>
</div>
