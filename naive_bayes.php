<?php

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;



include_once 'function/f_naivebayes.php';
$nb = new Naive_bayes();
// $nb->set_probabilitas_kata_positif();
// $nb->set_probabilitas_kata_negatif();
// $nb->get_jml_kata_positif();
// $nb->get_jml_kata_negatif();
// $nb->get_jml_semua_kata_unik();
// $nb->get_probabilitas_kategori_positf();
// $nb->get_probabilitas_kategori_negatif();
// $nb->klasifikasi_sentimen();
$nb->klasifikasi_sentimen_ig(2000);
$nb->akurasi();



echo "<hr>";
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo "Selesai dalam ".$total_time." detik";


?>