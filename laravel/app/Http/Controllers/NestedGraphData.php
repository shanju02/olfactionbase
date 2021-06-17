<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NestedGraphData extends Controller
{
    public function index(Request $request, $type, $page)
    {
        if ($type === 'category') {
            return response()->json($this->getCategoryData($page));
        } elseif ($type === 'odor') {
            return response()->json($this->getOdorData($page));
        } elseif ($type === 'sub-odor') {
            return response()->json($this->getSubOdorData($page));
        } elseif ($type === 'odorant') {
            return response()->json($this->getOdorantData($page));
        }
    }

    private function getCategoryData($id)
    {
        $category = DB::table('category')->where('id', $id)->first();

        $categoryChildrens =  DB::select("SELECT odcat.id, cat.id as category_id, od.id as odor_id, cat.name as category_name, od.name as odor_name, od.color as odor_color from odor_category AS odcat LEFT JOIN odor as od ON od.id = odcat.odor_id LEFT JOIN category AS cat ON odcat.category_id = cat.id where odcat.category_id = '".$category->id."' ORDER BY category_id");

        $subCat = [];
        foreach ($categoryChildrens as $categoryChildren) {
            array_push($subCat, [
                'id' => "subCatId".$categoryChildren->odor_id,
                "name" => $categoryChildren->odor_name,
                "page" => $categoryChildren->odor_id,
                "type" => "odor",
                "color" => $categoryChildren->odor_color,
                "children" => []
            ]);
        }

        $mainJson["olfaction"] = [
            "name" => "Olfaction",
            "id" => 0,
            "page" => 0,
            "type" => "root",
            "children" => [
                [
                    "id" => $category->id,
                    "name" => $category->name,
                    "color" => $category->color,
                    "page" => "category",
                    "type" => $category->id,
                    "children" => $subCat
                ]
            ]
        ];

        $mainJson["network"] = [];

        return $mainJson;
    }

    private function getOdorData($id): array
    {
        $odor = DB::table('odor')->where('id', $id)->first();

        $odorChildrens =  DB::select("SELECT subodod.id, od.id as odor_id, subod.id as subodor_id, od.name as odor_name, subod.name as subodor_name, subod.color as subodor_color from sub_odor_odors AS subodod LEFT JOIN odor as od ON od.id = subodod.odor_id LEFT JOIN sub_odor AS subod ON subodod.subodor_id = subod.id where subodod.odor_id = ".$odor->id." ORDER BY `odor_id` ASC");

        $childOdor = [];
        foreach ($odorChildrens as $odorChildren) {
            array_push($childOdor, [
                'id' => "subOdorId".$odorChildren->subodor_id,
                "name" => $odorChildren->subodor_name,
                "page" => $odorChildren->subodor_id,
                "type" => "sub-odor",
                "color" => $odorChildren->subodor_color,
                "children" => []
            ]);
        }

        $odorParents = DB::table('odor_category')
            ->where('odor_id', $odor->id)
            ->leftJoin('category', 'category.id', 'odor_category.category_id')
            ->get();

        $parent = [];
        $mainJson["olfaction"] = [
            "name" => "Olfaction",
            "id" => 0,
            "page" => 0,
            "type" => "root",
            'children' => []
        ];

        $mainJson["network"] = [];

        $i = 1;
        foreach ($odorParents as $odorParent) {
            if ($i > 0) {
                $grandChildren = [
                    [
                        "id" => "odorId".$odor->id,
                        "name" => $odor->name,
                        "color" => $odor->color,
                        "page" => $odor->id,
                        "type" => "odor",
                        "children" => $childOdor
                    ]
                ];
            } else {
                $grandChildren = [];

                array_push($mainJson["network"], [
                    "source" => "odorId".$odor->id,
                    "target" => "categoryId".$odorParent->category_id,
                    "name" => $odorParent->name
                ]);
            }

            if ($i < 1) {

            }

            array_push($mainJson["olfaction"]['children'], [
                'id' => "categoryId".$odorParent->category_id,
                "name" => $odorParent->name,
                "page" => $odorParent->category_id,
                "type" => "category",
                "color" => $odorParent->color,
                "children" => $grandChildren
            ]);
            $i--;
        }



        return $mainJson;
    }

    private function getSubOdorData($id)
    {
        $subOdor = DB::table('sub_odor')->where('id', $id)->first();

        $subOdorChildrens =  DB::table('odorant_sub_odors')
            ->where('odorant_sub_odors.subodor_id', $subOdor->id)
            ->leftJoin('odorant', 'odorant_sub_odors.odorant_id', '=', 'odorant.id')
            ->get();

        $childOdorant = [];
        foreach ($subOdorChildrens as $subOdorChildren) {
            array_push($childOdorant, [
                'id' => "odorantId".$subOdorChildren->odorant_id,
                "name" => $subOdorChildren->casrn,
                "page" => $subOdorChildren->odorant_id,
                "type" => "odorant",
                "color" => $subOdorChildren->color,
                "children" => []
            ]);
        }

        $subOdorParents = DB::table('sub_odor_odors')
            ->where('subodor_id', $subOdor->id)
            ->leftJoin('odor', 'odor.id', 'sub_odor_odors.odor_id')
            ->get();

        $parent = [];
        $mainJson["olfaction"] = [
            "name" => "Olfaction",
            "id" => 0,
            "page" => 0,
            "type" => "root",
            'children' => []
        ];

        $mainJson["network"] = [];

        $i = 1;
        foreach ($subOdorParents as $subOdorParent) {
            if ($i > 0) {
                $grandChildren = [
                    [
                        "id" => "subOdorId" . $subOdor->id,
                        "name" => $subOdor->name,
                        "color" => $subOdor->color,
                        "page" => $subOdor->id,
                        "type" => "sub-odor",
                        "children" => $childOdorant
                    ]
                ];
            } else {
                $grandChildren = [];

                array_push($mainJson["network"], [
                    "source" => "subOdorId".$subOdor->id,
                    "target" => "odorId".$subOdorParent->odor_id,
                    "name" => $subOdorParent->name
                ]);
            }

            $i--;

            array_push($mainJson["olfaction"]['children'], [
                'id' => "odorId".$subOdorParent->odor_id,
                "name" => $subOdorParent->name,
                "page" => $subOdorParent->odor_id,
                "type" => "odor",
                "color" => $subOdorParent->color,
                "children" => $grandChildren
            ]);
        }

        return $mainJson;
    }

    private function getOdorantData($id)
    {
        echo "Odorant Id: " . $id;
    }
}
