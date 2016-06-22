<?php

require_once "includes/db_config.php" ;
require_once "includes/Helpers.php" ;

if(isset($_GET['trigger_type']) && in_array($_GET['trigger_type'], [1,2]))
{
	$states = Helpers::getStates($con) ;
	if($_GET['trigger_type'] == 1)
	{
		$stmt = $con->prepare("UPDATE relay_trigger SET relay1_state = :field1, date =:date WHERE id = 1");
		$stmt->execute(array(':field1' => !$states->relay1_state ,':date' => date('Y-m-d H:i:s')));
		echo (!$states->relay1_state) ? "on" : "off" ;
	}
	else if($_GET['trigger_type'] == 2)
	{
		$stmt = $con->prepare("UPDATE relay_trigger SET relay2_state = :field1, date =:date WHERE id = 1");
		$stmt->execute(array(':field1' => !$states->relay2_state ,':date' => date('Y-m-d H:i:s')));
		echo (!$states->relay2_state) ? "on" : "off" ;
	}

}




?>
