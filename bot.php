<?php

    $botToken = "1588096899:AAHDEK1hOPezooP7rxlQCq9nALyZfDikPeM"; #<------------------- PUT YOUR TOKEN HERE------------->#
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$allowed_id = (array("-1001334819790","1282083928","-1001348664765","667418990"));//Useranme to allow please put here or chatid or user id

if (in_array($chatId, $allowed_id) === false){
 $unauth_msg = urlencode ("<b>Hey there Gay Boii!! <a href='tg://user?id=$userId'>$firstname</a>\nSorry, you are not authorized to use this bot!</b>\n<b>Contact Onwer For Authorization: TEAM NINJA</b>");
 sendMessage($chatId,$unauth_msg, $message_id);
return;
}

//================[Start Command]================//

if ((strpos($message, "/start") === 0)||(strpos($message, "/start") === 0)){
sendMessage ($chatId, "<b>Hello @$username!! Check my commands by entering /cmds</b>", $message_id);
}

//=============[Command Section]============//

elseif ((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)){
sendMessage($chatId, "GATEWAYS%0A%0A<b>STRIPE</b> AUTH <code>/chk cc|mm|yy|cvv</code>%0A✅STATUS :- LIVE%0A%0A<b>STRIPE</b> AUTH 2 <code>/ccn cc|mm|yy|cvv</code>%0A✅STATUS :- Updating %0A%0A<b>SK [LIVE]</b> <code>/key sk_live</code>%0A✅STATUS :- LIVE%0A%0A<b>INFO</b> /info %0A✅STATUS :- LIVE%0A%0A<b>BIN [CHECK]</b> <code>/bin xxxxxx</code>%0A✅STATUS :- LIVE%0A%0ABOT MADE BY:- <b><i>[ TEAM NINJA ]</i></b>");
}

//=========[Bin Command]=========//


elseif ((strpos($message, "/bin $bin") === 0)||(strpos($message, "!bin $bin") === 0)||(strpos($message, ".bin $bin") === 0)){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$bin = substr("$bin", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$type = GetStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
};
sendMessage($chatId, '<b>🟢Valid Bin :- </b>'.$bin.'%0A<b>✦ Bank:</b> '.$bank.'%0A<b>✦ Country:</b> '.$name.''.$emoji.'%0A<b>✦ Brand:</b> '.$brand.'%0A<b>✦ Card:</b> '.$scheme.'%0A<b>✦ Type:</b> '.$type.'%0A<b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>✦ CHECKED BY -</b>: @'.$username.'%0A<b>✦ BOT BY</b>:<a> [ TEAM NINJA ]</a>', $message_id);
}
//=========[Bin Command-END]=========//


//=========[Info Command]=========//

elseif ((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0)){
sendMessage($chatId, "✦ Chat [ID]: <code>$chatId</code>%0A✦ Name: $firstname%0A✦ Username: @$username%0A%0A✦<b>Bot Made by: [ TEAM NINJA ] </b>");
}
//=========[Info Command-END]=========//

//=========[ID Command]=========//

elseif ((strpos($message, "!id") === 0)||(strpos($message, "/id") === 0)){
sendMessage($chatId, "<b>This chat's ID is:</b> <code>$chatId</code>");
}
//=========[ID]=========//


//=================================================RANDOM USER AGENT=====================================================//
function random_ua() {
    $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
    $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
    switch ($tipoNavegador) {
        case 'Chrome':
            $navegadoresChrome = array("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
            );
            return $navegadoresChrome[array_rand($navegadoresChrome)];
            break;
        case 'Firefox':
            $navegadoresFirefox = array("Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
                'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
                'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
            );
            return $navegadoresFirefox[array_rand($navegadoresFirefox)];
            break;
        case 'Opera':
            $navegadoresOpera = array("Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
                'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
                'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
                'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
                'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
                'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
                'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
                'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
        case 'Explorer':
            $navegadoresOpera = array("Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
                'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
    }
}
$ua = random_ua();


//=================================================RANDOM USER AGENT===========================================================//


//////////=========[Chk Command]=========//////////


if ((strpos($message, "!ccn") === 0)||(strpos($message, "/ccn") === 0)||
(strpos($message,".ccn") === 0)){
$lista = substr($message, 5);
require("ccn.php");
}
if ((strpos($message, "!chk") === 0)||(strpos($message, "/chk") === 0)||
(strpos($message,".chk") === 0)){
$lista = substr($message, 5);
require("chk.php");
}

//================[SK CHECK]===================//

elseif ((strpos($message, "/key") === 0)||(strpos($message, "!key") === 0)||(strpos($message, ".key") === 0)){
$sec = substr($message, 4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5278540001668044&card[exp_month]=10&card[exp_year]=2024&card[cvc]=252");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);


if (strpos($result, 'api_key_expired')){
sendMessage($chatId, "<b>🔴EXPIRED KEY</b>%0A<u>✦Key:</u> <code>$sec</code>%0A<b>✦Message: <b>Expired API key Provided%0A</b>✦Checked by:</b> @$username%0A<b>✦Bot Made by:[ TEAM NINJA ]</b>", $message_id);
}elseif (strpos($result, 'Invalid API Key provided')){
sendMessage($chatId, "<b>🔴INVALID KEY</b>%0A<b>✦Key:</b> <code>$sec</code>%0A<b>✦Message: <b>Invalid API Key provided.%0A</b>✦Checked by: </b>@$username%0A<b>✦Bot Made by:[ TEAM NINJA ]</b>", $message_id);
}
elseif ((strpos($result, 'You did not provide an API key.')) || (strpos($result, 'You need to provide your API key in the Authorization header,'))){
sendMessage($chatId, "<b>🔴NO KEY PROVIDED%0A✦Message:</b><b> You did not provide an API key.%0A</b><b>✦Checked by:</b> @$username%0A<b>✦Bot Made by:[ TEAM NINJA ]</b>", $message_id);
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
sendMessage($chatId, "<b>🔴DEAD KEY</b>%0A<b>✦Key:</b> <code>$sec</code>%0A<b>✦Message: <b>Testmode charges only.%0A</b>✦Checked by:</b> @$username%0A<b>✦Bot Made by:[ TEAM NINJA ]</b>", $message_id);
}else{
sendMessage($chatId, "<b>🟢LIVE KEY</b>%0A<b>✦Key:</b><code>$sec</code>%0A<b>✦Message:<b> Live API key provided.%0A</b>✦Checked by:</b> @$username%0A<b>✦Bot Made by:[ TEAM NINJA ]</b>", $message_id);
}
}

//================[SK CHECK]===================//

//================[FUNCTION]==================//

function sendMessage ($chatId, $message){
$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
file_get_contents($url);      
}

?>
