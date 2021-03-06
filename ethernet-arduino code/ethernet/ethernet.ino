#include <SPI.h>
#include <Ethernet.h>

float temperatura = 0,val; 
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
//IPAddress ip(192, 168, 1, 177);
//IPAddress myDns(1, 1, 1, 1);
EthernetClient client;
char server[] = "www.gelvano.esy.es";
unsigned long lastConnectionTime = 0;          
const unsigned long postingInterval = 10L * 1000L;
String http_response = String(250) ;


void setup()
{
  pinMode(7, OUTPUT);
  Serial.begin (9600); 
  delay(1000); 
  Ethernet.begin(mac);
  digitalWrite(7, LOW);
  Serial.println("configured!");
}
 
void loop()
{
  
  if (client.available())
  {
     char c = client.read();
     Serial.write(c);
     if(http_response.length() < 250)
      {
        http_response += c ;
      }
      
      if(c == '\n')
      {
          if(http_response.indexOf("r1=1") > 0)
          {
            digitalWrite(7, HIGH);
          }
          else if(http_response.indexOf("r1=0") > 0)
          {
            digitalWrite(7, LOW);
          } 
      }
  }

  

  
  val = analogRead(0);
  temperatura = (val*95)/(1024-val);  
  if (millis() - lastConnectionTime > postingInterval)
  {
    client.stop();
    if (client.connect(server, 80))
    {
      http_response = "" ;
      Serial.println("connecting...");
      client.println("GET /iotApp/savedata.php?temp_read1=104&temp_read2="+String(temperatura,2)+" HTTP/1.1");
      client.println("Host: www.gelvano.esy.es");
      client.println("User-Agent: arduino-ethernet-GelVanO");
      client.println("Connection: close");
      client.println();
      lastConnectionTime = millis();  
    }
    else
    {
      Serial.println("connection failed");
    }
  }
  
 

}

