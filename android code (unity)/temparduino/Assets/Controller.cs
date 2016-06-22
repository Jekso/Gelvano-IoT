using UnityEngine;
using System.Collections;
using UnityEngine.UI ;

public class Controller : MonoBehaviour {
	
	public Text tempTxt1 ,tempTxt2 , relayTxt1 , relayTxt2 , dateTxt ;
	public Button relayBtn1 , relayBtn2 ;
	public AudioSource alarm ;
	string temp_read1 , temp_read2 , date , relay_state1,relay_state2, op_str ;
	string[] cutouts ;
	float timer = 5.0f , timerMax = 5.0f,min_temp = 0.0f,max_temp=55.0f ;
  
	public void Update()
	{
		timer += Time.deltaTime;
		if (timer >= timerMax )
		{
			string url = "http://gelvano.esy.es/iotApp/getData.php";
			WWW www = new WWW(url);
			StartCoroutine(WaitForRequest(www));
			//Debug.Log(timer);
			timer = 0.0f ;
		}
	}

	IEnumerator WaitForRequest(WWW www)
	{
//		tempTxt1.color = Color.white ;
//		tempTxt2.color = Color.white ;
		yield return www;
		if (www.error == null)
		{
			cutouts = www.text.Split(',');
			relay_state1	 	= cutouts[0] ;
			relay_state2 		= cutouts[1] ;
			temp_read1	 	= cutouts[2] ;
			temp_read2 		= cutouts[3] ;
			date			 	= cutouts[4] ;
			tempTxt1.text = temp_read1+" C" ;
			tempTxt2.text = temp_read2+" C" ;
			dateTxt.text	 = "Measured At : "+date ;

			//change color based on temp
			if(float.Parse(temp_read1) < min_temp || float.Parse(temp_read1) >= max_temp )
				tempTxt1.color = Color.yellow ;
			else
				tempTxt1.color = Color.white ;
			if(float.Parse(temp_read2) < min_temp || float.Parse(temp_read2) >= max_temp )
				tempTxt2.color = Color.yellow ;
			else
				tempTxt2.color = Color.white ;




			//turn on alarm based on temp
			if(tempTxt1.color == Color.yellow || tempTxt2.color == Color.yellow)
			{
				if(!alarm.isPlaying)
					alarm.Play();
			}
			else
				alarm.Stop();



			//change relay status options based on relay state data
			if(relay_state1 == "On")
			{
				relayTxt1.color = Color.green ;
				relayBtn1.image.color = new Color(173.0f/255.0f,79.0f/255.0f,81.0f/255.0f,255);
				relayBtn1.GetComponentInChildren<Text>().text = "Turn Relay Off" ;
			}
			else if(relay_state1 == "Off")
			{
				relayTxt1.color = Color.red ;
				relayBtn1.image.color = new Color(105.0f/255.0f,173.0f/255.0f,79.0f/255.0f,255);
				relayBtn1.GetComponentInChildren<Text>().text = "Turn Relay On" ;
			}
//			if(relay_state2 == "On")
//			{
//				relayTxt2.color = Color.green ;
//				relayBtn2.image.color = new Color(173.0f/255.0f,79.0f/255.0f,81.0f/255.0f,255);
//				relayBtn2.GetComponentInChildren<Text>().text = "Turn Relay Off" ;
//			}
//			else if(relay_state2 == "Off")
//			{
//				relayTxt2.color = Color.red ;
//				relayBtn2.image.color = new Color(105.0f/255.0f,173.0f/255.0f,79.0f/255.0f,255);
//				relayBtn2.GetComponentInChildren<Text>().text = "Turn Relay On" ;
//			}
			relayTxt1.text	= "Relay is : "+relay_state1 ;
			//relayTxt2.text	= "Relay is : "+relay_state2 ;
			
		}
		else
		{
			tempTxt1.color = Color.red ;
			tempTxt1.text = "Error getting data ! " ;
			tempTxt2.color = Color.red ;
			tempTxt2.text = "Error getting data ! " ;
			//Debug.Log(www.error );
		}    
	}




}
