<table>
    <thead>
    <tr>
        <th>Sr.No.</th>
        <th>Primary Odor</th>
        <th>Sub Odor</th>
        <th>CAS-ID’s</th>
        <th>Chemical Name</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($odorants as $odorant)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $primaryOdor }}</td>
            <td>{{ $odorant->name }}</td>
            <td><a href="{{ route('odorant.view', $odorant->odorant_id) }}">{{ $odorant->casrn }}</a></td>
            <td>{{ $odorant->common_name }}</td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
