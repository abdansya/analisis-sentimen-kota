<?php 
require_once('model_visual.php');

$data = new DataVisualisasi();
// echo($data->getJsonJenis(11));
// echo($data->getJsonKota(42));
// echo($data->getJsonKategoriKota(42));
echo ($data->getJsonAkurasiKnn());

?>