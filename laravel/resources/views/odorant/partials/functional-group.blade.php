<div class="card">
    <div class="card-header">
        <h4 class="card-title">Functional Group</h4>
    </div>
    <div class="card-body">
        <table>
            @foreach($odorant->functionalGroups as $functionalGroup)
            <tr>
                <td class="px-3">{{ $functionalGroup->name }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
