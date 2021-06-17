<div class="card mt-3">
    <div class="card-header">
        <h4 class="card-title">Cross References</h4>
    </div>
    <div class="card-body">
        <table>
            @if($receptor->uniprot_accn)
            <tr>
                <td><strong>UniProt</strong>:</td>
                <td class="px-3"><a href="{{ $receptor->uniprot_link }}" target="_blank">{{ $receptor->uniprot_accn }}</a></td>
            </tr>
            @endif
            @if($receptor->genbank_accn)
            <tr>
                <td><strong>Genbank</strong>:</td>
                <td class="px-3"><a href="{{ $receptor->genbank_link }}" target="_blank">{{ $receptor->genbank_accn }}</a></td>
            </tr>
                @endif
                @if($receptor->genpept_id)
            <tr>
                <td><strong>GenPept</strong>:</td>
                <td class="px-3"><a href="{{ $receptor->genpept_link }}" target="_blank">{{ $receptor->genpept_id }}</a></td>
            </tr>
                @endif
                @if($receptor->ordb_link)
            <tr>
                <td><strong>ORDB</strong>:</td>
                <td class="px-3"><a href="{{ $receptor->ordb_link }}" target="_blank">View</a></td>
            </tr>
                @endif
                @if($receptor->horde_link)
            <tr>
                <td><strong>HORDE</strong>:</td>
                <td class="px-3"><a href="{{ $receptor->horde_link }}" target="_blank">View</a></td>
            </tr>
                @endif
        </table>
    </div>
</div>
