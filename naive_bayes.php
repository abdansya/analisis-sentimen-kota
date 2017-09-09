<?php

include_once 'function/f_naivebayes.php';
$nb = new Naive_bayes();
// $nb->set_probabilitas_kata_positif();
// $nb->set_probabilitas_kata_negatif();
// $nb->get_jml_kata_positif();
// $nb->get_jml_kata_negatif();
// $nb->get_jml_semua_kata_unik();
// $nb->get_probabilitas_kategori_positif();
// $nb->get_probabilitas_kategori_negatif();
// $nb->klasifikasi_sentimen();


$batas = 4000;
for ($i=0; $i < 20 ; $i++) {
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $start = $time;

  $nb->klasifikasi_sentimen_ig($batas);

  echo "<hr>";
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $finish = $time;
  $total_time = round(($finish - $start), 4);
  echo "Selesai dalam ".$total_time." detik";

  $nb->akurasi($batas, $total_time);
  $batas -= 100;
}

?>
