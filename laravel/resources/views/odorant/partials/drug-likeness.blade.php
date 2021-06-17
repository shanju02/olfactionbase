<div class="card">
    <div class="card-header">
        <h4 class="card-title">Drug Likeness</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Lipinski Violations</th>
                <td>{{ $odorant->lipinski_violation }}</td>
            </tr>
            <tr>
                <th scope="row">Ghose Violations</th>
                <td>{{ $odorant->ghose_violation }}</td>
            </tr>
            <tr>
                <th scope="row">Veber Violations</th>
                <td>{{ $odorant->veber_violation }}</td>
            </tr>
            <tr>
                <th scope="row">Egan Violations</th>
                <td>{{ $odorant->egan_violation }}</td>
            </tr>
            <tr>
                <th scope="row">Muegge Violations</th>
                <td>{{ $odorant->muegge_violation }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
