<?php

namespace App\Http\Controllers;

use App\Exports\OdorantExport;
use App\Exports\OdorlessExport;
use App\Models\FunctionalGroup;
use App\Models\Odor;
use App\Models\Odorant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OdorantController extends Controller
{
    public function index(Request $request, $type = null)
    {
        if ($request->get('odor')) {
            if (!$request->get('sub_odor')) {
                return redirect()->back()->withErrors('Please select both Odor & Sub-Odor.');
            }
        }

        if ($request->get('sub_odor')) {
            if (!$request->get('odor')) {
                return redirect()->back()->withErrors('Please select both Odor & Sub-Odor.');
            }
        }

        if ($request->get('mol_wt_from')) {
            if (!$request->get('mol_wt_to')) {
                return redirect()->back()->withErrors('Please select lower & upper limit for Molecular Weight.');
            }
        }

        if ($request->get('mol_wt_to')) {
            if (!$request->get('mol_wt_from')) {
                return redirect()->back()->withErrors('Please select lower & upper limit for Molecular Weight.');
            }
        }

        $chemicalType = 1;
        $odorless = 0;

        if ($type) {
            $chemicalType = 0;
            $odorless = 1;
        }

        $odorId = $request->get('odor');
        $subOdorId = $request->get('sub_odor');
        $casrn = $request->get('casrn');
        $smiles = $request->get('smiles');
        $functionalGroupId = $request->get('functional_group');
        $mol_wt_from = $request->get('mol_wt_from');
        $mol_wt_to = $request->get('mol_wt_to');

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

        $odorants = $query->paginate(25)->withQueryString();

        return view('odorant.index', compact(
            'odorants',
            'odors',
            'subOdors',
            'functionalGroups',
            'odorless'
        ));
    }

    private function validateSearchFields(Request $request)
    {
        if ($request->get('odor')) {
            if (!$request->get('sub_odor')) {
                return redirect()->back()->withErrors('Please select Odor & Sub-Odor.');
            }
        }

        return true;
    }

    public function view(Odorant $odorant)
    {
        $odorsJson = $this->getOdorantsJson($odorant->id, $odorant->casrn);
        $receptorsJson = $this->getReceptorsJson($odorant->id, $odorant->casrn) ;
        $evidences = $this->getEvidences($odorant->id)->unique('id');

        return view('odorant.detail', compact('odorant', 'odorsJson', 'receptorsJson', 'evidences'));
    }

    private function getOdorantsJson($odorant_id, $casrn)
    {
        $odors = DB::table('odorant_sub_odors')
            ->where('odorant_sub_odors.odorant_id', $odorant_id)
            ->leftJoin('sub_odor', 'odorant_sub_odors.subodor_id', '=', 'sub_odor.id')
            ->get();

        $odorsArray = [
            'id' => $odorant_id,
            'name' => $casrn,
            'children' => []
        ];

        if (count($odors)) {
            foreach ($odors as $odor) {
                $parentOdor = DB::table('sub_odor_odors')
                    ->where('subodor_id', $odor->subodor_id)
                    ->first();

                array_push($odorsArray['children'], [
                    'id' => $odor->subodor_id,
                    'odor_id' => $parentOdor->odor_id,
                    'name' => $odor->name,
                    'type' => 'subOdor'
                ]);
            }
        }


        return json_encode($odorsArray);
    }

    private function getReceptorsJson($receptor_id, $name)
    {
        $receptors = DB::table('receptor_odorants')
            ->where('receptor_odorants.odorant_id', $receptor_id)
            ->leftJoin('receptor', 'receptor_odorants.receptor_id', '=', 'receptor.id')
            ->get();

        $receptorsArray = [
            'id' => $receptor_id,
            'name' => $name,
            'children' => []
        ];

        if (count($receptors)) {
            foreach ($receptors as $receptor) {
                array_push($receptorsArray['children'], [
                    'id' => $receptor->id,
                    'name' => $receptor->name,
                    'type' => 'receptor'
                ]);
            }
        }

        return json_encode($receptorsArray);
    }

    private function getEvidences($odorant_id)
    {
        $query = DB::table('evidences_new');
        $query->where('evidences_new.odorant_id', $odorant_id);
        $query->leftJoin('evidences', 'evidences.id', '=', 'evidences_new.evidence_id');

        return $query->get();
    }

    public function getSubOdorWiseOdorant($subodor_id)
    {
        $odorantQuery = DB::table('odorant_sub_odors')
            ->where('odorant_sub_odors.subodor_id', $subodor_id)
            ->leftJoin('odorant', 'odorant_sub_odors.odorant_id', '=', 'odorant.id')
            ->get();

        $odorantArray = [];

        if (count($odorantQuery)) {
            foreach ($odorantQuery as $odorant) {
                array_push($odorantArray, [
                    'id' => $odorant->odorant_id,
                    'page' => $odorant->odorant_id,
                    'type' => 'odorant',
                    'name' => $odorant->casrn,
                    'children' => []
                ]);
            }
        }

        return json_encode($odorantArray);
    }

    public function exportOdorant(Request $request)
    {
        return Excel::download(new OdorantExport($request->query()), 'chemicals-odorant.xlsx');
    }

    public function exportOdorless(Request $request)
    {
        return Excel::download(new OdorlessExport($request->query()), 'chemicals-odorless.xlsx');
    }
}
