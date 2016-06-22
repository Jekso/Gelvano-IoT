using UnityEngine;
using System.Collections;
using UnityEngine.UI ;

public class RelayTrigger : MonoBehaviour {



	public Button relay_btn1,relay_btn2 ;
	public Text relay_txt1 , relay_txt2;


	public void TriggerRelayState (string relay_id)
	{
		string url = "http://gelvano.esy.es/iotApp/triggerRelay.php?trigger_type="+relay_id;
		WWW www = new WWW(url);
		StartCoroutine(WaitForRequest(www,relay_id));

	}

	

	IEnumerator WaitForRequest(WWW www,string relay_id)
	{
		yield return www;
		if (www.error == null)
		{
			if(relay_id == "1")
			{
				changeButtons(www,relay_txt1,relay_btn1) ;
			}
			else if(relay_id == "2")
			{
				changeButtons(www,relay_txt2,relay_btn2) ;
			}

		}  
	}


	public void changeButtons(WWW www,Text relayTxt,Button relayBtn)
	{
		if(www.text == "on")
		{
			relayTxt.color = Color.green ;
			relayTxt.text	= "Relay is : On"; 
			relayBtn.image.color = new Color(173.0f/255.0f,79.0f/255.0f,81.0f/255.0f,255);
			relayBtn.GetComponentInChildren<Text>().text = "Turn Relay Off" ;
		}
		else if(www.text == "off")
		{
			relayTxt.color = Color.red ;
			relayTxt.text	= "Relay is : Off"; 
			relayBtn.image.color = new Color(105.0f/255.0f,173.0f/255.0f,79.0f/255.0f,255);
			relayBtn.GetComponentInChildren<Text>().text = "Turn Relay On" ;
		}
	}



}
