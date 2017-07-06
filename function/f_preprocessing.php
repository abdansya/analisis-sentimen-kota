<?php
    require_once 'koneksi.php';
	set_time_limit(0);
	// fungsi case folding
    
    function input($tweet){
        $h_tweet = case_folding($tweet);
        $h_tweet = cleansing($h_tweet);
        $h_tweet = convert_emoticon($h_tweet);
        $h_tweet = convert_negation($h_tweet);
        $h_tweet = tokenizer($h_tweet);
        $h_tweet = normalization($h_tweet);
        $h_tweet = stopword_removal($h_tweet);
        $h_tweet = stemming($h_tweet);
        return $h_tweet;
    }

    function case_folding($tweet){
        return strtolower($tweet);
    }

    // cleansing
    function cleansing($tweet){
        // $tweet = iconv("UTF-8","ISO-8859-1//IGNORE", $tweet);
        //mention
        $tweet = preg_replace('/@[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        //hashtag
        $tweet = preg_replace('/#[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        // link
        $tweet = preg_replace('/\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i','', $tweet);
        $tweet = preg_replace('/rt | â€¦/i', '', $tweet);
        //hapus http
        $tweet = str_replace(".", "", $tweet);
        $tweet = str_replace("..", "", $tweet);
        $tweet = str_replace("...", "", $tweet);
        $tweet = str_replace("…", "", $tweet);
        $tweet = str_replace(":", "", $tweet);
        // $tweet = str_replace(" rt", "", $tweet);
        // $tweet = str_replace(" rt ", "", $tweet);
        // $tweet = str_replace("rt ", "", $tweet);
        return $tweet;
    }

    function stopword_removal($tweet){
        GLOBAL $con;
        //$con = mysqli_connect($host, $user, $pass, $db) or die(mysql_error());
        $stoplist = array();
        $query = "SELECT * FROM tb_kata_stopword";
        $qselectStopword = mysqli_query($con, $query);
        while ($key = mysqli_fetch_array($qselectStopword)) {
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
    function convert_emoticon($tweet){
        $esenang = array(">:]",":-)",":)",":o)",":]",":3",":c)",":>","=]","8)","=)",":}",":>)");
        $esedih = array(">:[",":-(",":(",":'(",":-c",":c",":-<",":-[",":[",":{",">.>","<.<",">.<");

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

    function convert_negation($tweet){
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

    function tokenizer($tweet){
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

    function normalization($tweet){
        GLOBAL $con;
        $kata_tweet = $tweet;
        $i = 0;
        foreach ($kata_tweet as $kata_hasil) {
            $query = "SELECT * FROM tb_kata_singkatan WHERE singkatan_kata = '".$kata_hasil."'";
            $result = mysqli_query($con, $query);
            if ($row = mysqli_fetch_row($result)) {
                $kata_tweet[$i] = $row[2];
            }
            $query = "SELECT * FROM tb_kata_baku WHERE baku_kata = '".$kata_hasil."'";
            if ($row = mysqli_fetch_row($result)) {
                $kata_tweet[$i] = $row[2];
            }
            $query = "SELECT * FROM tb_kata_inggris WHERE inggris_kata = '".$kata_hasil."'";
            if ($row = mysqli_fetch_row($result)) {
                $kata_tweet[$i] = $row[2];
            }
            $i++;
        }
        $kata = implode(' ', $kata_tweet);
        return $kata;
    }

    function stemming($teks){
        include_once 'f_stemmingnazief.php';
        $hasil_kata = [];
        $teks = explode(" ", $teks);
        
        foreach ($teks as $teks) {
            //$hasil = hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($teks)))));
            $hasil = stemmingnazief($teks);
            array_push($hasil_kata, $hasil);
        }

        $hasil = implode(" ",$hasil_kata);
        return $hasil = trim(preg_replace('/\s+/', ' ', $hasil));

    }
