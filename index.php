<?php
include_once 'model/model_visual.php';
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Analisis Sentimen Kota</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<!-- <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> -->
		<script src="assets/js/jquery-3.2.1.min.js" charset="utf-8"></script>
		<script src="assets/js/bootstrap.min.js" charset="utf-8"></script>
		<script src="assets/js/zingchart.min.js" charset="utf-8"></script>
		<!-- <script src="assets/js/ansenchart.js" charset="utf-8"></script>			 -->
	</head>
	<body>
		<!-- Header -->
		<div class="container-fluid bg-1">
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
			<div class="row">
				<div class="col-md-12 text-center judul">
					<h1>ANALISIS SENTIMEN MASYARAKAT<br>TERHADAP KOTA DI INDONESIA</h1>
					<!-- <form class="" action="" method="get">
						<div id="custom-search-input">
              <div class="input-group col-md-12">
                <input type="text" class="form-control input-lg" placeholder="Cari" name="katakunci">
                <span class="input-group-btn">
                  <button class="btn btn-info btn-lg" type="submit" name="btsubmit" value="crawindex">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
            </div>
					</form> -->
				</div>
			</div>
		</div>

		<!-- Section 1 -->

		<div class="container-fluid bg-2">
			<div class="col-md-12">
				<div class="carousel slide" id="myCarousel">
				  <div class="carousel-inner">
				    <div class="item active">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-batu.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-blitar.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-kediri.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-madiun.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-malang.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-mojokerto.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-pasuruan.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-probolinggo.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				    <div class="item">
				      <div class="col-xs-3"><a href="#"><img src="assets/img/logo-kota/kota-surabaya.png" class="img-responsive tumb-kota"></a></div>
				    </div>
				  </div>
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
				</div>
			</div>
		</div>

		<!-- Section 2 -->
		<div class="container-fluid text-center bg-3" align="center">
			<div><h3 align="center"><?php echo $data->getJudul(); ?></h3></div>
			<div id='grafikAreaBayes' style="margin: 0 auto; width: 84%;"></div>
			<div style=""></div>
		</div>

		<!-- Section 3 -->
		<div class="container-fluid text-center bg-4">
			<!-- <img src="assets/img/chart-pie.jpg" alt="Chart" class="gambar"> -->
			<div id='grafikPieBayes'></div>
		</div>

		<!-- Footer -->
		<footer class="container-fluid text-center footer">
			<div>  	&copy; abdan syakuro [ ] dengan <span>❤</span> di Malang </div>
		</footer>
	<script src="assets/js/custom.js" charset="utf-8"></script>
	<script src="assets/js/visualchart.js" charset="utf-8"></script>
	</body>
</html>
