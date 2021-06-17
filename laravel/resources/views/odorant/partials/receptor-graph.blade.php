<?php
$receptorsForGraph = json_decode($receptorsJson);
?>
<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Receptor Interaction</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @if(isset($receptorsForGraph->children) && count($receptorsForGraph->children))
                <svg id="receptorGraph"></svg>
                @else
                    <div style="background-color: azure; height: 400px;">
                        <div class="text-center" style="padding: 200px 0">No receptors available</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('footer')

@endpush
