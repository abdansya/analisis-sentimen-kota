<?php
require_once 'koneksi.php';

require_once 'vendor/autoload.php';

set_time_limit(0);

// fungsi case folding

/**
 *
 */
class Preprocessing extends Koneksi {

  public function case_folding($tweet){
      return strtolower($tweet);
  }
  // cleansing
  public function cleansing($tweet){
      // $tweet = iconv("UTF-8","ISO-8859-1//IGNORE", $tweet);
      //
      // menghapus pic
      $tweet = explode(' ', $tweet);
      $tweet_hasil = [];
      foreach ($tweet as $tweet_kata) {
        // echo $tweet_kata." ";
        if ($tweet = preg_match('/pic.twitter.com/', $tweet_kata)) {
          $tweet_kata = "";
        } else {
          array_push($tweet_hasil, $tweet_kata);
        }
      }
      // $tweet = preg_replace('/pic.twitter.com(?=g) /', '', $tweet);
      $tweet = implode(' ', $tweet_hasil);



      //angka
      $tweet = explode(' ', $tweet);
      $tweet_hasil = [];
      foreach ($tweet as $tweet_kata) {
        // echo $tweet_kata." ";
        if ($tweet = preg_match('/[0-9]/', $tweet_kata)) {
          $tweet_kata = "";
        } else {
          array_push($tweet_hasil, $tweet_kata);
        }
      }
      // $tweet = preg_replace('/pic.twitter.com(?=g) /', '', $tweet);
      $tweet = implode(' ', $tweet_hasil);
      //mention
      $tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',' ', $tweet);
      //hashtag
      $tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',' ', $tweet);
      // link
      $tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',' ', $tweet);
      $tweet = preg_replace('/rt | â€¦/i', '', $tweet);
      //hapus http
      $tweet = str_replace("?", " ", $tweet);
      $tweet = str_replace("??", " ", $tweet);
      $tweet = str_replace("???", " ", $tweet);
      $tweet = str_replace(".", " ", $tweet);
      $tweet = str_replace(",", " ", $tweet);
      $tweet = str_replace(",,", " ", $tweet);
      $tweet = str_replace("..", " ", $tweet);
      $tweet = str_replace("...", " ", $tweet);
      $tweet = str_replace("…", " ", $tweet);
      $tweet = str_replace(":", " ", $tweet);
      // $tweet = str_replace(" rt", "", $tweet);
      // $tweet = str_replace(" rt ", "", $tweet);
      // $tweet = str_replace("rt ", "", $tweet);
      return $tweet;
  }

  public function stopword_removal($tweet){
      $stoplist = array();
      $query = $this->con->query("SELECT * FROM tb_kata_stopword");
      while ($key = $query->fetch_array()) {
          $stoplist[]= $key['stopword'];
      }

      // $tweet = preg_replace(
      //         array_map(
      //             function($stopword){
      //                     return'/\b'.$stopword.'\b/';
      //                 }, $stoplist), '',$tweet);
      $tweet = preg_replace('/\b('.implode('|',$stoplist).')\b/','',$tweet);
      return $tweet;
  }

  // CONVERT EMOTICON
  public function convert_emoticon($tweet){
      $esenang = array(">:]",":-)",":)",":o)",":]",":3",":c)",":>","=]","8)","=)",":}",":>)",":D",":-D");
      $esedih = array(">:[",":-(",":(",":'(",":-c",":c",":-<",":-[",":[",":{",">.>","<.<",">.<",":/");

      //regex senang
      foreach ($esenang as $item)
      {
          $quotedSenang[] = preg_quote($item,'#');
      }
      $regexSenang = implode('|', $quotedSenang);
      $fullSenang = '#(^|\W)('.$regexSenang.')($|\W)#';

      //regex sedih
      foreach ($esedih as $item)
      {
          $quotedSedih[] = preg_quote($item,'#');
      }
      $regexSedih = implode('|', $quotedSedih);
      $fullSedih = '#(^|\W)('.$regexSedih.')($|\W)#';

      $tweet = preg_replace($fullSenang, ' emotsenang ', $tweet);
      $tweet = preg_replace($fullSedih, ' emotsedih ', $tweet);
      return $tweet;
  }

