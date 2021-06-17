<?php

namespace App\Http\Controllers;

use App\Models\Odor;
use App\Models\SubOdor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdorController extends Controller
{
    public function index(Request $request)
    {
        $odors = Odor::all();
        if ($request->get('odor')) {
            $odorId = $request->get('odor');
            $primaryOrderName = $odors->where('id', $odorId)->first()->name;
        } else {
            $odorId = $odors[0]['id'];
            $primaryOrderName = $odors[0]['name'];
        }

        $subOdors = DB::table('sub_odor_odors')
            ->where('odor_id', $odorId)
            ->leftJoin('sub_odor', 'sub_odor_odors.subodor_id', '=', 'sub_odor.id')
            ->get();

        if ($request->get('subodor')) {
            $subOdorId = [$request->get('subodor')];
        } else {
            $subOdorId = $subOdors->map(function ($subOdor) {
                return $subOdor->id;
            });
        }

        $query = DB::table('odorant_sub_odors');

        if ($subOdorId) {
            $query->whereIn('odorant_sub_odors.subodor_id', $subOdorId);
        }

        $odorants = $query->leftJoin('odorant', 'odorant_sub_odors.odorant_id', '=', 'odorant.id')
            ->leftJoin('sub_odor', 'odorant_sub_odors.subodor_id', '=', 'sub_odor.id')
            ->paginate(25)
            ->withQueryString();

        return view('odor.index', compact('odors', 'subOdors', 'odorants', 'primaryOrderName'));
    }

    public function odorWiseSubOdors(Odor $odor): JsonResponse
    {
        $subOdors = $odor->subOdors;
        return response()->json($subOdors);
    }
}
