<?php
require_once 'function/f_naivebayes.php';
require_once 'function/koneksi_procedural.php';
require_once 'function/koneksi.php';
require_once 'function/f_knn.php';

$o_koneksi = new Koneksi();
if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'akurasi' ) {
  $nb = new Naive_bayes();

  $sql_batas = $o_koneksi->con->query("SELECT `threshold`,`akurasi` FROM `data_akurasi` ORDER BY `threshold` ASC LIMIT 1");
  while ($row = $sql_batas->fetch_array()) {
    $batas = $row['threshold'];
    $akurasi_akhir = $row['akurasi'];
  }
  if (!isset($batas)) {
    $batas = 46374;
    $akurasi_akhir = 1;
  } elseif (isset($batas)) {
    if ($akurasi_akhir != 0) {
      $batas-=500;
    }
  }
  $query_perulangan = $o_koneksi->con->query("SELECT count(`id_akurasi`) FROM `data_akurasi`");
  $row_perulangan = $query_perulangan->fetch_row();
  $perualangan = 10 -  $row_perulangan[0];
  
  for ($i=0; $i < $perualangan; $i++) {

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

    $nb->akurasi($batas, $total_time, $akurasi_akhir);
    $batas -= 500;
    $akurasi_akhir++;
  }
  header('Location: training-akurasi.php');
} else if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'akurasi_knn') {
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $start = $time;

  $knn = new Knn();
  $knn->klasifikasi_sentimen_knn_training_tes();
  
  $time = microtime();
  $time = explode(' ', $time);
  $time = $time[1] + $time[0];
  $finish = $time;
  $total_time = round(($finish - $start), 4);
  
  $knn->akurasi($total_time);
  header('Location: training-akurasi-knn.php');
}

function data_akurasi() {
	GLOBAL $con;
	$query = "SELECT * FROM `data_akurasi`";
	$hasil = mysqli_query($con, $query);
	return $hasil;
}

function data_akurasi_knn() {
  GLOBAL $con;
  $query = "SELECT * FROM `data_akurasi_knn`";
  $hasil = mysqli_query($con, $query);
  return $hasil;
}

?>
