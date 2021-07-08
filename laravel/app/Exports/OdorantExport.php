<?php

namespace App\Exports;

use App\Models\FunctionalGroup;
use App\Models\Odor;
use App\Models\Odorant;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class OdorantExport implements FromView
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

        return view('exports.odorant', $data);
    }

    private function prepareResult()
    {
        $chemicalType = 1;
        $odorless = 0;

        $odorId = $this->searchParam['odor'] ?? null;
        $subOdorId = $this->searchParam['sub_odor'] ?? null;
        $casrn = $this->searchParam['casrn'] ?? null;
        $smiles = $this->searchParam['smiles'] ?? null;
        $functionalGroupId = $this->searchParam['functional_group'] ?? null;
        $mol_wt_from = $this->searchParam['mol_wt_from'] ?? null;
        $mol_wt_to = $this->searchParam['mol_wt_to'] ?? null;

        $odors = Odor::all();
        $subOdors = null;
        $functionalGroups = FunctionalGroup::all();

        if ($odorId) {
            $subOdors = DB::table('sub_odor_odors')
                ->where('odor_id', $odorId)
                ->leftJoin('sub_odor', 'sub_odor_odors.subodor_id', '=', 'sub_odor.id')
                ->get();
        }

        $query = Odorant::where('odorant', $chemicalType);

        if ($subOdorId) {
            $query->rightJoin('odorant_sub_odors', 'odorant_sub_odors.odorant_id', '=', 'odorant.id')
                ->where('odorant_sub_odors.subodor_id', $subOdorId);
        }

        if ($casrn) {
            $query->where('odorant.casrn', $casrn);
        }

        if ($smiles) {
            $query->where('odorant.smiles', 'LIKE', "%{$smiles}%");
        }

        if ($functionalGroupId) {
            $query->rightJoin('functional_group_odorants', 'functional_group_odorants.odorant_id', '=', 'odorant.id')
                ->where('functional_group_odorants.functionalgroup_id', $functionalGroupId);
        }

        if ($mol_wt_from && $mol_wt_to) {
            $query->whereBetween('odorant.mol_weight', [$mol_wt_from, $mol_wt_to]);
            $query->orderBy('odorant.mol_weight');
        }

        $odorants = $query->get();

        return compact(
            'odorants',
            'odors',
            'subOdors',
            'functionalGroups',
            'odorless'
        );
    }

}
