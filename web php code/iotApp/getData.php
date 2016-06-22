<?php

require_once "includes/db_config.php" ;
require_once "includes/Helpers.php" ;


$data = Helpers::getTempRead($con) ;

$readings['temp_1'] = $data->temp1;
$readings['temp_2'] = $data->temp2;
$readings['date']   = $data->date;
$readings['states'] = Helpers::getStates($con) ;

echo Helpers::generateDataString($readings) ;

?>
