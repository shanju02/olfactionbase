<table>
    <thead>
    <tr>
        <th>Sr. No</th>
        <th>Receptor</th>
        <th>Organism</th>
        <th>Length</th>
        <th>Chromosome</th>
        <th>Family</th>
        <th>Sub Family</th>
        <th>UniProt</th>
        <th>GenBank</th>
        <th>#Odorants</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($receptors as $receptor)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $receptor->name }}</td>
            <td>{{ $receptor->organism }}</td>
            <td>{{ $receptor->length }}</td>
            <td>{{ $receptor->chromosome }}</td>
            <td>{{ $receptor->family }}</td>
            <td>{{ $receptor->subfamily }}</td>
            <td>
                @if(isset($receptor->uniprot_link) && isset($receptor->uniprot_accn))
                <a href="{{ $receptor->uniprot_link}}">
                    {{ $receptor->uniprot_accn}}
                </a>
                @elseif(isset( $receptor->uniprot_accn))
                    {{ $receptor->uniprot_accn}}
                @endif
            </td>
            <td>
                <a href="{{ $receptor->genbank_link }}">
                    {{ $receptor->genbank_accn }}
                </a>
            </td>
            <td class="text-center">{{ $receptor->interactingOdorants->count() }}</td>
            <td class="text-center"><a href="{{ route('receptor.view', $receptor->id) }}">View at OlfactionBase</a></td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
