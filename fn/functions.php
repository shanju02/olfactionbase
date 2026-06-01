<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}

function checkArray($name, $array)
{
    return array_search($name, array_column($array, 'name'));

}

function wheelB($conn, $category_id, $parent_id)
{
    $wheel = [];
    $odorSql = "SELECT odcat.id, cat.id as category_id, od.id as odor_id, cat.name as category_name, od.name as odor_name, od.color as odor_color from odor_category AS odcat LEFT JOIN odor as od ON od.id = odcat.odor_id LEFT JOIN category AS cat ON odcat.category_id = cat.id where odcat.category_id = '".$category_id."' ORDER BY category_id";

    $odorResult = $conn->query($odorSql);
    while($rowOdor = $odorResult->fetch_assoc()) {
        if (key_exists($rowOdor['odor_name'], $GLOBALS["nodesB"])) {
            array_push($GLOBALS['relatedNodes'], [
                "target" => $parent_id,
                "source" => $GLOBALS["nodesB"][$rowOdor['odor_name']]['child_id'],
                "name" => $rowOdor['odor_name'],
            ]);
        } else {
            $GLOBALS["nodesB"][$rowOdor['odor_name']] = [
                'parent_id' => $parent_id,
                'child_id' => "B".$GLOBALS["idB"]
            ];
            //array_push($GLOBALS["nodesB"], $rowOdor['odor_name']);
            array_push($wheel, [
                'id' => "B".$GLOBALS["idB"],
                'page' => $rowOdor["odor_id"],
                'type' => 'odor',
                'name' => $rowOdor['odor_name'],
                'color' => $rowOdor["odor_color"],
                'children' => wheelC($conn, $rowOdor['odor_id'],"B".$GLOBALS["idB"])
            ]);
        }

        $GLOBALS["idB"]++;
    }

    return $wheel;
}

function wheelC($conn, $odor_id, $parent_id)
{
    $wheel = [];
    $sql = "SELECT subodod.id, od.id as odor_id, subod.id as subodor_id, od.name as odor_name, subod.name as subodor_name, subod.color as subodor_color from sub_odor_odors AS subodod LEFT JOIN odor as od ON od.id = subodod.odor_id LEFT JOIN sub_odor AS subod ON subodod.subodor_id = subod.id where subodod.odor_id = ".$odor_id." ORDER BY `odor_id` ASC";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        if (key_exists($row['subodor_name'], $GLOBALS["nodesC"])) {
            array_push($GLOBALS['relatedNodes'], [
                "target" => $parent_id,
                "source" => $GLOBALS["nodesC"][$row['subodor_name']]['child_id'],
                "name" => $row['subodor_name'],
            ]);
        } else {
            $GLOBALS["nodesC"][$row['subodor_name']] = [
                'parent_id' => $parent_id,
                'child_id' => "C".$GLOBALS["idC"]
            ];
            array_push($wheel, [
                'id' => "C".$GLOBALS["idC"],
                'page' => $row["subodor_id"],
                'type' => 'sub-odor',
                'name' => $row['subodor_name'],
                'color' => $row["subodor_color"],
                //'children' => wheelD($conn, $row['subodor_id'], "C".$GLOBALS["idC"])
                //'children' => []
            ]);
        }
        $GLOBALS["idC"]++;
    }

    return $wheel;
}

function wheelD($conn, $sub_odor_id, $parent_id)
{
    $wheel = [];
    $sql = "SELECT subodfng.id, fng.id as functional_group_id, subod.id as sub_odor_id, fng.name as functional_group_name, subod.name as sub_odor_name from subodor_functional_group AS subodfng LEFT JOIN functional_group as fng ON subodfng.functional_group_id = fng.id LEFT JOIN sub_odor AS subod ON subodfng.sub_odor_id = subod.id where subodfng.sub_odor_id = ".$sub_odor_id." ORDER BY `sub_odor_id` ASC";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        if (key_exists($row['functional_group_name'], $GLOBALS["nodesD"])) {
            array_push($GLOBALS['relatedNodes'], [
                "source" => $parent_id,
                "target" => $GLOBALS["nodesD"][$row['functional_group_name']]['child_id'],
                "name" => $row['functional_group_name'],
            ]);
        } else {
            $GLOBALS["nodesD"][$row['functional_group_name']] = [
                'parent_id' => $parent_id,
                'child_id' => "D".$GLOBALS["idD"]
            ];

            array_push($wheel, [
                'id' => "D".$GLOBALS["idD"],
                'name' => $row['functional_group_name'],
                'children' => []
            ]);

        }
        $GLOBALS["idD"]++;
    }

    return $wheel;
}

$data = [];
$nodes = [];
$links = [];
$idA = 1;
$idB = 1;
$idC = 1;
$idD = 1;
$nodesA = [];
$nodesB = [];
$nodesC = [];
$nodesD = [];
$relatedNodes = [];

$conn = new mysqli("localhost","bishal","MnC@2030","olfactionbase_main");

// Check connection
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}

$categorySql = "select * from category";

$categoryResult = $conn->query($categorySql);

$nodes['name'] = 'Olfaction';
$nodes['type'] = 'root';
$nodes['children'] = [];

if ($categoryResult->num_rows > 0) {
    while($rowCategory = $categoryResult->fetch_assoc()) {
        array_push($nodes['children'], [
                'id' => "A".$idA,
                'page' => $rowCategory["id"],
                'type' => 'category',
                'name' => $rowCategory["name"],
                'color' => $rowCategory["color"],
                "children" => wheelB($conn, $rowCategory["id"], "A".$idA)]
        );
        $idA++;
    }
}

$conn->close();

$data['olfaction'] = $nodes;
$data['network'] = $relatedNodes;

$jsonData = json_encode($data);

$myfile = fopen("../wheel/olfaction.json", "w") or die("Unable to open file!");
fwrite($myfile, $jsonData);
fclose($myfile);

echo "<pre>".$jsonData."</pre>";
