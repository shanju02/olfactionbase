<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">OR-Odorant Pairs</h4>
    </div>
    <div class="card-body">
        @if(count($evidences))
        <h4>Evidences</h4>
        <div class="row">
            @foreach($evidences as $evidence)
                <div class="col-lg-4">
                    <a href="{{ $evidence->article_url }}" target="_blank">{{ $evidence->pmid }}</a>
                </div>
                <div class="col-lg-8">{{ $evidence->article_detail }}</div>
            @endforeach
        </div>
        @endif
    </div>
</div>