  public function convert_negation($tweet){
      $list = array(
          'gak ' => 'gak',
          'ga ' => 'ga',
          'ngga ' => 'ngga',
          'tidak '  => 'tidak',
          'bkn '=>'bkn',
          'tida '=>'tida',
          'tak '=>'tak',
          'jangan '=>'jangan',
          'enggak '=>'enggak',
          'gak  ' => 'gak',
          'ga  ' => 'ga',
          'ngga  ' => 'ngga',
          'tidak  '  => 'tidak',
          'bkn  '=>'bkn',
          'tida  '=>'tida',
          'tak  '=>'tak',
          'jangan  '=>'jangan',
          'enggak  '=>'enggak'
      );
      $patterns = array();
      $replacement = array();
      foreach ($list as $from => $to) {
          $from = '/\b' . $from . '\b/';
          $patterns[] = $from;
          $replacement[] = $to;
      }
      $tweet = preg_replace($patterns, $replacement, $tweet);
      return $tweet;
  }

  public function tokenizer($tweet){
      $tweet = stripcslashes($tweet);
      //karakter
      $tweet = preg_replace('/[-0-9+&@#\/%?=~_|$!:^>`{}<*,.;()"-$]/i', '', $tweet);

      //hapus satu karakter
      $tweet = preg_replace('/\b\w\b(\s|.\s)?/', '', $tweet);

      //hapus bracket
      $tweet = preg_replace("/[\[(.)\]]/", '', $tweet);

      //hapus kutip satu
      $tweet = str_replace("'", "", $tweet);

      $tweet = preg_replace('/\s+/', ' ', $tweet);
      $tweet = trim($tweet);

      $tweet = explode(" ",$tweet);
      return $tweet;
  }

  public function normalization($tweet){
      $kata_tweet = $tweet;
      $i = 0;
      foreach ($kata_tweet as $kata_hasil) {
          $query_singkat = $this->con->query("SELECT * FROM tb_kata_singkatan WHERE singkatan_kata = '".$kata_hasil."'");
          if ($query_singkat->num_rows >0) {
            while ($row = $query_singkat->fetch_array()) {
              $kata_tweet[$i] = $row[2];
            }
          }

          $query_baku = $this->con->query("SELECT * FROM tb_kata_baku WHERE baku_kata = '".$kata_hasil."'");
          if ($query_baku->num_rows >0) {
            while ($row = $query_baku->fetch_array()) {
              $kata_tweet[$i] = $row[2];
            }
          }

          $query_inggris = $this->con->query("SELECT * FROM tb_kata_inggris WHERE inggris_kata = '".$kata_hasil."'");
          if ($query_inggris->num_rows >0) {
            while ($row = $query_inggris->fetch_array()) {
              $kata_tweet[$i] = $row[2];
            }
          }

          $i++;
      }
      $kata = implode(' ', $kata_tweet);
      return $kata;
  }

  public function stemming($teks){
      // create stemmer
      // cukup dijalankan sekali saja, biasanya didaftarkan di service container
      $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
      $stemmer  = $stemmerFactory->createStemmer();

      // stem
      $sentence = $teks;
      $output   = $stemmer->stem($sentence);
      return $output;
  }

  public function trimed($txt){
    $txt = trim($txt);
    while( strpos($txt, '  ') ){
      $txt = str_replace('  ', ' ', $txt);
    }
    return $txt;
  }

  public function input($tweet) {
    $p_tweet = $this->convert_emoticon($tweet);
    $p_tweet = $this->case_folding($p_tweet);
    $p_tweet = $this->cleansing($p_tweet);
    $p_tweet = $this->convert_negation($p_tweet);
    $p_tweet = $this->tokenizer($p_tweet);
    $p_tweet = $this->normalization($p_tweet);
    $p_tweet = $this->stemming($p_tweet);
    $p_tweet = $this->stopword_removal($p_tweet);
    $p_tweet = $this->trimed($p_tweet);
    return $p_tweet;
  }
}
