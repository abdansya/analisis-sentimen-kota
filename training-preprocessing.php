<?php
include_once 'model/model_training_preprocessing.php';
$data = data_training();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analisis Kota</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <script src="assets/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="assets/js/bootstrap.min.js" charset="utf-8"></script>
    <!-- <script src="assets/js/zingchart.min.js" charset="utf-8"></script> -->
    <!-- <script src="assets/js/ansenchart.js" charset="utf-8"></script> -->
  </head>
  <body>
    <!-- Header -->
		<div class="container-fluid navigasi navbar-fixed-top">
			<div class="row">
				<div class="navbar">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
						<a class="navbar-brand" href="index.php">Analisis Kota</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-right">
              <li><a href="http://localhost/ansen-kota/">Beranda</a></li>
							<li><a href="http://localhost/ansen-kota/proses-crawling.php">Proses</a></li>
							<li><a href="http://localhost/ansen-kota/visualisasi.php">Visualisasi</a></li>
							<li><a href="http://localhost/ansen-kota/tentang-kami.php">Tentang Kami</a></li>
						</ul>
					</div>
				</div>
			</div>
    </div>

    <!-- Section -->
    <nav class="col-md-2 menu-kiri">
      <ul>
        <li>
          <a href="#subPages" data-toggle="collapse" class="active" aria-expanded="true"><i class="fa fa-gears fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Proses Training  <i class="fa fa-chevron-down pull-right" aria-hidden="true" style="padding:17px;"></i></a>
          <div id="subPages" class="collapse in" aria-expanded="true" style="">
            <ul class="sub-nav">
              <li><a href="training-crawling.php" class="sub-menu"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Crawling</a></li>
              <li class="menu-terpilih"><a href="training-preprocessing.php" class="sub-menu"><i class="fa fa-retweet fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Preprocessing</a></li>
              <li><a href="training-information-gain.php" class="sub-menu"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Information Gain</a></li>
              <li><a href="training-naive-bayes.php" class="sub-menu"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Naive Bayes</a></li>
              <li><a href="training-akurasi.php" class="sub-menu"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Akurasi</a></li>
            </ul>
          </div>
        </li>
        <li><a href="http://localhost/ansen-kota/proses-crawling.php"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Crawling</a></li>
        <li><a href="http://localhost/ansen-kota/proses-preprocessing.php"><i class="fa fa-retweet fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Preprocessing</a></li>
        <li><a href="http://localhost/ansen-kota/proses-information-gain.php"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Bobot IG</a></li>
        <li><a href="http://localhost/ansen-kota/proses-bobot-bayes.php"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Bobot Bayes</a></li>
        <li><a href="http://localhost/ansen-kota/proses-klasifikasi-bayes.php"><i class="fa fa-table fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Klasifikasi Sentimen</a></li>
        <li><a href="http://localhost/ansen-kota/visualisasi.php"><i class="fa fa-area-chart fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Visualisasi</a></li>
      </ul>
    </nav>
    <main class="main container-fluid" style="overflow-x:hidden">
      <div class="row">
        <div class="col-md-10 col-md-offset-2">
          <h3>Preprocessing</h3>
          <hr>
          <form action="" method="get">
            <button type="submit" class="btn btn-info" name="btsubmit" value="prepro">Proses</button>
          </form>
          <br>
          <?php if ($data->num_rows > 0): ?>

          <table class="table table-striped">
            <thead>
              <tr>
                <th style="text-align:center;">Id Tweet</th>
                <th>Tweet</th>
                <th>Tweet Preprocessing</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Cek apakah terdapat data page pada URL
              $page = (isset($_GET['page']))? $_GET['page'] : 1;
              $limit = 50; // Jumlah data per halamannya
              // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
              $limit_start = ($page - 1) * $limit;
              // Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
              $sql = $pdo->prepare("SELECT * FROM `data_training` LIMIT ".$limit_start.",".$limit);
              $sql->execute(); // Eksekusi querynya
              $no = $limit_start + 1; // Untuk penomoran tabel


              while ($data = $sql->fetch()) { ?>
                <tr>
                  <td class="col-md-1" style="text-align:center;"><?php echo $data['id_training']; ?></td>
                  <td class="col-md-8"><?php echo $data['tweet']; ?></td>
                  <td class="col-md-3"><?php echo $data['tweet_preprocessing']; ?></td>
                </tr>
              <?php
              $no++; // Tambah 1 setiap kali looping
              } ?>
              </tbody>
            </table>
            <!--
            -- Buat Paginationnya
            -- Dengan bootstrap, kita jadi dimudahkan untuk membuat tombol-tombol pagination dengan design yang bagus tentunya
            -->
            <div class="container">
              <div class="row">
                <div class="col-md-10" style="text-align:center;">
                  <ul class="pagination">
                    <!-- LINK FIRST AND PREV -->
                    <?php
                    if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                    ?>
                      <li class="disabled"><a href="#">First</a></li>
                      <li class="disabled"><a href="#">&laquo;</a></li>
                    <?php
                    }else{ // Jika page bukan page ke 1
                      $link_prev = ($page > 1)? $page - 1 : 1;
                    ?>
                      <li><a href="training-preprocessing.php?page=1">First</a></li>
                      <li><a href="training-preprocessing.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                    <?php
                    }
                    ?>

                    <!-- LINK NUMBER -->
                    <?php
                    // Buat query untuk menghitung semua jumlah data
                    $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM data_training");
                    $sql2->execute(); // Eksekusi querynya
                    $get_jumlah = $sql2->fetch();

                    $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                    for($i = $start_number; $i <= $end_number; $i++){
                      $link_active = ($page == $i)? ' class="active"' : '';
                    ?>
                      <li<?php echo $link_active; ?>><a href="training-crawling.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>

                    <!-- LINK NEXT AND LAST -->
                    <?php
                    // Jika page sama dengan jumlah page, maka disable link NEXT nya
                    // Artinya page tersebut adalah page terakhir
                    if($page == $jumlah_page){ // Jika page terakhir
                    ?>
                      <li class="disabled"><a href="#">&raquo;</a></li>
                      <li class="disabled"><a href="#">Last</a></li>
                    <?php
                    }else{ // Jika Bukan page terakhir
                      $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                    ?>
                      <li><a href="training-preprocessing.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                      <li><a href="training-preprocessing.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <!-- <footer class="container-fluid text-center footer">
			<div>  	&copy; abdan syakuro [ ] dengan <span>❤</span> di Malang </div>
		</footer> -->

  </body>
</html>
