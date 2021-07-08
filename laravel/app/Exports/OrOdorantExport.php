<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrOdorantExport implements FromView
{
    use Exportable;

    private $searchParam;

    public function __construct($searchParam)
    {
        $this->searchParam = $searchParam;
    }

    public function view(): View
    {
        $data = $this->prepareResult();

        return view('exports.or-odorant', $data);
    }

    private function prepareResult() {
        $casrn = $this->searchParam['casrn'] ?? null;
        $pubchem_id = $this->searchParam['pubchem_id'] ?? null;
        $receptor_name = $this->searchParam['receptor_name'] ?? null;
        $uniprot_accn = $this->searchParam['uniprot_accn'] ?? null;
        $genbank_accn = $this->searchParam['genbank_accn'] ?? null;

        $query = DB::table('receptor_odorants');
        $query->leftJoin('odorant', 'receptor_odorants.odorant_id', '=', 'odorant.id');

        if ($casrn) {
            $query->where('odorant.casrn', $casrn);
        }
        if ($pubchem_id) {
            $query->where('odorant.pubchem_id', $pubchem_id);
        }

        $query->leftJoin('receptor', 'receptor_odorants.receptor_id', '=', 'receptor.id');

        if ($receptor_name) {
            $query->where('receptor.name', $receptor_name);
        }

        if ($uniprot_accn) {
            $query->where('receptor.uniprot_accn', $uniprot_accn);
        }

        if ($genbank_accn) {
            $query->where('receptor.genbank_accn', $genbank_accn);
        }

        $query->orderBy('pubchem_id');

        $odorants = $query->get();

        return compact('odorants');
    }
}
