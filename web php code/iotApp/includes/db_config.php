<?php

date_default_timezone_set('Africa/Cairo');

$DB_SERVER 	= "localhost" ;
$DB_USER 	= "u581456581_jekso" ;
$DB_PASS 	= "QlYXEkr1LwkVQ" ;
$DB_NAME 	= "u581456581_gelva" ;

$min_temp   = 0.0;
$max_temp   = 55.0;



//connect to the database
$con = new PDO("mysql:host={$DB_SERVER};dbname={$DB_NAME};charset=utf8", $DB_USER, $DB_PASS);
//$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
