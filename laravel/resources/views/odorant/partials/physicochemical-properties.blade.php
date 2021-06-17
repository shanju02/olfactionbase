<div class="card">
    <div class="card-header">
        <h4 class="card-title">Physicochemical properties</h4>
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
                <th scope="row">Molecular Weight (g/mol)</th>
                <td>{{ $odorant->mol_weight }}</td>
            </tr>
            <tr>
                <th scope="row">Mass (g/mol)</th>
                <td>{{ $odorant->mass }}</td>
            </tr>
            <tr>
                <th scope="row">Molar Refractivity</th>
                <td>{{ $odorant->mr }}</td>
            </tr>
            <tr>
                <th scope="row">Net Charge</th>
                <td>{{ $odorant->net_charge }}</td>
            </tr>
            <tr>
                <th scope="row">HBD</th>
                <td>{{ $odorant->hbd }}</td>
            </tr>
            <tr>
                <th scope="row">HBA</th>
                <td>{{ $odorant->hda }}</td>
            </tr>
            <tr>
                <th scope="row">Rt Bonds</th>
                <td>{{ $odorant->rt_bonds }}</td>
            </tr>
            <tr>
                <th scope="row">Rings</th>
                <td>{{ $odorant->rings }}</td>
            </tr>
            <tr>
                <th scope="row">TPSA</th>
                <td>{{ $odorant->tpsa }}</td>
            </tr>
            <tr>
                <th scope="row">Hetero Atoms</th>
                <td>{{ $odorant->hetero_atoms }}</td>
            </tr>
            <tr>
                <th scope="row">Heavy Atoms</th>
                <td>{{ $odorant->heavy_atoms }}</td>
            </tr>
            <tr>
                <th scope="row">Aromatic Heavy Atoms</th>
                <td>{{ $odorant->aromatic_heavy_atoms }}</td>
            </tr>
            <tr>
                <th scope="row">Melting Point (°C)</th>
                <td>{{ $odorant->melting_point }}</td>
            </tr>
            <tr>
                <th scope="row">Boiling Point (°C@760.00mm Hg)</th>
                <td>{{ $odorant->boiling_point }}</td>
            </tr>
            <tr>
                <th scope="row">Vapor Pressure (mmHg@25.00 °C)</th>
                <td>{{ $odorant->vapor_pressure }}</td>
            </tr>
            <tr>
                <th scope="row">Vapor Density (Air =1)</th>
                <td>{{ $odorant->vapor_density }}</td>
            </tr>
            <tr>
                <th scope="row">Fraction Csp3</th>
                <td>{{ $odorant->fraction_csp3 }}</td>
            </tr>
            <tr>
                <th scope="row">LogP</th>
                <td>{{ $odorant->log_p }}</td>
            </tr>
            <tr>
                <th scope="row">iLOGP</th>
                <td>{{ $odorant->ilop }}</td>
            </tr>
            <tr>
                <th scope="row">XLOGP3</th>
                <td>{{ $odorant->xlog3 }}</td>
            </tr>
            <tr>
                <th scope="row">WLOGP</th>
                <td>{{ $odorant->wlogp }}</td>
            </tr>
            <tr>
                <th scope="row">MLOGP</th>
                <td>{{ $odorant->mlogp }}</td>
            </tr>
            <tr>
                <th scope="row">ESOL Log S</th>
                <td>{{ $odorant->esol_logS }}</td>
            </tr>
            <tr>
                <th scope="row">ESOL Solubility (mg/ml)</th>
                <td>{{ $odorant->esol_sol_mgml }}</td>
            </tr>
            <tr>
                <th scope="row">ESOL Solubility (mol/l)</th>
                <td>{{ $odorant->esol_sol_moll }}</td>
            </tr>
            <tr>
                <th scope="row">ESOL Class: esol_class</th>
                <td>{{ $odorant->esol_class }}</td>
            </tr>
            <tr>
                <th scope="row">Ali Log S</th>
                <td>{{ $odorant->ali_logS }}</td>
            </tr>
            <tr>
                <th scope="row">Ali Solubility (mg/ml)</th>
                <td>{{ $odorant->ali_sol_mgml }}</td>
            </tr>
            <tr>
                <th scope="row">Ali Solubility (mol/l)</th>
                <td>{{ $odorant->ali_sol_moll }}</td>
            </tr>
            <tr>
                <th scope="row">Ali Class</th>
                <td>{{ $odorant->ali_class }}</td>
            </tr>
            <tr>
                <th scope="row">Silicos-IT LogSw</th>
                <td>{{ $odorant->silicos_logS }}</td>
            </tr>
            <tr>
                <th scope="row">Silicos-IT Solubility (mg/ml)</th>
                <td>{{ $odorant->silicos_sol_mgml }}</td>
            </tr>
            <tr>
                <th scope="row">Silicos-IT Solubility (mol/l)</th>
                <td>{{ $odorant->silicos_sol_moll }}</td>
            </tr>
            <tr>
                <th scope="row">Silicos-IT Class</th>
                <td>{{ $odorant->silico_class }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
