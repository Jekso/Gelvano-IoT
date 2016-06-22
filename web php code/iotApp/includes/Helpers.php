<?php

class Helpers
{
	public static function saveTempLog($con,$temp_sensor,$temperature)
	{
		$temperature = (double) $temperature ;
		$query   = "INSERT INTO ".$temp_sensor." (temp_read,date) VALUES(:field1,:date)" ;
		$stmt 	 = $con->prepare($query);
	    $stmt->execute(array(':field1' => $temperature,':date' => date('Y-m-d H:i:s')));
	}



	public static function updateTemp($con,$temp1,$temp2)
	{
		$query   = "UPDATE inprogress_temp SET temp1=:temp1,temp2=:temp2,date=:date WHERE id=1" ;
		$stmt 	 = $con->prepare($query);
	    $stmt->execute(array(':temp1' => $temp1,':temp2' => $temp2,':date' => date('Y-m-d H:i:s')));
	}


	public static function getTempRead($con)
	{
		$query = "SELECT * FROM inprogress_temp" ;
		$stmt = $con->prepare($query);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}


	public static function getStates($con)
	{
		$stmt = $con->prepare("SELECT * FROM relay_trigger");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}


	public static function generateDataString($readings)
	{
		$relay1State    = ($readings['states']->relay1_state)  ? "On" : "Off" ;
		$relay2State    = ($readings['states']->relay2_state)  ? "On" : "Off" ;
		//$machineState   = ($readings['states']->machine_state) ? "On" : "Off" ;
		$allStringData	= $relay1State.','.$relay2State.','.$readings['temp_1'].','.$readings['temp_2'].','.date("d-M-Y h:i:s",strtotime($readings['date'])) ;
		return $allStringData ;
	}



	public static function convertVoltToTemp($ohm,$numbers)
	{
		if($ohm >= end($numbers))
	        $temp = count($numbers)-1 ;
	    else
	    {
	        for ($i = 0 ; $i < count($numbers)-1 ; $i++)
	        {
	            if($ohm >= $numbers[$i] && $ohm < $numbers[$i+1])
	            {
	                $temp = $i ;
	                break;
	            }
	        }
	    }
		return $temp ;
	}




	public static function getNumbersSchema()
	{
		$data = file_get_contents("includes/data.php");
	    $data = str_replace(PHP_EOL, ' ', $data);
	    $numbers = explode(' ',$data) ;
		return $numbers ;
	}


	public static function getChartData($con,$temp)
	{
		$query = "SELECT * FROM $temp ORDER BY date LIMIT 100 " ;
		$stmt = $con->prepare($query);
		$stmt->execute();
		$output = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($output))
		{
			foreach ($output as $op)
			{
				$dates [] = date("d-M-Y h:i:s",strtotime($op['date'])) ;
				$values[] = $op['temp_read'] ;
			}
			$data = [
				'dates'		=> json_encode($dates) ,
				'values'	=> json_encode($values),
				'state'		=> 1
			];
		}
		else
			$data['state'] = 0 ;
		return $data ;
	}
}


?>
