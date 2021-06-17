<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td><strong>Gene</strong>:</td>
                <td class="px-3">{{ $receptor->gene }}</td>
            </tr>
            <tr>
                <td><strong>Organism</strong>:</td>
                <td class="px-3">{{ $receptor->organism }}</td>
            </tr>
            <tr>
                <td><strong>Type</strong>:</td>
                <td class="px-3">{{ $receptor->type }}</td>
            </tr>
            <tr>
                <td><strong>Chromosome</strong>:</td>
                <td class="px-3">{{ $receptor->chromosome }}</td>
            </tr>
            <tr>
                <td><strong>Family</strong>:</td>
                <td class="px-3">{{ $receptor->family }}</td>
            </tr>
            <tr>
                <td><strong>Subfamily</strong>:</td>
                <td class="px-3">{{ $receptor->subfamily }}</td>
            </tr>
            <tr>
                <td><strong>Length</strong>:</td>
                <td class="px-3">{{ $receptor->length }}</td>
            </tr>
        </table>
    </div>
</div>
