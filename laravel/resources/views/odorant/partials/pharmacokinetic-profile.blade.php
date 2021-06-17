<div class="card">
    <div class="card-header">
        <h4 class="card-title">Pharmacokinetic profile</h4>
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
                    <th scope="row">GI Absorption</th>
                    <td>{{ $odorant->gi_absorption }}</td>
                </tr>
                <tr>
                    <th scope="row">BBB Permeable</th>
                    <td>{{ $odorant->bbb }}</td>
                </tr>
                <tr>
                    <th scope="row">PgP Substrate</th>
                    <td>{{ $odorant->pgp_substrate }}</td>
                </tr>
                <tr>
                    <th scope="row">Log Kp (cm/s)</th>
                    <td>{{ $odorant->logkp }}</td>
                </tr>
                <tr>
                    <th scope="row">Bioavailability Score</th>
                    <td>{{ $odorant->bioavailability }}</td>
                </tr>
                <tr>
                    <th scope="row">Caco2</th>
                    <td>{{ $odorant->caco2 }}</td>
                </tr>
                <tr>
                    <th scope="row">Human Intestinal Absorption</th>
                    <td>{{ $odorant->hia }}</td>
                </tr>
                <tr>
                    <th scope="row">Plasm Protein Binding</th>
                    <td>{{ $odorant->plasma_protein_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">CYP1A2 Inhibitor</th>
                    <td>{{ $odorant->cyp1a2_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">CYP2C19 Inhibitor</th>
                    <td>{{ $odorant->cyp2c19_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">CYP2C9 Inhibitor</th>
                    <td>{{ $odorant->cyp2c9_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">CYP2D6 inhibitor</th>
                    <td>{{ $odorant->cyp2d6_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">CYP3A4 inhibitor</th>
                    <td>{{ $odorant->cyp3a4_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">Ames mutagenesis</th>
                    <td>{{ $odorant->ames }}</td>
                </tr>
                <tr>
                    <th scope="row">Acute Oral Toxicity</th>
                    <td>{{ $odorant->acute_oral_toxic }}</td>
                </tr>
                <tr>
                    <th scope="row">Carcinogenicity (Binary)</th>
                    <td>{{ $odorant->carcino_bi }}</td>
                </tr>
                <tr>
                    <th scope="row">Carcinogenicity (Trinary)</th>
                    <td>{{ $odorant->carcino_tri }}</td>
                </tr>
                <tr>
                    <th scope="row">Eye Irritation</th>
                    <td>{{ $odorant->eye_irritation }}</td>
                </tr>
                <tr>
                    <th scope="row">Hepatotoxicity</th>
                    <td>{{ $odorant->hepatotoxicity }}</td>
                </tr>
                <tr>
                    <th scope="row">Androgen Receptor Binding</th>
                    <td>{{ $odorant->androgen_recp_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">Aromatase Binding</th>
                    <td>{{ $odorant->aromatase_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">Estrogen Receptor Binding</th>
                    <td>{{ $odorant->er_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">Glucocorticoid Receptor Binding</th>
                    <td>{{ $odorant->glucocorti_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">Thyroid Receptor Binding</th>
                    <td>{{ $odorant->thyroid_recp_binding }}</td>
                </tr>
                <tr>
                    <th scope="row">BRCP inhibitor</th>
                    <td>{{ $odorant->brcp_inhibtor }}</td>
                </tr>
                <tr>
                    <th scope="row">BSEP inhibitor</th>
                    <td>{{ $odorant->bsep_inhibitor }}</td>
                </tr>
                <tr>
                    <th scope="row">OATP1B1 inhibitor</th>
                    <td>{{ $odorant->oatp1b1_inhibitior }}</td>
                </tr>
                <tr>
                    <th scope="row">OATP1B3 inhibitor</th>
                    <td>{{ $odorant->oatp1b3_inhibitior }}</td>
                </tr>
                <tr>
                    <th scope="row">OATP2B1 inhibitor</th>
                    <td>{{ $odorant->oatp2b1_inhibitior }}</td>
                </tr>
                <tr>
                    <th scope="row">OCT1 inhibitor</th>
                    <td>{{ $odorant->oct1_inhibitior }}</td>
                </tr>
                <tr>
                    <th scope="row">OCT2 inhibitor</th>
                    <td>{{ $odorant->oct2_inhibitior }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
