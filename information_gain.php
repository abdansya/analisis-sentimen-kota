<?php 
include 'function/f_informationgain.php';

$info_gain = new Information_gain();
// echo $info_gain->get_jumlah_tweet_positif();
// $info_gain->set_jumlah_kata_ya_p();
// $info_gain->set_jumlah_kata_ya_n();
// $info_gain->set_jumlah_semuakata_ya();
// $info_gain->set_jumlah_kata_tidak_n();
// $info_gain->set_jumlah_semuakata_tidak();
// $info_gain->set_entropy_kata_ya();
// $info_gain->set_entropy_kata_tidak();
// echo $info_gain->entropy_kata();
// echo $info_gain->entropy_set($info_gain->get_jumlah_positif(), $info_gain->get_jumlah_negatif(), $info_gain->get_jumlah_total());
// $info_gain->set_info_gain();
$info_gain->prepro_info_gain(3900);



?>