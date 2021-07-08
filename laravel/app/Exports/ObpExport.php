<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ObpExport implements FromView
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

        return view('exports.obp', $data);
    }

    private function prepareResult() {
        $name = $this->searchParam['name'] ?? null;
        $organism = $this->searchParam['organism'] ?? null;
        $length_from = $this->searchParam['length_from'] ?? null;
        $length_to = $this->searchParam['length_to'] ?? null;

        $query = DB::table('protein')->where('length', '>', 100);

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

        $proteins = $query->get();

        $organisms = DB::table('protein')->distinct()->orderBy('organism')->get(['organism']);

        return compact('proteins', 'organisms');
    }
}
