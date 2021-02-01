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
    $bot_name = "" ;//your bot name
 /// for broadcasting in Channel
$channel_id = "-100xxxxxxxxxx"; 

    //Extact match Commands
    if($message == "/start"){
        send_message($chat_id, "Hey $firstname I am $bot_name \nSupport Group - @world_bots \nUse /cmds to view commands \nBot developed by @reboot13 ");
    }

    if($message == "/cmds"){
        send_message($chat_id, "
          /search <input> (Google search)
          \n/syt <query> (Youtube Search)
          \n/dict <word> (Dicitonary)
          \n/smirror <name> (Search Movies/Series)
          \n/bin <bin> (Bin Data)
          \n/weather <name of your city> (Current weather Status)
          \n/dice (random 1-6)
          \n/date (today's date)
          \n/time (current time)
          \n/git <username>
          \n/info (User Info)
          \n/donate (Donate to Creator)
          ");
    }

    if($message == "/dice"){
        sendDice($chat_id, "🎲");
    }
    if($message == "/date"){
        $date = date("d/m/y");
        send_message($chat_id, $date);
    }
   if($message == "/time"){
        $time = date("h:i a", time());
        send_message($chat_id, $time);
    }
    
     if($message == "/info"){
        send_message($chat_id, "User Info \nName: $firstname\nID:$id \nUsername: @$username");
    }

if($message == "/help"){
        send_message($chat_id, "Contact @Reboot13");
    }
if($message == "/donate"){
        send_message($chat_id, "https://reboot13.hashnode.dev/donate");
    }

///Commands with text


    //Google Search
if (strpos($message, "/search") === 0) {
        $search = substr($message, 8);
         $search = preg_replace('/\s+/', '+', $search);
    if ($search != null) {
     send_message($chat_id, "https://www.google.com/search?q=".$search);
    }
  }

//World Mirror Search
if (strpos($message, "/smirror") === 0) {
$smovie = substr($message, 9);
$smovie = preg_replace('/\s+/', '+', $smovie);
$murl = "[Results-Go to World Mirror](https://witcher.lalbaake456.workers.dev/0:search?q=$smovie)";
if ($smovie != null) {
  send_MDmessage($chat_id, $murl);
}
}

//Youtube Search
if (strpos($message, "/syt") === 0) {
$syt = substr($message, 5);
$syt = preg_replace('/\s+/', '+', $syt);
$yurl = "[Open Youtube](https://www.youtube.com/results?search_query=$syt)";
if ($syt != null) {
  send_MDmessage($chat_id, $yurl);
}
}


///Channel BroadCast
if (strpos($message, "/broadcast") === 0) {
$broadcast = substr($message, 11);
// id == (admins user id)
if ($id == 1171876903 || $id == 1478297206 || $id == 654455829 || $id == 638178378 ) {
  send_Cmessage($channel_id, $broadcast);
}
}


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

///Github User API
if(strpos($message, "/git") === 0){
  $git = substr($message, 5);
   $curl = curl_init();
   curl_setopt_array($curl, [
CURLOPT_URL => "https://api.github.com/users/$git",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 50,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: en-GB,en;q=0.9",
    "Host: api.github.com",
    "Sec-Fetch-Dest: document",
    "Sec-Fetch-Mode: navigate",
    "Sec-Fetch-Site: none",
    "Sec-Fetch-User: ?1",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36"
  ],
]);


$github = curl_exec($curl);
curl_close($curl);
$gresp = json_decode($github, true);

$gusername = $gresp['login'];
$glink = $gresp['html_url'];
$gname = $gresp['name'];
$gcompany = $gresp['company'];
$blog = $gresp['blog'];
$gbio = $gresp['bio'];
$grepo = $gresp['public_repos'];
$gfollowers = $gresp['followers'];
$gfollowings = $gresp['following'];


if ($gusername) {
        send_message($chat_id, "
Name: $gname
Username: $gusername
Bio: $gbio
Followers: $gfollowers
Following : $gfollowings
Repositories: $grepo
Website: $blog
Company: $gcompany
Github url: $glink
Checked By @$username ");
}
else {
           send_message($chat_id, "User Not Found \nInvalid github username checked by @$username");
}
    }

///Dicitonary API
if(strpos($message, "/dict") === 0){	
        $dict = substr($message, 6);	
   $curl = curl_init();	
   curl_setopt_array($curl, [	
	CURLOPT_URL => "https://api.dictionaryapi.dev/api/v2/entries/en/$dict",	
	CURLOPT_RETURNTRANSFER => true,	
	CURLOPT_FOLLOWLOCATION => true,	
	CURLOPT_ENCODING => "",	
	CURLOPT_MAXREDIRS => 10,	
	CURLOPT_TIMEOUT => 30,	
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,	
	CURLOPT_CUSTOMREQUEST => "GET",	
	CURLOPT_HTTPHEADER => [	
		"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",	
        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",	
        "Host: oxforddictionaryapi.herokuapp.com",	
        "Sec-Fetch-Dest: empty",	
        "Sec-Fetch-Mode: cors",	
        "Sec-Fetch-Site: cross-site",	
        ],	
]);	


  $dictionary = curl_exec($curl);	
  curl_close($curl);	

$out = json_decode($dictionary, true);	
$word = $out[0]['word'];	
$noun= $out[0]['meaning']['noun'][0]['definition'];	
$verb = $out[0]['meaning']['verb'][0]['definition'];	
$adjective = $out[0]['meaning']['adjective'][0]['definition'];	
$adverb = $out[0]['meaning']['adverb'][0]['definition'];	
$pronoun = $out[0]['meaning']['pronoun'][0]['definition'];	

if ($word = $dict) {	
    send_message($chat_id, "	
Word: $word 	
Noun : $noun	
Pronoun: $pronoun 	
Verb : $verb 	
Adjective: $adjective 	
Adverb: $adverb 	
Checked By @$username ");	
    }	
    else {	
        send_message($chat_id, "Invalid Input");	
    }	
}	




     ///Send Message (Global)
    function send_message($chat_id, $message){
        $apiToken =  "API_TOKEN";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text");
    }
    
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message){
       $apiToken =  "API_TOKEN";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    

///Send Message to Channel
      function send_Cmessage($channel_id, $message){
       $apiToken =  "API_TOKEN";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$channel_id&text=$text");
    }

 function sendDice($chat_id, $message){
       $apiToken =  "API_TOKEN";
        file_get_contents("https://api.telegram.org/bot$apiToken/sendDice?chat_id=$chat_id&emoji=$message");
    }
?>
