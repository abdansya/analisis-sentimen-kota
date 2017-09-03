<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

include_once 'function/f_crawlingtweet.php';
include_once 'function/f_preprocessing.php';
include_once 'function/f_naivebayes.php';
$o_koneksi = new Koneksi();
$o_crawling = new Crawling();
$o_preprocessing = new Preprocessing();
$o_naivebayes = new Naive_bayes();


if (isset($_GET['btsubmit']) && $_GET['btsubmit'] == 'craw') {
  $kata_kunci = "";
  $id_akun = null;
  if (isset($_GET['katakunci']) && $_GET['katakunci'] == 'lazadaid' && $_GET['btsubmit']) {
    $kata_kunci = $_GET['katakunci'];
    $id_akun = 1;
  } elseif (isset($_GET['katakunci']) && $_GET['katakunci'] == 'bukalapak' && $_GET['btsubmit']) {
    $kata_kunci = $_GET['katakunci'];
    $id_akun = 2;
  } elseif (isset($_GET['katakunci']) && $_GET['katakunci'] == 'tokopedia' && $_GET['btsubmit']) {
    $kata_kunci = $_GET['katakunci'];
    $id_akun = 3;
  } else {
    ?>
    <script type="text/javascript">
      alert("Maaf kata kunci yang anda masukkan salah");
    </script>
    <?php
  }
  if ($kata_kunci != "" && $id_akun != null) {
    $id_akun;
    $o_crawling->get_tweet($kata_kunci, $id_akun);
    $query = $o_koneksi->con->query("SELECT * FROM `data_testing` WHERE `sentimen` IS NULL");
    while ($row = $query->fetch_array()) {
      $id = $row['id_tes'];
      $tweet = $o_preprocessing->input($row['tweet']);
      $sentimen = $o_naivebayes->klasifikasi_sentimen_testing($tweet);
      $query_update = $o_koneksi->con->query("UPDATE `data_testing` SET `tweet_preprocessing` = '".$tweet."', `sentimen` = '".$sentimen."'  WHERE `id_tes` = ".$id."");
      // if ($query_update) {
      //   echo " berhasil";
      //   echo "<br>";
      // } else {
      //   echo mysqli_error($query_update);
      // }
    }
  }
}




// echo "<hr>";
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
// echo "Selesai dalam ".$total_time." detik";

?>
