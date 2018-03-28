<?php 
include_once 'koneksi.php';

/**
* Fungsi
*/
class Knn extends Koneksi
{
	
	public function bobot_widf_kata_training() {
		$query_kata = $this->con->query("SELECT `id_kata`,`kata`,`frekuensi` FROM `data_training_kata`");
		while ($row_kata = $query_kata->fetch_array()) {
			$id_kata = $row_kata['id_kata'];
			$kata = $row_kata['kata'];
			$frekuensi = $row_kata['frekuensi'];
			
			$query_dokumen = $this->con->query("SELECT `id_training`,`tweet_preprocessing` FROM `data_training`");
			while ($row_dok = $query_dokumen->fetch_array()) {
				$jml_tf = 0;
				$id_dok = $row_dok['id_training'];
				$dokumen = explode(' ', $row_dok['tweet_preprocessing']);
				
				foreach ($dokumen as $kata_dok) {
					if ($kata == $kata_dok) {
						$jml_tf+=1;
					}
				}

				if ($jml_tf > 0) {
					$bobot_widf = $jml_tf/$frekuensi;
					$bobot_widf = round($bobot_widf,9);
					$this->con->query("INSERT INTO `data_widf_training`(`id_kata`, `id_training`, `bobot`) VALUES (".$id_kata.",".$id_dok.",".$bobot_widf.")");
				}
			}
		}
	}

	public function bobot_widf_dokumen_training()
	{
		$query_dokumen = $this->con->query("SELECT `id_training` FROM `data_training`");
		while ($row_dok = $query_dokumen->fetch_array()) {
			$id_training = $row_dok['id_training'];
			$query_widf = $this->con->query("SELECT SUM(`bobot`) AS `bobot` FROM `data_widf_training` WHERE `id_training`= ".$id_training);
			$row_widf = $query_widf->fetch_array();
			$bobot_widf = round($row_widf['bobot'],9);
			$this->con->query("UPDATE `data_training` SET `bobot_widf` = ".$bobot_widf." WHERE `id_training` = ".$id_training);
		}
		
	}


	public function bobot_widf_kata_testing() {
		$query_kata = $this->con->query("SELECT `id_kata`,`kata`,`frekuensi` FROM `data_training_kata`");
		while ($row_kata = $query_kata->fetch_array()) {
			$id_kata = $row_kata['id_kata'];
			$kata = $row_kata['kata'];
			$frekuensi = $row_kata['frekuensi'];
			
			$query_dokumen = $this->con->query("SELECT `id_tes`,`tweet_preprocessing` FROM `data_testing`");
			while ($row_dok = $query_dokumen->fetch_array()) {
				$jml_tf = 0;
				$id_dok = $row_dok['id_tes'];
				$dokumen = explode(' ', $row_dok['tweet_preprocessing']);
				
				foreach ($dokumen as $kata_dok) {
					if ($kata == $kata_dok) {
						$jml_tf+=1;
					}
				}

				if ($jml_tf > 0) {
					$bobot_widf = $jml_tf/$frekuensi;
					$bobot_widf = round($bobot_widf,9);
					$this->con->query("INSERT INTO `data_widf_testing`(`id_kata`, `id_tes`, `bobot`) VALUES (".$id_kata.",".$id_dok.",".$bobot_widf.")");
				}
			}
		}
	}

	public function bobot_widf_dokumen_testing()
	{
		$query_dokumen = $this->con->query("SELECT `id_tes` FROM `data_testing`");
		while ($row_dok = $query_dokumen->fetch_array()) {
			$id_tes = $row_dok['id_tes'];
			$query_widf = $this->con->query("SELECT SUM(`bobot`) AS `bobot` FROM `data_widf_testing` WHERE `id_tes`= ".$id_tes);
			$row_widf = $query_widf->fetch_array();
			$bobot_widf = round($row_widf['bobot'],9);
			$this->con->query("UPDATE `data_testing` SET `bobot_widf` = ".$bobot_widf." WHERE `id_tes` = ".$id_tes);
		}
		
	}

