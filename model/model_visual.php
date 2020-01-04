<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ansen-kota/function/koneksi.php';
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

  public function getJsonKategoriKota($id_kota, $metode = 'sentimen') {
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

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `".$metode."` = 'P' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `".$metode."` = 'N' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
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

  public function getJsonKategoriKota_1bulan($id_kota, $metode = 'sentimen') {
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
      for ($i=30; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' days', strtotime( $last_date )));
        $tampil_tanggal_crawling = date('d M Y', strtotime('-'.$i.' days', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `".$metode."` = 'P' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE `tanggal` = '".$tanggal_crawling."' AND `".$metode."` = 'N' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
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

  public function getJsonKategoriKota_6bulan($id_kota, $metode = 'sentimen') {
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
      for ($i=5; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' month', strtotime( $last_date )));
        $bulan_crawling = date('M Y', strtotime('-'.$i.' month', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE MONTH(`tanggal`) = MONTH('".$tanggal_crawling."') AND `".$metode."` = 'P' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE MONTH(`tanggal`) = MONTH('".$tanggal_crawling."') AND `".$metode."` = 'N' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_negatif = $query_negatif->fetch_row();
        $jumlah_negatif = $row_negatif[0];

        array_push($data_sentimen['sentimenPositif'], (int)$jumlah_positif);
        array_push($data_sentimen['sentimenNegatif'], (int)$jumlah_negatif);
        if ($index<1) {
          array_push($response['tanggal'], $bulan_crawling);
        }
      }
      $index++;
      $data_kota[$kategori_sentimen] = $data_sentimen;
    }
    $response['data'] = $data_kota;
    return json_encode($response);
  }

  public function getJsonKategoriKota_12bulan($id_kota, $metode = 'sentimen') {
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
      for ($i=11; $i>=0 ; $i--) {
        $query_tanggal = $this->con->query("SELECT `tanggal` FROM `data_testing` ORDER BY `tanggal` DESC LIMIT 1");
        while ($row = $query_tanggal->fetch_array()) {
          $last_date = $row['tanggal'];
        }
        $tanggal_crawling = date('Y-m-d', strtotime('-'.$i.' month', strtotime( $last_date )));
        $bulan_crawling = date('M Y', strtotime('-'.$i.' month', strtotime( $last_date )));

        $query_positif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE MONTH(`tanggal`) = MONTH('".$tanggal_crawling."') AND `".$metode."` = 'P' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_positif = $query_positif->fetch_row();
        $jumlah_positif = $row_positif[0];
        $query_negatif = $this->con->query("SELECT count(id_tes) FROM data_testing WHERE MONTH(`tanggal`) = MONTH('".$tanggal_crawling."') AND `".$metode."` = 'N' AND `id_kategori` = $id_kategori AND `id_kota` = $id_kota");
        $row_negatif = $query_negatif->fetch_row();
        $jumlah_negatif = $row_negatif[0];

        array_push($data_sentimen['sentimenPositif'], (int)$jumlah_positif);
        array_push($data_sentimen['sentimenNegatif'], (int)$jumlah_negatif);
        if ($index<1) {
          array_push($response['tanggal'], $bulan_crawling);
        }
      }
      $index++;
      $data_kota[$kategori_sentimen] = $data_sentimen;
    }
    $response['data'] = $data_kota;
    return json_encode($response);
  }

  public function getJsonAkurasi() {
    header("Content-type:application/json");
    $response = [];
    $response['threshold'] = [];
    $response['waktu'] = [];
    $response['akurasi'] = [];
    
    $index = 0;
    $query_akurasi = $this->con->query("SELECT * FROM `data_akurasi` ORDER BY `threshold` DESC");
    while ($hasil_akurasi = $query_akurasi->fetch_array()) {
      array_push($response['threshold'], round($hasil_akurasi['threshold']));
      array_push($response['waktu'], round($hasil_akurasi['waktu'], 2));
      array_push($response['akurasi'], round($hasil_akurasi['akurasi'], 2));
    }
    return json_encode($response);
  }

  public function getJsonAkurasiKnn() {
    header("Content-type:application/json");
    $response = [];
    $response['error'] = [];
    $response['waktu'] = [];
    $response['akurasi'] = [];
    
    $index = 0;
    $query_akurasi = $this->con->query("SELECT * FROM `data_akurasi_knn` ORDER BY `threshold` DESC");
    while ($hasil_akurasi = $query_akurasi->fetch_array()) {
      $error = 100 - round($hasil_akurasi['akurasi'], 2);
      array_push($response['error'], $error);
      array_push($response['waktu'], round($hasil_akurasi['waktu'], 2));
      array_push($response['akurasi'], round($hasil_akurasi['akurasi'], 2));
    }
    return json_encode($response);
  }

  public function setTampilan($kota, $rentang)
  {
    $this->con->query("UPDATE `tb_tampil_json` SET `kota`='".$kota."', `rentang`='".$rentang."' WHERE `id`=1");
  }

  public function getTampilan()
  {
    $query = $this->con->query("SELECT * FROM `tb_tampil_json`");
    while ($hasil = $query->fetch_array()) {
      $kota = $hasil['kota'];
      $rentang = $hasil['rentang'];
    }

    if ($rentang == '1pekan') {
      return $this->getJsonKategoriKota($kota);
    } elseif ($rentang == '1bulan') {
      return $this->getJsonKategoriKota_1bulan($kota);
    } elseif ($rentang == '6bulan') {
      return $this->getJsonKategoriKota_6bulan($kota);
    } elseif ($rentang == '12bulan') {
      return $this->getJsonKategoriKota_12bulan($kota);
    }
    
  }

  public function getTampilanKnn()
  {
    $query = $this->con->query("SELECT * FROM `tb_tampil_json`");
    while ($hasil = $query->fetch_array()) {
      $kota = $hasil['kota'];
      $rentang = $hasil['rentang'];
    }

    if ($rentang == '1pekan') {
      return $this->getJsonKategoriKota($kota, 'sentimen_knn');
    } elseif ($rentang == '1bulan') {
      return $this->getJsonKategoriKota_1bulan($kota, 'sentimen_knn');
    } elseif ($rentang == '6bulan') {
      return $this->getJsonKategoriKota_6bulan($kota, 'sentimen_knn');
    } elseif ($rentang == '12bulan') {
      return $this->getJsonKategoriKota_12bulan($kota, 'sentimen_knn');
    }
    
  }

  function getJudul()
  {
    $query = $this->con->query("SELECT * FROM `tb_tampil_json`");
    while ($hasil = $query->fetch_array()) {
      $kota = $hasil['kota'];
      $rentang = $hasil['rentang'];
    }
    $query_kota = $this->con->query("SELECT `kota` FROM `tb_kota` WHERE `id` = '".$kota."'");
    while ($hasil_kota = $query_kota->fetch_array()) {
      $nama_kota = $hasil_kota['kota'];
    }

    if ($rentang == '1pekan') {
      return "Analisis Kota $nama_kota dalam 1 pekan";
    } elseif ($rentang == '1bulan') {
      return "Analisis Kota $nama_kota dalam 1 bulan";
    } elseif ($rentang == '6bulan') {
      return "Analisis Kota $nama_kota dalam 6 bulan";
    } elseif ($rentang == '12bulan') {
      return "Analisis Kota $nama_kota dalam 12 bulan";
    }
  }

}

$data = new DataVisualisasi();

if (isset($_GET['kota']) && isset($_GET['rentang'])) {
  $kota_terpilih = $_GET['kota'];
  $rentang_terpilih = $_GET['rentang'];
  
  if ($kota_terpilih == '' && $rentang_terpilih == '') {
    $data->setTampilan('42','1pekan');
  }elseif ($kota_terpilih != '' && $rentang_terpilih == '') {
    $data->setTampilan($kota_terpilih, '1pekan');
  }elseif ($kota_terpilih != '' && $rentang_terpilih != '') {
    $data->setTampilan($kota_terpilih,$rentang_terpilih);
  }else {
    $data->setTampilan('42','1pekan');
  }
}

?>
