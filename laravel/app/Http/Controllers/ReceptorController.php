<?php

namespace App\Http\Controllers;

use App\Models\Receptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceptorController extends Controller
{
    public function index(Request $request)
    {
        $genBank = $request->get('gen_bank');
        $organism = $request->get('organism');
        $chromosome = $request->get('chromosome');
        $family = $request->get('family');
        $seqLengthFrom = $request->get('seq_length_from');
        $seqLengthTo = $request->get('seq_length_to');

        if ($seqLengthFrom) {
            if (!$seqLengthTo) {
                return back()->withInput()->withErrors('Please select lower & upper limit for length.');
            }
        }

        if ($seqLengthTo) {
            if (!$seqLengthFrom) {
                return back()->withInput()->withErrors('Please select lower & upper limit for length.');
            }
        }

        $query = Receptor::with('interactingOdorants');

        if ($genBank) $query->where('genbank_accn', $genBank);
        if ($organism) $query->where('organism', $organism);
        if ($chromosome) $query->where('chromosome', $chromosome);
        if ($family) $query->where('family', $family);
        if ($seqLengthFrom && $seqLengthTo) $query->whereBetween('length', [$seqLengthFrom, $seqLengthTo]);

        $receptors = $query->paginate(25)->withQueryString();

        return view('receptor.index', compact('receptors'));
    }

    public function view(Receptor $receptor)
    {
        $odorantsJson = $this->getOdorantsJson($receptor->id, $receptor->name) ;

        $evidences = $this->getEvidences($receptor->id)->unique('id');

        return view('receptor.detail', compact('receptor', 'odorantsJson', 'evidences'));
    }

    private function getOdorantsJson($receptor_id, $name)
    {
        $odorants = DB::table('receptor_odorants')
            ->where('receptor_odorants.receptor_id', $receptor_id)
            ->leftJoin('odorant', 'receptor_odorants.odorant_id', '=', 'odorant.id')
            ->get();

        $odorantsArray = [
            'id' => $receptor_id,
            'name' => $name,
            'children' => []
        ];

        foreach ($odorants as $odorant) {
            array_push($odorantsArray['children'], [
                'id' => $odorant->id,
                'name' => $odorant->casrn,
            ]);
        }

        return json_encode($odorantsArray);
    }

    private function getEvidences($receptor_id)
    {
        $query = DB::table('evidences_new');
        $query->where('evidences_new.receptor_id', $receptor_id);
        $query->leftJoin('evidences', 'evidences.id', '=', 'evidences_new.evidence_id');

        return $query->get();
    }
}
