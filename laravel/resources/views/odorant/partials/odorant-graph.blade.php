<?php
$odorsForGraph = json_decode($odorsJson);
//pr($odorsForGraph);

    ?>
<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Odors</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @if(isset($odorsForGraph->children) && count($odorsForGraph->children))
                <svg id="odorantGraph"></svg>
                @else
                    <div>
                        No information available
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
