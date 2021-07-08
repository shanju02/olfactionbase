<?php

namespace App\Exports;

use App\Models\Receptor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ReceptorExport implements FromView
{
    use Exportable;

    private $searchParam;

    public function __construct($searchParam)
    {
        $this->searchParam = $searchParam;
    }

    public function view(): View
    {
        $receptors = $this->prepareResult();

        return view('exports.receptors', ['receptors' => $receptors]);
    }

    private function prepareResult()
    {
        $genBank = $this->searchParam['gen_bank'] ?? null;
        $organism = $this->searchParam['organism'] ?? null;
        $chromosome = $this->searchParam['chromosome'] ?? null;
        $family = $this->searchParam['family'] ?? null;
        $seqLengthFrom = $this->searchParam['seq_length_from'] ?? null;
        $seqLengthTo = $this->searchParam['seq_length_to'] ?? null;

        $query = Receptor::with('interactingOdorants');

        if ($genBank) $query->where('genbank_accn', $genBank);
        if ($organism) $query->where('organism', $organism);
        if ($chromosome) $query->where('chromosome', $chromosome);
        if ($family) $query->where('family', $family);
        if ($seqLengthFrom && $seqLengthTo) $query->whereBetween('length', [$seqLengthFrom, $seqLengthTo]);

        return $query->get();
    }
}
