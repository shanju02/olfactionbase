<?php

namespace App\Http\Controllers;

use App\Models\Receptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrOdorantController extends Controller
{
    public function index(Request $request)
    {
        $casrn = $request->get('casrn');
        $pubchem_id = $request->get('pubchem_id');
        $receptor_name = $request->get('receptor_name');
        $uniprot_accn = $request->get('uniprot_accn');
        $genbank_accn = $request->get('genbank_accn');

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

        $odorants = $query->paginate(25)->withQueryString();

        return view('or-odorant-pairs.index', compact('odorants'));
    }

    public function view(Receptor $receptor)
    {
        return view('receptor.detail', compact('receptor'));
    }

    function getEvidences(Request $request)
    {
        $query = DB::table('evidences_new');
        $query->leftJoin('evidences', 'evidences.id', '=', 'evidences_new.evidence_id');

        $query->where('evidences_new.odorant_id', $request->get('odorant_id'));
        $query->where('evidences_new.receptor_id', $request->get('receptor_id'));

        return $query->get();
    }
}
