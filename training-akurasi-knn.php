<?php
include_once 'model/model_training_akurasi.php';
$data = data_akurasi_knn();
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
    <script src="assets/js/zingchart.min.js" charset="utf-8"></script>
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
              <li class="menu-terpilih"><a href="training-akurasi.php" class="sub-menu"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;&nbsp;Akurasi</a></li>
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
          <h3>Akurasi</h3>
          <br>
          <ul class="nav nav-tabs">
            <li role="presentation"><a href="training-akurasi.php">Naive Bayes</a></li>
            <li role="presentation" class="active"><a href="#">K-Nearest Neighbors</a></li>
          </ul>
          <br>
          <form action="" method="get">
            <button type="submit" class="btn btn-info" name="btsubmit" value="akurasi_knn">Proses</button>
          </form>
          <br>
          <div class="col-md-4">
            <br>
            <?php if ($data->num_rows > 0): ?>

            <table class="table table-striped table-bordered" width="70%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Akurasi</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody>
              <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                  <td class="col-md-1"><?php echo $row['id_akurasi']; ?></td>
                  <td class="col-md-2"><?php echo $row['akurasi']; ?></td>
                  <td class="col-md-2"><?php echo $row['waktu']; ?> detik</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <?php endif; ?>
          </div>
          <div class="col-md-8">
            <div id='myChart'></div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <!-- <footer class="container-fluid text-center footer">
			<div>  	&copy; abdan syakuro [ ] dengan <span>❤</span> di Malang </div>
		</footer> -->

  </body>
  <script>    
  $.get("model/data_akurasi_knn_json.php", function(data, status){
      
    var myConfig = {
    backgroundColor:'#FBFCFE',
      type: "ring",
      title: {
        text: "Akurasi KNN",
        fontFamily: 'Lato',
        fontSize: 14,
        // border: "1px solid black",
        padding: "15",
        fontColor : "#1E5D9E",
      },
      subtitle: {
        fontFamily: 'Lato',
        fontSize: 12,
        fontColor: "#777",
        padding: "5"
      },
      plot: {
        slice:'50%',
        borderWidth:0,
        backgroundColor:'#FBFCFE',
        animation:{
          effect:2,
          sequence:3
        },
        valueBox: [
          {
            type: 'all',
            text: '%t',
            placement: 'out'
          }, 
          {
            type: 'all',
            text: '%npv%',
            placement: 'in'
          }
        ]
      },
      
      plotarea: {
        backgroundColor: 'transparent',
        borderWidth: 0,
        borderRadius: "0 0 0 10",
        margin: "70 0 10 0"
      },
      legend : {
        toggleAction:'remove',
        backgroundColor:'#FBFCFE',
        borderWidth:0,
        adjustLayout:true,
        align:'center',
        verticalAlign:'bottom',
        marker: {
            type:'circle',
            cursor:'pointer',
            borderWidth:0,
            size:5
        },
        item: {
            fontColor: "#777",
            cursor:'pointer',
            offsetX:-6,
            fontSize:12
        },
        mediaRules:[
            {
                maxWidth:500,
                visible:false
            }
        ]
      },
      scaleR:{
        refAngle:270
      },
      series : [
        {
          text: "Akurasi",
          values : data.akurasi,
          lineColor: "#00BAF2",
          backgroundColor: "#00BAF2",
          lineWidth: 1,
          marker: {
            backgroundColor: '#00BAF2'
          }
        },
        {
          text: "Error",
          values : data.error,
          lineColor: "#E80C60",
          backgroundColor: "#E80C60",
          lineWidth: 1,
          marker: {
            backgroundColor: '#E80C60'
          }
        }
      ]
    };
  
    zingchart.render({ 
      id : 'myChart', 
      data: {
        gui:{
          contextMenu:{
            button:{
              visible: true,
              lineColor: "#2D66A4",
              backgroundColor: "#2D66A4"
            },
            gear: {
              alpha: 1,
              backgroundColor: "#2D66A4"
            },
            position: "right",
            backgroundColor:"#306EAA", /*sets background for entire contextMenu*/
            docked: true, 
            item:{
              backgroundColor:"#306EAA",
              borderColor:"#306EAA",
              borderWidth: 0,
              fontFamily: "Lato",
              color:"#fff"
            }
          
          },
        },
        graphset: [myConfig]
      },
      height: '499', 
      width: '99%' 
    });

  });   
  </script>
</html>
