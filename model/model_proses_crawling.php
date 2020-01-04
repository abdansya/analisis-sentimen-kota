<?php
require_once 'function/koneksi_procedural.php';
include_once 'function/f_crawlingtweet.php';
include_once 'function/f_tambahan.php';
$o_crawling = new Crawling();

if (isset($_GET['btsubmit'])) {
  $kata_kunci = "";
  $id_kota = null;
  $query_kota =  pilih_kota();
  while ($row = mysqli_fetch_assoc($query_kota)) {
    if (isset($_GET['katakunci']) && $_GET['katakunci'] == $row['kota'] && $_GET['btsubmit']) {
      $kata_kunci = $_GET['katakunci'];
      $id_kota = $row['id'];
      break;
    }
  }
  if ($kata_kunci == "") {
    ?>
    <script type="text/javascript">
      alert("Maaf kata kunci yang anda masukkan salah");
    </script>
    <?php
  }
  $query_jenis = pilih_jenis_sentimen();
  while ($data = mysqli_fetch_assoc($query_jenis)) {
    if ($kata_kunci != "" && $id_kota != null && $_GET['btsubmit'] == 'Proses') {
      $hasil_kata_kunci = $kata_kunci." ".$data['jenis_sentimen'];
      $o_crawling->get_tweet($hasil_kata_kunci, $id_kota, $data['id']);
    }
  }
  header("Location: http://localhost/ansen-kota/proses-crawling.php");
}

function data_crawling_testing() {
	GLOBAL $con;
	$tanggal_crawling = date('Y-m-d', strtotime('-8 days', strtotime( date('Y-m-d') )));
	$query = "SELECT * FROM `data_testing` WHERE `tanggal` > '".$tanggal_crawling."' ORDER BY `data_testing`.`id_tes` DESC";
	$hasil = mysqli_query($con, $query);
	return $hasil;
}


?>
