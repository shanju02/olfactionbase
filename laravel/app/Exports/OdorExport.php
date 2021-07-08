<?php

namespace App\Exports;

use App\Models\Odor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OdorExport implements FromView
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

        return view('exports.odors', $data);
    }

    private function prepareResult() {
        $odors = Odor::all();
        if (isset($this->searchParam['odor'])) {
            $odorId = $this->searchParam['odor'];
            $primaryOrderName = $odors->where('id', $odorId)->first()->name;
        } else {
            $odorId = $odors[0]['id'];
            $primaryOrderName = $odors[0]['name'];
        }

        $subOdors = DB::table('sub_odor_odors')
            ->where('odor_id', $odorId)
            ->leftJoin('sub_odor', 'sub_odor_odors.subodor_id', '=', 'sub_odor.id')
            ->get();

        if (isset($this->searchParam['subodor'])) {
            $subOdorId = [$this->searchParam['subodor']];
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
            ->get();

        return [
            'primaryOdor' => $primaryOrderName,
            'odorants' => $odorants
        ];
    }
}
