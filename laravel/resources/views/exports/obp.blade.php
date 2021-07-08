<table>
    <thead>
    <tr>
        <th>Sr. No</th>
        <th>UniProt</th>
        <th>Organism</th>
        <th>Type</th>
        <th>Length</th>
        <th>Sequence</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($proteins as $protein)
        <tr>
            <td>{{ $i }}</td>
            <td nowrap>
                <a href="{{ $protein->Uniprot }}" target="_blank">
                    {{ $protein->name }}
                </a>
            </td>
            <td nowrap>{{ $protein->organism }}</td>
            <td nowrap>{{ $protein->Type }}</td>
            <td>{{ $protein->length }}</td>
            <td class="text-wrap">{{ $protein->sequence }}</td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
