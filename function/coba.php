<?php 
include_once 'koneksi.php';

$kata = "makan mandi sekali";
$kata = explode(" ", $kata);

$query_parts = [];
foreach ($kata as $val) {
    $query_parts[] = "'%".mysql_real_escape_string($val)."%'";
}

$string = implode(' OR url LIKE ', $query_parts);
$tank = "SELECT url FROM `PHP`.`db` WHERE url LIKE {$string}";
echo $tank;

?>