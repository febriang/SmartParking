#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>

#define BUZZER D3
#define IRSENSOR D4
#define IRSENSOR2 D5
#define IRSENSOR3 D6

WiFiClient wifiClient;


const char *ssid = "SB";
const char *password = "satusampesepuluh";

int previousState = LOW;
int previousState2 = LOW;
int previousState3 = LOW;

void setup() {
  pinMode(BUZZER, OUTPUT);
  pinMode(IRSENSOR, INPUT); 
  pinMode(IRSENSOR2, INPUT); 
  pinMode(IRSENSOR3, INPUT);
  Serial.begin(115200);

  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) { // Wait till connects
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println(WiFi.localIP());
}

void loop() {
  int currentState = digitalRead(IRSENSOR);
  int currentState2 = digitalRead(IRSENSOR2);
  int currentState3 = digitalRead(IRSENSOR3);
  
  String status = (currentState == HIGH) ? "Kosong" : "Terisi";
  String status2 = (currentState2 == HIGH) ? "Kosong" : "Terisi";
  String status3 = (currentState3 == HIGH) ? "Kosong" : "Terisi";

  if (currentState != previousState || currentState2 != previousState2 || currentState3 != previousState3) {
    if (currentState == LOW || currentState2 == LOW || currentState3 == LOW) {
      digitalWrite(BUZZER, HIGH); // Sound the buzzer
      delay(500); // Adjust the delay time as needed
      digitalWrite(BUZZER, LOW); // Turn off the buzzer
    }
  }

  previousState = currentState;
  previousState2 = currentState2;
  previousState3 = currentState3;

  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    Serial.print("[HTTP] begin...\n");
    String link;
    link = F("http://192.168.43.59/IoT/kirimdata.php?status=");
    link += status;
    link += "&status2=";
    link += status2;
    link += "&status3=";
    link += status3;
    Serial.printf("Link : %s\n", link.c_str());
    http.begin(wifiClient, link);

    Serial.print("[HTTP] GET...\n");
    int httpCode = http.GET();

    if (httpCode > 0) {
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) {
        Serial.print(F("Berhasil mengirimkan data ke Server\n"));
        Serial.print(F("Status1: "));
        Serial.print(status);
        Serial.print("\n");
        Serial.print(F("Status2: "));
        Serial.print(status2);
        Serial.print("\n");
        Serial.print(F("Status3: "));
        Serial.print(status3);
        Serial.print("\n");
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }
      delay(1000);
    }
    http.end();
  } else {
    Serial.println("Delay...");
  }
  delay(1000);
}
