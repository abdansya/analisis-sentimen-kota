<?php
require_once 'function/koneksi_procedural.php';
require_once 'function/f_preprocessing.php';
require_once 'function/vendor/autoload.php';

$o_koneksi = new Koneksi();
$o_preprocessing = new Preprocessing();

$data_tweet = [];
if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'prepro') {
  $query = "SELECT `id_training`,`tweet` FROM `data_training` ORDER BY `id_training` ASC";;

  $result = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result)) {
    $id_tweet = trim($row['id_training']);
    $tweet = $o_preprocessing->input($row['tweet']);
    //sleep(0.2);
    $query_simpan = "UPDATE `data_training` SET `tweet_preprocessing` = '".$tweet."' WHERE `id_training` = ".$id_tweet."";

    $hasil = mysqli_query($con, $query_simpan);
    if ($hasil) {
      // echo "  <b style='color: blue'> Berhasil</b>";
    } else {
      // echo "  <b style='color: red'> Gagal</b>";
    }
  }
  header('Location: http://localhost/ansen-kota/training-preprocessing.php');
}

function data_training() {
	GLOBAL $con;
	$query = "SELECT * FROM `data_training`";
	$hasil = mysqli_query($con, $query);
	return $hasil;
}

?>
