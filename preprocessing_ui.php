<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Preprocessing</title>
	<link rel="stylesheet" href="">
</head>
<body>
<?php 
	require_once 'function/koneksi.php';
	require_once 'function/f_preprocessing.php';

	$data_tweet = [];
	// if (isset($_GET['proses'])) {
	// 	$query = "SELECT * FROM datatraining_paslon1 ";
	// 	$result = mysqli_query($com, $query);
		// while ($row = mysqli_fetch_array($result)) {
			// $id_tweet = trim($row['id_crawling']);
			$p_tweet = "Mari panjangkan malam ini, semoga di syukuran yg ke 16 tahun bisa lebih solid lagi di segala lini ye @JaKebayoran2001 #PersijaSelamanya";
			echo $p_tweet = case_folding($p_tweet);
			echo "<br>";
			echo $p_tweet = cleansing($p_tweet);
			echo "<br>";
			echo $p_tweet = convert_emoticon($p_tweet);
			echo "<br>";
			echo $p_tweet = convert_negation($p_tweet);
			echo "<br>";
			print_r($p_tweet = tokenizer($p_tweet));
			echo "<br>";
			echo $p_tweet = normalization($p_tweet);
			echo "<br>";
			echo $p_tweet = stopword_removal($p_tweet);
			echo "<br>";
			echo "Hasil : <b>".($p_tweet = stemming($p_tweet))."</b>";
			//echo "<br>";
			//sleep(0.2);
			// $query = "UPDATE `datatraining_paslon1` SET `hasil_preprocessing`= '$p_tweet' WHERE no = ".$row['no']."";
			// $hasil = mysqli_query($com, $query);
			// if ($hasil) {
			// 	echo "  <b style='color: blue'> Berhasil</b>";
			// } else {
			// 	echo "  <b style='color: red'> Gagal</b>";
			// }
			echo "<hr>";
		// }


	// }


?>

	<form action="" method="GET" accept-charset="utf-8">
		<input type="submit" name="proses" value="Preprocessing">
	</form>
</body>
</html>