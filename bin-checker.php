
<?php
    date_default_timezone_set("Asia/kolkata");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    
 /// for broadcasting in Channel


    //Extact match Commands
    if($message == "/start"){
        send_message($chat_id, "Hey $firstname  \nSupport Group - @world_bots \nUse /cmds to view commands \nBot developed by @reboot13 ");
    }

    if($message == "/cmds"){
        send_message($chat_id, "
          \n/bin <bin> (Bin Data)
          \n/weather <name of your city> (Current weather Status)
          \n/info (User Info)
          
          ");
    
     if($message == "/info"){
        send_message($chat_id, "User Info \nName: $firstname\nID:$id \nUsername: @$username");
    }

if($message == "/help"){
        send_message($chat_id, "Contact @reboot13");
    



    


//Bin Lookup
   if(strpos($message, "/bin") === 0){
        $bin = substr($message, 5);
   $curl = curl_init();
   curl_setopt_array($curl, [
	CURLOPT_URL => "https://lookup.binlist.net/".$bin,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"authority: lookup.binlist.net",
		"accept: application/json",
		"accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
		"origin: https://binlist.net",
		"https://binlist.net/",
		"sec-fetch-dest: empty",
		"sec-fetch-site: same-site"
	],
]);

$result = curl_exec($curl);
curl_close($curl);
$data = json_decode($result, true);
$bank = $data['bank']['name'];
$country = $data['country']['alpha2'];
$currency = $data['country']['currency'];
$emoji = $data['country']['emoji'];
$scheme = $data['scheme'];
$Brand = $data['brand'];
$type = $data['type'];
  if ($scheme != null) {
        send_message($chat_id, "
    Bin: $bin
Type: $scheme
Brand : $Brand
Bank: $bank
Country: $country $emoji
Currency: $currency
Credit/Debit:$type
Checked By @$username ");
    }
else {
    send_message($chat_id, "Enter Valid BIN");
}
   }
    



    //Wheather API
if(strpos($message, "/weather") === 0){
        $location = substr($message, 9);
   $curl = curl_init();
   curl_setopt_array($curl, [
CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?q=$location&appid=89ef8a05b6c964f4cab9e2f97f696c81",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 50,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"Accept: */*",
        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
        "Host: api.openweathermap.org",
        "sec-fetch-dest: empty",
		"sec-fetch-site: same-site"
  ],
]);


$content = curl_exec($curl);
curl_close($curl);
$resp = json_decode($content, true);

$weather = $resp['weather'][0]['main'];
$description = $resp['weather'][0]['description'];
$temp = $resp['main']['temp'];
$humidity = $resp['main']['humidity'];
$feels_like = $resp['main']['feels_like'];
$country = $resp['sys']['country'];
$name = $resp['name'];
$kelvin = 273;
$celcius = $temp - $kelvin;
$feels = $feels_like - $kelvin;

if ($location = $name) {
        send_message($chat_id, "
    Weather at $location: $weather
Status: $description
Temp : $celcius °C
Feels Like : $feels °C
Humidity: $humidity
Country: $country 
Checked By @$username ");
}
else {
           send_message($chat_id, "Invalid City");
}
    }
     ///Send Message (Global)
    function send_message($chat_id, $message){
        $apiToken =  "1469752597:AAEtC5OVJJd31RqNpoEHG6VVruv-eLCq-V8";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text");
    }
    
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message){
       $apiToken =  "1469752597:AAEtC5OVJJd31RqNpoEHG6VVruv-eLCq-V8";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    



?>
