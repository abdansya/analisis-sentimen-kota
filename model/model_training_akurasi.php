<?php
require_once 'function/f_naivebayes.php';
require_once 'function/koneksi_procedural.php';

if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'akurasi' ) {
  $nb = new Naive_bayes();

  $batas = 30904;
  for ($i=0; $i < 10 ; $i++) {
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
  header('Location: http://localhost/ansen-kota/training-akurasi.php');
}

function data_akurasi() {
	GLOBAL $con;
	$query = "SELECT * FROM `data_akurasi`";
	$hasil = mysqli_query($con, $query);
	return $hasil;
}

?>
