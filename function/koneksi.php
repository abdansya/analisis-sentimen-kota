<?php
    // $con = mysql_connect("root","", "") or die('Could not connect: ' . mysql_error());
    // mysql_select_db("ansen", $con);
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'ansen_ecommerce';
    $con = mysqli_connect($host, $user, $pass, $db) or die(mysql_error());
?>