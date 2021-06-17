<?php
$odorantsForGraph = json_decode($odorantsJson);
?>
<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Odorants</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @if(isset($odorantsForGraph->children) && count($odorantsForGraph->children))
                    <svg id="graph"></svg>
                @else
                    <div>
                        No information available
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
