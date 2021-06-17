<div class="card">
    <div class="card-header">
        <h4 class="card-title">Cross References</h4>
    </div>
    <div class="card-body">
        <table>
            @if($odorant->pubchem_id)
            <tr>
                <td><strong>PubChem</strong>:</td>
                <td class="px-3">
                    <a href="{{ $odorant->pubchem_link }}" target="_blank">
                        {{ $odorant->pubchem_id }}
                    </a>
                </td>
            </tr>
            @endif
            @if($odorant->zinc_id)
            <tr>
                <td><strong>Zinc</strong>:</td>
                <td class="px-3">
                    <a href="{{ $odorant->zinc_link }}" target="_blank">
                        {{ $odorant->zinc_id }}
                    </a>
                </td>
            </tr>
            @endif
            @if($odorant->ordb_link)
            <tr>
                <td><strong>OdoRactor</strong>:</td>
                <td class="px-3">
                    <a href="{{ $odorant->ordb_link }}" target="_blank">View</a>
                </td>
            </tr>
            @endif
            @if($odorant->tgsc_link)
            <tr>
                <td><strong>TGSC</strong>:</td>
                <td class="px-3">
                    <a href="{{ $odorant->tgsc_link }}" target="_blank">View</a>
                </td>
            </tr>
            @endif
        </table>
    </div>
</div>