	public function klasifikasi_sentimen_knn() {
		
		// $query_dokumen_testing = $this->con->query("SELECT `id_tes`,`tweet_preprocessing`,`bobot_widf` FROM `data_testing` WHERE `sentimen_knn` IS NULL ORDER BY `id_tes` ASC LIMIT 1");
		// while ($row_dokumen_testing = $query_dokumen_testing->fetch_array()) {
		// 	$this->con->query("TRUNCATE TABLE `data_bobot_temp`");
		// 	$id_tes_dokumen = $row_dokumen_testing['id_tes'];
		// 	$tweet_dokumen_testing = $row_dokumen_testing['tweet_preprocessing'];
		// 	$bobot_dokumen_testing = $row_dokumen_testing['bobot_widf'];

		// 	$query_dokumen_training = $this->con->query("SELECT `id_training`, `bobot_widf`, `sentimen` FROM `data_training` ORDER BY `id_training` ASC");
		// 	while ($row_dokumen_training = $query_dokumen_training->fetch_array()) {
		// 		$bobot_dokumen = 0;
		// 		$id_training_dokumen = $row_dokumen_training['id_training'];
		// 		$bobot_dokumen_training = $row_dokumen_training['bobot_widf'];
		// 		$sentimen_dokumen_training = $row_dokumen_training['sentimen'];

		// 		$query_widf_testing = $this->con->query("SELECT `id_kata`, `id_tes`, `bobot` FROM `data_widf_testing` WHERE	`id_tes`=$id_tes_dokumen");
		// 		while ($row_widf_testing = $query_widf_testing->fetch_array()) {
		// 			$id_kata_testing = $row_widf_testing['id_kata'];
		// 			$bobot_kata_testing = $row_widf_testing['bobot'];

		// 			$query_widf_training = $this->con->query("SELECT `bobot` FROM `data_widf_training` WHERE `id_training` = $id_training_dokumen AND `id_kata` = $id_kata_testing ORDER BY `data_widf_training`.`id_training` ASC");
		// 			while ($row_widf_training = $query_widf_training->fetch_array()) {
		// 				$bobot_kata_training = $row_widf_training['bobot'];					
						
		// 				$bobot_dokumen += ($bobot_kata_training*$bobot_kata_testing);
						
		// 			}
		// 		}
		// 		$pembilang = $bobot_dokumen;
		// 		$penyebut = sqrt($bobot_dokumen_testing)*sqrt($bobot_dokumen_training);

		// 		if ($penyebut > 0) {
		// 			$hasil_bobot = round(($pembilang/$penyebut),9);
		// 		} else {
		// 			$hasil_bobot = 0;
		// 		}
				
				
		// 		// echo $id_training_dokumen.". ";
		// 		// echo " = ".$bobot_dokumen;
		// 		// echo "<br>";
		// 		// echo "hasil = ".$hasil_bobot." ".$sentimen_dokumen_training;
		// 		// echo "<br><br>";
		// 		$this->con->query("INSERT INTO `data_bobot_temp` (`id`,`bobot_knn`,`sentimen`) VALUES (".$id_training_dokumen.",".$hasil_bobot.",'".$sentimen_dokumen_training."')");
		// 	}
		// 	// echo $id_tes_dokumen;
		// 	// die();

		// 	$query_bobot_temp = $this->con->query("SELECT * FROM `data_bobot_temp` ORDER BY `data_bobot_temp`.`bobot_knn` DESC LIMIT 3");
			
		// 	$sentimen_positif = 0;
		// 	while ($row_bobot_temp = $query_bobot_temp->fetch_array()) {
		// 		$sentimen = $row_bobot_temp['sentimen'];
		// 		// echo $row_bobot_temp['bobot_knn']." ".$row_bobot_temp['sentimen']."<br>";
		// 		if ($sentimen == 'P' || $sentimen == 'p') {
		// 			$sentimen_positif+=1;
		// 		}
		// 	}
		// 	if ($sentimen_positif > 1) {
		// 		$hasil_sentimen = "P";
		// 	} else {
		// 		$hasil_sentimen = "N";
		// 	}
		// 	$this->con->query("UPDATE `data_testing` SET `sentimen_knn` = '".$hasil_sentimen."' WHERE `id_tes` = ".$id_tes_dokumen);
		// }
		// 
		










		$query_dokumen_testing = $this->con->query("SELECT `id_tes`,`tweet_preprocessing`,`bobot_widf` FROM `data_testing` WHERE `sentimen_knn` IS NULL ORDER BY `id_tes` ASC LIMIT 1");
		while ($row_dokumen_testing = $query_dokumen_testing->fetch_array()) {
			$this->con->query("TRUNCATE TABLE `data_bobot_temp`");
			$id_tes_dokumen = $row_dokumen_testing['id_tes'];
			$tweet_dokumen_testing = $row_dokumen_testing['tweet_preprocessing'];
			$bobot_dokumen_testing = $row_dokumen_testing['bobot_widf'];

			$arr_tweet = explode(" ", $tweet_dokumen_testing);
			$query_parts = [];
			foreach ($arr_tweet as $val) {
			    $query_parts[] = "'%".mysql_real_escape_string($val)."%'";
			}

			$string = implode(' OR tweet_preprocessing LIKE ', $query_parts);

			$query_dokumen_training = $this->con->query("SELECT `id_training`, `bobot_widf`, `sentimen` FROM `data_training` WHERE `tweet_preprocessing` LIKE $string ORDER BY `id_training` ASC");
			
			while ($row_dokumen_training = $query_dokumen_training->fetch_array()) {
				$bobot_dokumen = 0;
				$id_training_dokumen = $row_dokumen_training['id_training'];
				$bobot_dokumen_training = $row_dokumen_training['bobot_widf'];
				$sentimen_dokumen_training = $row_dokumen_training['sentimen'];

				$query_widf_testing = $this->con->query("SELECT `id_kata`, `id_tes`, `bobot` FROM `data_widf_testing` WHERE	`id_tes`=$id_tes_dokumen");
				while ($row_widf_testing = $query_widf_testing->fetch_array()) {
					$id_kata_testing = $row_widf_testing['id_kata'];
					$bobot_kata_testing = $row_widf_testing['bobot'];

					$query_widf_training = $this->con->query("SELECT `bobot` FROM `data_widf_training` WHERE `id_training` = $id_training_dokumen AND `id_kata` = $id_kata_testing ORDER BY `data_widf_training`.`id_training` ASC");
					while ($row_widf_training = $query_widf_training->fetch_array()) {
						$bobot_kata_training = $row_widf_training['bobot'];					
						
						$bobot_dokumen += ($bobot_kata_training*$bobot_kata_testing);
						
					}
				}
				$pembilang = $bobot_dokumen;
				$penyebut = sqrt($bobot_dokumen_testing)*sqrt($bobot_dokumen_training);

				if ($penyebut > 0) {
					$hasil_bobot = round(($pembilang/$penyebut),9);
				} else {
					$hasil_bobot = 0;
				}
				
				
				// echo $id_training_dokumen.". ";
				// echo " = ".$bobot_dokumen;
				// echo "<br>";
				// echo "hasil = ".$hasil_bobot." ".$sentimen_dokumen_training;
				// echo "<br><br>";
				$this->con->query("INSERT INTO `data_bobot_temp` (`id`,`bobot_knn`,`sentimen`) VALUES (".$id_training_dokumen.",".$hasil_bobot.",'".$sentimen_dokumen_training."')");
			}
			// echo $id_tes_dokumen;
			// die();

			$query_bobot_temp = $this->con->query("SELECT * FROM `data_bobot_temp` ORDER BY `data_bobot_temp`.`bobot_knn` DESC LIMIT 3");
			
			$sentimen_positif = 0;
			while ($row_bobot_temp = $query_bobot_temp->fetch_array()) {
				$sentimen = $row_bobot_temp['sentimen'];
				// echo $row_bobot_temp['bobot_knn']." ".$row_bobot_temp['sentimen']."<br>";
				if ($sentimen == 'P' || $sentimen == 'p') {
					$sentimen_positif+=1;
				}
			}
			if ($sentimen_positif > 1) {
				$hasil_sentimen = "P";
			} else {
				$hasil_sentimen = "N";
			}
			$this->con->query("UPDATE `data_testing` SET `sentimen_knn` = '".$hasil_sentimen."' WHERE `id_tes` = ".$id_tes_dokumen);
		}



		
	}



}



?>