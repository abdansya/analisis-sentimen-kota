<?php
include_once '../function/f_knn.php';

if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'bobot_knn') {
	$knn = new Knn();
	// $knn->bobot_widf_kata_training();
	// $knn->bobot_widf_dokumen_training();
	$knn->bobot_widf_kata_testing();
	$knn->bobot_widf_dokumen_testing();

	$knn->klasifikasi_sentimen_knn();
	header("Location: http://localhost/ansen-kota/proses-klasifikasi-knn.php");
}


?>