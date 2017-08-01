<?php 
include_once "koneksi_procedural.php";

function get_kata_dokumen() {
	GLOBAL $con;
	$query = "SELECT `tweet_preprocessing_ig` FROM `data_training_tes`";
	$data = mysqli_query($con, $query);
	
	while ($dokumen = mysqli_fetch_array($data)) {
		$kalimat = $dokumen['tweet_preprocessing_ig'];
		$kal = explode(' ', $kalimat);
		foreach ($kal as $kata) {
			$query_kata = "INSERT INTO `data_training_kata_ig` (`kata`) VALUES ('".$kata."')";
			$simpan =mysqli_query($con, $query_kata);
			if ($simpan) {
				echo $kata;echo "<br>";
			}
		}
	}
}

function get_frekuensi_kata() {
	GLOBAL $con;
	$a=0;
	$query_kata = "SELECT `id_kata`,`kata` FROM `data_training_kata`";
	$hasil_kata = mysqli_query($con, $query_kata);
	$total=0;
	while ($hasil = mysqli_fetch_array($hasil_kata)) {
		$n = 0;
		$query_dokumen = "SELECT `tweet_preprocessing` FROM `data_training`";
		$data = mysqli_query($con, $query_dokumen);
		$tweet="";
		while ($dokumen = mysqli_fetch_array($data)) {
			$kalimat = $dokumen['tweet_preprocessing'];
			$kal = explode(' ', $kalimat);
			foreach ($kal as $kata) {
				if ($hasil['kata'] == $kata) {
					$n+=1;
					$total+=1;
				}
			}
			$tweet = $kalimat;
		}
		echo $hasil['kata']." = $n";
		
		$query_simpan = "UPDATE `data_training_kata` SET `frekuensi`= $n WHERE id_kata = ".$hasil['id_kata'];
		$simpan = mysqli_query($con, $query_simpan);
		if ($simpan) {
			echo " berhasil";
		}
		echo "<br>";
	}
	echo "<br>";
	echo "=========";
	echo $total;
	echo "=========";
}


function total_kata() {
	GLOBAL $con;
	$query = "SELECT `tweet_preprocessing` FROM `data_training`";
	$data = mysqli_query($con, $query);
	$n = 0;
	while ($dokumen = mysqli_fetch_array($data)) {
		$kalimat = $dokumen['tweet_preprocessing'];
		$kal = explode(' ', $kalimat);
		foreach ($kal as $kata) {
			$n+=1;
		}
	}
	echo "<br>";
	echo "++++++";
	echo $n;
	echo "++++++";
}


function urutkan_nomor() {
	GLOBAL $con;
	$query = "SELECT `id_training` FROM `data_training`";
	$hasil = mysqli_query($con, $query);
	$id_training = [];
	$a=0;
	while ($no = mysqli_fetch_array($hasil)) {
		array_push($id_training, $no['id_training']);
	}

	for ($i=1; $i < count($id_training); $i++) { 

		echo $q = "UPDATE `data_training` SET `id_training`= $i WHERE `id_training` = ".$id_training[$a]."";
		$hasil = mysqli_query($con, $q);
		if ($hasil) {
			echo " Berhasil";
		}
		echo "<br>";
		$a+=1;
	}
}




// frekuensi_kata();
// total_kata();
// urutkan_nomor();
get_kata_dokumen();

?>