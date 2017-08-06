<?php
include_once 'function/f_crawlingtweet.php';

$cr = new Crawling();
$cr->get_tweet('lazadaid', 1);

?>
