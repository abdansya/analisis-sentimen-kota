<?php include_once 'function/f_tampildata.php';?>

<div></div>
<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Analisis Ecommerce</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
		<script src="assets/js/jquery-3.2.1.min.js" charset="utf-8"></script>
		<script src="assets/js/bootstrap.min.js" charset="utf-8"></script>
		<script src="assets/js/zingchart.min.js" charset="utf-8"></script>
		<script src="assets/js/ansenchart.js" charset="utf-8"></script>
    <script type="text/javascript">
      var tanggal = <?php echo $tanggal; ?>;
      var lazada_p = <?php echo $datalp; ?>;
      var lazada_n = <?php echo $dataln; ?>;
      var bukalapak_p = <?php echo $databp; ?>;
      var bukalapak_n = <?php echo $databn; ?>;
      var tokopedia_p = <?php echo $datatp; ?>;
      var tokopedia_n = <?php echo $datatn; ?>;

      var persenlp = <?php echo $persenlp; ?>;
      var persenln = <?php echo $persenln; ?>;
      var persenbp = <?php echo $persenbp; ?>;
      var persenbn = <?php echo $persenbn; ?>;
      var persentp = <?php echo $persentp; ?>;
      var persentn = <?php echo $persentn; ?>;
		</script>
	</head>
	<body>
		<!-- Header -->
		<div class="container-fluid bg-navigation">
			<div class="row">
				<div class="navbar">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
						<a class="navbar-brand" href="index.php">Analisis E-Commerce</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="">Beranda</a></li>
							<li><a href="">Akurasi</a></li>
							<li><a href="">Visualisasi</a></li>
							<li><a href="">Tentang kami</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

    <!-- Section 2 -->
		<div class="container-fluid text-center bg-3">
			<!-- <img src="assets/img/chart.png" alt="Chart" class="gambar"> -->
			<div id='myChartAkurasi'></div>
		</div>

		<!-- Footer -->
		<footer class="container-fluid text-center footer">
			<div>  	&copy; abdan syakuro [ ] dengan <span>❤</span> di Malang </div>
		</footer>

	</body>
</html>
