<?php
  include_once 'model/model_visual.php';
?>

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
    <script src="assets/js/zingchart.min.js" charset="utf-8"></script>

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
              <li><a href="index.php">Beranda</a></li>
              <li><a href="proses-crawling.php">Proses</a></li>
              <li><a href="visualisasi.php">Visualisasi</a></li>
              <li><a href="tentang-kami.php">Tentang Kami</a></li>
						</ul>
					</div>
				</div>
			</div>
    </div>

    <!-- Section -->
    <nav class="col-md-2 menu-kiri">
      <ul>
        <li><a href="proses-crawling.php"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Crawling</a></li>
        <li><a href="proses-preprocessing.php"><i class="fa fa-retweet fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Preprocessing</a></li>
        <li><a href="proses-information-gain.php"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Bobot IG</a></li>
        <li><a href="proses-bobot-bayes.php"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Bobot Bayes</a></li>
        <li><a href="proses-klasifikasi-bayes.php"><i class="fa fa-table fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Klasifikasi Sentimen NB</a></li>
        <li><a href="proses-klasifikasi-knn.php"><i class="fa fa-table fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Klasifikasi Sentimen KNN</a></li>
        <li><a href="visualisasi.php"><i class="fa fa-area-chart fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Visualisasi</a></li>
        <li>
          <a href="#subPages" data-toggle="collapse" class="active collapsed" aria-expanded="false"><i class="fa fa-gears fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Proses Training  <i class="fa fa-chevron-down pull-right" aria-hidden="true" style="padding:17px;"></i></a>
          <div id="subPages" class="collapse" aria-expanded="false" style="height: 0px;">
            <ul class="sub-nav">
              <li><a href="training-crawling.php" class="sub-menu"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Crawling</a></li>
              <li><a href="training-preprocessing.php" class="sub-menu"><i class="fa fa-retweet fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Preprocessing</a></li>
              <li><a href="training-information-gain.php" class="sub-menu"><i class="fa fa-balance-scale fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Information Gain</a></li>
              <li><a href="training-naive-bayes.php" class="sub-menu"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Naive Bayes</a></li>
              <li><a href="training-akurasi.php" class="sub-menu"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Akurasi</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <main class="main container-fluid">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10 main-proses">
          <h3>Visualisasi</h3>
          <hr>
          <div class="row pilihan-view">
            <h5>Tampilkan data</h5>
            <div class="col-md-6">
              <form class="form-inline" action="" method="get">
                <div class="form-group">
                  <select id="selectKota" name="kota" class="form-control">
                    <option value="">Pilih Kota</option>
                    <?php
                    include_once 'function/f_tambahan.php';
                    $kota = pilih_kota();
                    while ($row = mysqli_fetch_assoc($kota)) {
                    ?>
                    <option class="pilih_kota" value="<?php echo $row['id'] ?>"><?php echo $row['kota'] ?></option>
                    <?php
                    } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select id="pilRentang" name="rentang" class="form-control">
                    <option value="">Pilihan</option>
                    <option value="1pekan">Per pekan</option>
                    <option value="1bulan">Per bulan</option>
                    <option value="6bulan">Per 6 bulan</option>
                    <option value="12bulan">Per 12 bulan</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-info form-control"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>
          <div><h3 align="center"><?php echo $data->getJudul(); ?></h3></div>
          <div id="grafikAreaBayes" height="350px"></div>
          <hr>
          <div id="grafikAreaKnn" height="350px" width="600px"></div>
          <hr>
          <div id="grafikPieBayes" height="150px"></div>
          <hr>
          <div id="grafikPieKnn" height="150px"></div>
          <hr>
          <div id="grafikOtomasiBayes" height="150px"></div>
          <hr>
          <div id="grafikOtomasiKnn" height="150px"></div>
          <hr>
          <div id="grafikAkurasiBayes" height="350px"></div>
        </div>
      </div>
    </main>
    <script src="assets/js/visualchart.js" charset="utf-8"></script>
  </body>
  <script>
    var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
        }
      }
    };
    var kota = getUrlParameter('kota');
    var rentang = getUrlParameter('rentang');
    if (kota) {
      $("[value="+kota+"]").attr('selected','true');
    }
    if (rentang) {
      $("[value="+rentang+"]").attr('selected','true');
    }
  </script>
</html>
