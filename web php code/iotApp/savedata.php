<?php

require_once "includes/db_config.php" ;
require_once "includes/Helpers.php" ;

if( $_SERVER['HTTP_USER_AGENT'] == "arduino-ethernet-GelVanO" //security check
    && isset($_GET['temp_read1'],$_GET['temp_read2'])
    && !empty($_GET['temp_read1'])
    && !empty($_GET['temp_read2']) )
{
    //get the GET Parameters
    $ohm1  =  (double) $_GET['temp_read1'] ;
    $ohm2  =  (double) $_GET['temp_read2'] ;

    //get the array of PT100 Resistance Table Scheme
    $numbers = Helpers::getNumbersSchema() ;


    //convert volt to temp based on scheme table
    $temp1 = Helpers::convertVoltToTemp($ohm1,$numbers) ;
    $temp2 = Helpers::convertVoltToTemp($ohm2,$numbers) ;


    //update the temp
    Helpers::updateTemp($con,$temp1,$temp2);


    //save Bad Temp Log
    if( ($temp1 < $min_temp) || ($temp1 >= $max_temp) )
    {
        Helpers::saveTempLog($con,'temp1_sensor',$temp1) ;
    }
    if( ($temp2 < $min_temp) || ($temp2 >= $max_temp) )
    {
        Helpers::saveTempLog($con,'temp2_sensor',$temp2) ;
    }



    //get states
    $states         = Helpers::getStates($con) ;
    $relay1State    = $states->relay1_state ;
    $relay2State    = $states->relay2_state ;
    //$machineState   = $states->machine_state ;



    //output message to send it back to arduino
    //echo "ms=".$machineState."\n" ;
    echo "r1=".$relay1State."\n" ;
    echo "r2=".$relay2State."\n" ;
}

?>
