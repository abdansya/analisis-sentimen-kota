<?php
include_once "koneksi.php";
require_once __DIR__.'/twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
/**
*
*/
class Crawling extends Koneksi {

	public function get_tweet($keyword, $id_akun) {

		// ganti dengan API twitter anda
		$key = '2IVubz2TIA1wc2iLnUn9t7Ta9';
		$secret_key = '1IJ4v6eWRnECQjztEnKGqw7HiZnCVRceeiFX6m067ptcP7gRsg';
		$token = '432207100-C0l0q86QA71zBhVmC40QwRIKxnhcD3smwrWnREeh';
		$secret_token = 'mxBhaUjEFx1RIDrOa8wBDnCfOHE33HQCuLSLbgtneby3r';

		$conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);

		// menagmbil tweet berdasarkan keyword yang di tentukan
		// anda bisa merubah jumlah tweet yang akan di tampilkanb dengan merubah angka pada count
		$tweets = $conn->get('search/tweets', array('q'=>$keyword, 'count'=>100, 'lang'=>'in', 'until'=>'2017-07-29'));

		// menampilkan hasil keyword yang di tentukan
		echo '<h4>Keyword = \''.$keyword.'\'</h4><hr/>';
		foreach ($tweets->statuses as $tweet) {
		  static $i=0;
		  $i+=1;
		  echo "$i => ";
		  $str_id = $tweet->id_str;
		  $user = $tweet->user->screen_name;
		  $text = $tweet->text;
		  $date = date('Y-m-d H:i:s', strtotime($tweet->created_at));
		  // $date = ('2017-01-01 05:00:00', strtotime($tweet->created_at));

		  echo '</strong>'.$date.'</strong><br/>';
		  echo '<strong>'.$user.'</strong> : '.$text.'<br/><hr/><br/>';
			$query = $this->con->query("INSERT INTO `data_testing` (`id_akun`, `tweet`, `tanggal`) VALUES (".$id_akun.", '".$text."', '".$date."')");
			if ($query) {
				echo " berhasil";
			} else {
				echo "gagal";
			}
		}
	}

}

?>
