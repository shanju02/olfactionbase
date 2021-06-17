<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProteinController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        $organism = $request->get('organism');
        $length_from = $request->get('length_from');
        $length_to = $request->get('length_to');

        if ($length_from) {
            if (!$length_to) {
                return back()->withInput()->withErrors('Please select lower & upper limit for length.');
            }
        }

        if ($length_to) {
            if (!$length_from) {
                return back()->withInput()->withErrors('Please select lower & upper limit for length.');
            }
        }

        $query = DB::table('protein');

        if ($name) {
            $query->where('name', $name);
        }

        if ($organism) {
            $query->where('organism', $organism);
        }

        if ($length_from && $length_to) {
            $query->whereBetween('length', [$length_from, $length_to]);
            $query->orderBy('length');
        }

        $proteins = $query->paginate(25)->withQueryString();

        $organisms = DB::table('protein')->distinct()->orderBy('organism')->get(['organism']);

        return view('protein.index', compact('proteins', 'organisms'));
    }
}
