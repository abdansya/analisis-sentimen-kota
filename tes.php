<?php
set_time_limit (0);

include_once 'function/f_knn.php';

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

$knn = new Knn();
// $knn->bobot_widf_kata_training();
// $knn->bobot_widf_dokumen_training();
// $knn->bobot_widf_kata_testing();
// $knn->bobot_widf_dokumen_testing();

$knn->klasifikasi_sentimen_knn_training_tes();



$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo "Selesai dalam ".$total_time." detik";

$knn->akurasi($total_time);

?>