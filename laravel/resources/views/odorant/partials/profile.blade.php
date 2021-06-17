@if($odorant->odor_strength || $odorant->odor_threshold || count($evidences))
<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Odor Profile</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            @if($odorant->odor_strength)
            <tr>
                <td style="width: 12%"><strong>Strength</strong>:</td>
                <td>{{ $odorant->odor_strength }}</td>
            </tr>
            @endif
            @if($odorant->odor_threshold)
            <tr>
                <td><strong>Threshold</strong>:</td>
                <td>{{ $odorant->odor_threshold }}</td>
            </tr>
            @endif
            @if(count($evidences))
            <tr>
                <td><strong>Evidences</strong>:</td>
                <td>
                    <table>
                        @foreach($evidences as $evidence)
                            <tr>
                                <td>
                                    <p><a href="{{ $evidence->article_url }}" target="_blank">{{ $evidence->pmid ?: 'View' }}</a></p>
                                    <p>{{ $evidence->article_detail }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endif
