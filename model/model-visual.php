<?php
require_once '../function/koneksi.php';
/**
 *
 */
class DataVisualisasi extends Koneksi {

  public function getJsonJenis($jenis_sentimen) {
    header("Content-type:application/json");
    $response = [];
    $response['data'] = [];
    $response['tanggal'] = [];
    $data_sentimen = [];
    $data_kota = [];
    $kota = [];
    $index = 0;
    $query_kota = $this->con->query("SELECT * FROM `tb_kota` ORDER BY `id` ASC");
    while ($hasil_kota = $query_kota->fetch_array()) {
      $kota = $hasil_kota['kota'];
      $id_kota = $hasil_kota['id'];
      $data_kota[$kota] = [];

      $data_sentimen['sentimenPositif'] = [];
      $data_sentimen['sentimenNegatif'] = [];
      for ($i=7; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' days', strtotime( $last_date )));
        $tampil_tanggal_crawling = date('d M Y', strtotime('-'.$i.' days', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'P' AND `id_jenis` = $jenis_sentimen AND `id_kota` = $id_kota");

        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'N' AND `id_jenis` = $jenis_sentimen AND `id_kota` = $id_kota");
        $row_negatif = $query_negatif->fetch_row();
        $jumlah_negatif = $row_negatif[0];

        array_push($data_sentimen['sentimenPositif'], $jumlah_positif);
        array_push($data_sentimen['sentimenNegatif'], $jumlah_negatif);
        if ($index<1) {
          array_push($response['tanggal'], $tampil_tanggal_crawling);
        }
      }
      $index++;
      $data_kota[$kota] = $data_sentimen;
    }
    $response['data'] = $data_kota;
    return json_encode($response);
  }

  public function getJsonKota($id_kota) {
    header("Content-type:application/json");
    $response = [];
    $response['data'] = [];
    $response['tanggal'] = [];
    $data_sentimen = [];
    $data_jenis = [];
    $index = 0;
    $query_jenis = $this->con->query("SELECT * FROM `tb_jenis_sentimen` ORDER BY `id` ASC");
    while ($hasil_jenis = $query_jenis->fetch_array()) {
      $jenis_sentimen = $hasil_jenis['jenis_sentimen'];
      $id_jenis = $hasil_jenis['id'];
      $data_jenis[$jenis_sentimen] = [];
      $data_sentimen['sentimenPositif'] = [];
      $data_sentimen['sentimenNegatif'] = [];
      for ($i=7; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' days', strtotime( $last_date )));
        $tampil_tanggal_crawling = date('d M Y', strtotime('-'.$i.' days', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'P' AND `id_jenis` = $id_jenis AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'N' AND `id_jenis` = $id_jenis AND `id_kota` = $id_kota");
        $row_negatif = $query_negatif->fetch_row();
        $jumlah_negatif = $row_negatif[0];

        array_push($data_sentimen['sentimenPositif'], (int)$jumlah_positif);
        array_push($data_sentimen['sentimenNegatif'], (int)$jumlah_negatif);
        if ($index<1) {
          array_push($response['tanggal'], $tampil_tanggal_crawling);
        }
      }
      $index++;
      $data_kota[$jenis_sentimen] = $data_sentimen;
    }
    $response['data'] = $data_kota;
    return json_encode($response);
  }

  public function getJsonKategoriKota($id_kota) {
    header("Content-type:application/json");
    $response = [];
    $response['data'] = [];
    $response['tanggal'] = [];
    $data_sentimen = [];
    $data_kategori = [];
    $index = 0;
    $query_kategori = $this->con->query("SELECT * FROM `tb_kategori` ORDER BY `id` ASC");
    while ($hasil_kategori = $query_kategori->fetch_array()) {
      $kategori_sentimen = $hasil_kategori['kategori'];
      $id_kategori = $hasil_kategori['id'];
      $data_kategori[$kategori_sentimen] = [];
      $data_sentimen['sentimenPositif'] = [];
      $data_sentimen['sentimenNegatif'] = [];
      for ($i=7; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' days', strtotime( $last_date )));
        $tampil_tanggal_crawling = date('d M Y', strtotime('-'.$i.' days', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'P' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `sentimen` = 'N' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_negatif = $query_negatif->fetch_row();
        $jumlah_negatif = $row_negatif[0];

        array_push($data_sentimen['sentimenPositif'], (int)$jumlah_positif);
        array_push($data_sentimen['sentimenNegatif'], (int)$jumlah_negatif);
        if ($index<1) {
          array_push($response['tanggal'], $tampil_tanggal_crawling);
        }
      }
      $index++;
      $data_kota[$kategori_sentimen] = $data_sentimen;
    }
    $response['data'] = $data_kota;
    return json_encode($response);
  }

}

$data = new DataVisualisasi();
// echo($data->getJsonJenis(11));
// echo($data->getJsonKota(42));
echo($data->getJsonKategoriKota(42));



// $response = [];
// $response['data'] = [];
// $data_sentimen = [];
// $data_kota = [];
// $sentimens = ['positif', 'negatif'];
// $kota = ['Batu','Malang','Surabaya','Madiun'];
//
// foreach ($kota as $kota) {
//   $data_kota[$kota] = [];
//   foreach ($sentimens as $sentimen) {
//     $data_sentimen[$sentimen] = [];
//     for ($j=1; $j < 7; $j++) {
//       array_push($data_sentimen[$sentimen], $j);
//     }
//   }
//   $data_kota[$kota] = $data_sentimen;
// }
// $response['data'] = $data_kota;
// echo json_encode($response);

?>
